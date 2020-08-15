<?php

namespace testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function profileAction()
    {
        return $this->render('@test/Default/profile.html.twig');
    }
    public function listAction()
    {
        return $this->render('@test/Default/list.html.twig');
    }
    public function indexAction()
    {
        return $this->render('@test/Default/index.html.twig');
    }
    public function loginAction()
    {
        return $this->render('@test/Default/login.html.twig');
    }
    public function signupAction()
    {
        return $this->render('@test/Default/signup.html.twig');
    }
    public function singleAction($id)
    {
        return $this->render('@test/Default/single.html.twig');
    }
    public function listGridAction()
    {
        return $this->render('@test/Default/listGrid.html.twig');
    }
}
