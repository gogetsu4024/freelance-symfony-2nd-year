<?php

namespace sandboxBundle\Controller;

use forumBundle\Entity\Scrumnotes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('forumBundle:Postsforum')->find($id);
        return $this->render('@sandbox/Default/index.html.twig',array('post'=>$post));
    }
    public function scrumAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $scrum = $em->getRepository('forumBundle:Scrumboard')->find($id);
        return $this->render('@sandbox/Default/scrum.html.twig',array('scrum'=>$scrum));
    }
    public function scrumChangeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $note = $em->getRepository('forumBundle:Scrumnotes')->find($request->get('idpost'));
        if ($request->get("type")== "To Do")
        $note->setState("To Do");
        else if ($request->get("type")== "Doing")
            $note->setState("Doing");
        else
            $note->setState("Done");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($note);
        $entityManager->flush();
       return new JsonResponse($request->get('idpost'));
    }
    public function scrumAddAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $scrumBoard = $em->getRepository('forumBundle:Scrumboard')->find($request->get('idpost'));
        $scrum = new Scrumnotes();
        $scrum->setTitle($request->get('title'));
        $scrum->setDescription($request->get('description'));
        $scrum->setUserid($this->getUser());
        $date = new \DateTime();
        $result = $date->format('Y-m-d H:i:s');
        $scrum->setPosteddate($result);
        $scrum->setState("To Do");
        $scrum->setScrumboardid($scrumBoard);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($scrum);
        $entityManager->flush();
        return new JsonResponse($scrum->getId());
    }
    public function scrumDeleteAction(Request $request)
    {
        $post=$this->getDoctrine()->getRepository("forumBundle:Scrumnotes")->find($request->get('idNote'));
        $em=$this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return new JsonResponse($request->get('idNote'));
        //var_dump($id);
        // return new Response($id);
    }

}
