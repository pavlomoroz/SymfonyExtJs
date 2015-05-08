<?php

namespace Enviroment\EavBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Enviroment\EavBundle\Entity\Schema;
use Enviroment\EavBundle\Form\SchemaType;

/**
* @Route("/attribute/schema")
*/
class SchemaController extends Controller
{

    public function indexAction()
    {

    }

    /**
     * @Route("/edit/{id}")
     */
    public function editAction($id)
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $schema = $em->find('EnviromentEavBundle:Schema', $id);

        if ($schema === null) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(new SchemaType(), $schema);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $schema = $form->getData();

                $em->persist($schema);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Save successful!'));

                return $this->redirect($this->generateUrl('enviroment_eav_schema_edit', array(
                    'id' => $id
                )));
            } else {
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('Save unsuccessful!'));
            }
        }

        return $this->render('EnviromentEavBundle:Schema:edit.html.twig', array(
            'form' => $form->createView(),
            'schema' => $schema
        ));
    }
}