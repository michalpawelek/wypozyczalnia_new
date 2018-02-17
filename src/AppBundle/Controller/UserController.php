<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/rejestracja", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Witaj '.$user->getLogin().' !');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/konto/rezerwacje/{fieldId}", name="user_reservation_field")
     * @Security("is_granted('ROLE_USER')")
     */
    public function reservationFieldAction(Request $request, $fieldId) {
        $em = $this->getDoctrine()->getManager();
        $field = $em->getRepository('AppBundle:Boiska')
            ->find($fieldId);

        $reservations = $em->getRepository('AppBundle:Rezerwacje')
            ->findBy([
                'idUzytkownik' => $this->getUser(),
                'idBoiska' => $field
            ]);


        return $this->render('user/reservations_field.html.twig', array(
            'reservations' => $reservations,
            'field' => $field
        ));
    }

    /**
     * @Route("/konto/rezerwacje", name="user_reservation")
     * @Security("is_granted('ROLE_USER')")
     */
    public function reservationAction(Request $request) {
        $fields = [];
        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('AppBundle:Rezerwacje')
            ->findBy([
                'idUzytkownik' => $this->getUser()
            ]);

        foreach ($reservations as $reservation) {
            $field = $em->getRepository('AppBundle:Boiska')
                ->find($reservation->getid_boiska());
            if (!in_array($field, $fields)) {
                array_push($fields, $field);
            }
        }

        return $this->render('user/reservations.html.twig', array(
            'fields' => $fields
        ));
    }
    /**
     * @Route("/konto", name="user_account")
     * @Security("is_granted('ROLE_USER')")
     */
    public function accountAction(Request $request) {
        $user = $this->getUser();

        return $this->render('user/account.html.twig', array(
            'uzytkownik' => $user
        ));
    }
}
