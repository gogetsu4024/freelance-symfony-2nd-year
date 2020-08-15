<?php

namespace backOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReclamationsController extends Controller
{

    public function listReclamationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('forumBundle:Reclamation')->findAll();
        return $this->render('@backOffice/Reclamation/listForumReclamations.html.twig',array(
            'posts' => $posts,'done'=>"no"));
    }
    public function singleReclamationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('forumBundle:Reclamation')->find($id);
        return $this->render('@backOffice/Reclamation/singleReclamation.html.twig',array(
            'p' => $post));
    }public function singleReclamationSendMailAction(Request $request)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('testingApp3215@gmail.com')
            ->setTo($request->get('email'))
            ->setBody(
                "".$request->get('body')."",
                'text'
            );
        $this->get('mailer')->send($message);
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('forumBundle:Reclamation')->findAll();
        $reclamation = $em->getRepository('forumBundle:Reclamation')->find($request->get('id'));
        //$em->remove($reclamation);
        //$em->flush();
        return $this->render('@backOffice/Reclamation/listForumReclamations.html.twig',array(
            'posts' => $posts,
            'done' =>"yes"
        ));
    }
    public function singleUserForumPostsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('forumBundle:Postsforum')->findAll();
        return $this->render('@backOffice/Default/singleForumUserPosts.html.twig', array(
            'posts' => $posts,
            'userId' => $id
        ));
    }
    public function viewsingleCommentDeleteAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $Com = $em->getRepository('forumBundle:Postscomments')->find($id);
        $em->remove($Com);
        $em->flush();
        return $this->redirect($this->generateUrl('back_office_singleForumPosts', array('id' => $Com->getIdPost()->getId())), 301);
        //dump($Com->getIdPost()->getId());
        //return new Response("");
    }
    public function deleteAction($id)
    {
        $post=$this->getDoctrine()->getRepository("forumBundle:Postsforum")->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirect($this->generateUrl('back_office_listForumPosts'));
        //var_dump($id);
        // return new Response($id);
    }


}
