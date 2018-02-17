<?php

namespace AppBundle\Controller;

use AppBundle\Form\AddFieldForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{
    /**
     * @Route("/admin/dodaj-boisko", name="admin_add_field")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function addFieldAction(Request $request)
    {
        $form = $this->createForm(AddFieldForm::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $field = $form->getData();
            $field->setImg('img.img');

            $em = $this->getDoctrine()->getManager();

            $em->persist($field);
            $em->flush();

            $this->addFlash('success', 'Boisko dodane!');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/addField.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin", name="admin_index")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        return $this->render('admin/index.html.twig');
    }
}
