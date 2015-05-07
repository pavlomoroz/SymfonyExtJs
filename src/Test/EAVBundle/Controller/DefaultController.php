<?php

namespace Test\EAVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Test\EAVBundle\Entity\Data;
use Test\EAVBundle\Form\DataType;
use Enviroment\EAVBundle\Services\EavEntityService;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $datas = $this->getDoctrine()->getRepository('TestEAVBundle:Data')->findAll();
        return $this->render('TestEAVBundle:Default:index.html.twig', array('entities' => $datas));
    }

    public function newAction(Request $request)
    {
        /** @var EavEntityService $eavEntityService */
        $eavEntityService = $this->get('eav.entity');
        $data = $eavEntityService->createAttributeEntity();

        $form = $this->createForm(new DataType(), $data);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect($this->generateUrl('test_eav_homepage'));
        }

        return $this->render('TestEAVBundle:Default:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }

    public function editAction(Data $data, Request $request)
    {
        $form = $this->createForm(new DataType(), $data);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('test_eav_homepage'));
        }

        return $this->render('TestEAVBundle:Default:edit.html.twig', array(
            'form'   => $form->createView(),
        ));
    }

    public function deleteAction(Data $data)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();

        return $this->redirect($this->generateUrl('test_eav_homepage'));
    }
}
