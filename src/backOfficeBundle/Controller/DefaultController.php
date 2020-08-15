<?php

namespace backOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@backOffice/Default/index.html.twig');
    }
    public function listForumPostsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('forumBundle:Postsforum')->findAll();
        return $this->render('@backOffice/Default/listForumPosts.html.twig',array(
            'posts' => $posts));
    }
    public function singleForumPostsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('forumBundle:Postsforum')->find($id);
        return $this->render('@backOffice/Default/singleForumPosts.html.twig',array(
            'p' => $post));
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
