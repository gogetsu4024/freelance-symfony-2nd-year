<?php

namespace reclamationBundle\Controller;

use forumBundle\Entity\Reclamation;
use forumBundle\Entity\Scrumnotes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('forumBundle:Postsforum')->findAll();
        $done="no";
        return $this->render('@reclamation/Default/contact.html.twig',array('posts'=>$posts,'done'=>$done));
    }
    public function sendAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('forumBundle:Postsforum')->find($request->get('post'));
        $posts = $em->getRepository('forumBundle:Postsforum')->findAll();
        $reclamation = new Reclamation();
        $reclamation->setDescription($request->get('message'));
        $reclamation->setPostid($post);
        $reclamation->setSubject($request->get('subject'));
        $reclamation->setUser($this->getUser());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reclamation);
        $entityManager->flush();
        $done="yes";
        return $this->render('@reclamation/Default/contact.html.twig',array('done'=>$done,'posts'=>$posts));
    }
}
