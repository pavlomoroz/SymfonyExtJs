<?php

namespace Test\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name = "Dev")
    {
        return $this->render('TestTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
