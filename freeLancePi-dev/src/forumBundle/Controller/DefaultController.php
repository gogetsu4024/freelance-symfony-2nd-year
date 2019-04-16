<?php

namespace forumBundle\Controller;

use forumBundle\Entity\Postscomments;
use forumBundle\Entity\Postsforum;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function ajaxAction($id='') {

            //dump($id);
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('forumBundle:Postsforum');
        $posts = $repo->createQueryBuilder('a')
            ->where('a.subject LIKE :subject')
            ->setParameter('subject', '%'.$id.'%')
            ->getQuery()->getResult();


        $jsonData = array();
        $idx = 0;
        foreach($posts as $student) {
            $temp = array(
                'id' => $student->getId(),
                'subject' => $student->getSubject(),
                'description' => $student->getDescription(),
                'postedDate' => $student->getPostedDate(),
                'user' => $student->getidUser()->getUsername(),
                'picture' => $student->getidUser()->getPicturePath(),
            );
            $jsonData[$idx++] = $temp;
        }
            return new JsonResponse($jsonData);
    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $c = $em->getRepository('forumBundle:Category')->findAll();

        $posts = $em->getRepository('forumBundle:Postsforum')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        dump($c);
        return $this->render('@forum/Default/index.html.twig',array('posts'=>$pagination,'categories'=>$c));
    }
    public function addAction(Request $request)
    {
        dump($request);
        $em = $this->getDoctrine()->getManager();
        $category= $em->getRepository('forumBundle:Category')->find($request->get('category'));
        $post = new Postsforum();
        $post->setCategoryId($category);
        $post->setDescription($request->get('desc'));
        $post->setIduser($this->getUser());
        $post->setPosteddate(new \DateTime());
        $post->setSubject($request->get('subject'));
        $post->setViews(0);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();
        return $this->redirect($this->generateUrl('forum_view_single', array('id' => $post->getId())), 301);
       // return $this->redirectToRoute('forum_view_single', array('id' => $post->getId()));
    }
    public function viewAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('forumBundle:Postsforum')->find($id);
        $c = $em->getRepository('forumBundle:Category')->findAll();
        $post->setViews($post->getViews()+1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();
        dump($post);
        return $this->render('@forum/Default/singlePost.html.twig', array(
            'post' => $post,
            'categories'=>$c
        ));
    }
    public function viewUserAction($id,Request $request)
    {

       $em = $this->getDoctrine()->getManager();
        $c = $em->getRepository('forumBundle:Category')->findAll();

        $posts = $em->getRepository('forumBundle:Postsforum')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            2
        );
        dump($id);
        //return new Response($id);
        return $this->render('@forum/Default/singleUserPosts.html.twig',array('posts'=>$pagination,'categories'=>$c,'userId'=>$id));
    }

    public function deleteAction($id)
    {
        $post=$this->getDoctrine()->getRepository("forumBundle:Postsforum")->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirect($this->generateUrl('forum_homepage'));
        //var_dump($id);
       // return new Response($id);
    }
    public function addCommentAction(Request $request,$id)
    {
        $com= new Postscomments();
        $em = $this->getDoctrine()->getManager();
        $post= $em->getRepository('forumBundle:Postsforum')->find($id);
        if ($request->get("Description"))
        {
            $com->setCommentaire($request->get("Description"));
            $com->setIduser($this->getUser());
            $com->setPostedon(new \DateTime());
            $com->setIdpost($post);
            $em = $this->getDoctrine()->getManager();
            $em->persist($com);
            $em->flush();
            //return new Response($post);

            return $this->redirect($this->generateUrl('forum_view_single', array('id' => $post->getId()), 301));
        }
        return $this->render('@Forum/Forum/singlePost.html.twig');
        //return new Response($com);

    }
    public function viewsingleCommentDeleteAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $Com = $em->getRepository('forumBundle:Postscomments')->find($id);
        $em->remove($Com);
        $em->flush();
        return $this->redirect($this->generateUrl('forum_view_single', array('id' => $Com->getIdPost()->getId())), 301);
        //dump($Com->getIdPost()->getId());
        //return new Response("");
    }

}
