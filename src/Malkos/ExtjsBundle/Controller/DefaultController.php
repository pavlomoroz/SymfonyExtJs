<?php

namespace Malkos\ExtjsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MalkosExtjsBundle:Default:index.html.twig', array('name' => $name));
    }
}
