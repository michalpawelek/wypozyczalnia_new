<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rezerwacje;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReservationController extends Controller
{
    private $hoursAvailable;

    public function __construct()
    {
        $this->hoursAvailable = array(
            '10' => false,
            '11' => false,
            '12' => false,
            '13' => false,
            '14' => false,
            '15' => false,
            '16' => false,
            '17' => false,
            '18' => false,
            '19' => false,
            '20' => false,
            '21' => false
        );
    }

    /**
     * @Route("/rezerwacja/{city}/{fieldId}/{date}", name="reservation_day")
     * @Security("is_granted('ROLE_USER')")
     */
    public function dayAction(Request $request, $city, $fieldId, $date)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder();

        $field = $em->getRepository('AppBundle:Boiska')->find($fieldId);
        $today = new \DateTime();
        $today->setTimestamp($date);

        foreach ($this->hoursAvailable as $key => $value) {
            $today->setTime($key, 0);
            $reservationTmp = $em->getRepository('AppBundle:Rezerwacje')
                ->findOneBy([
                    'idBoiska' => $field,
                    'dataWypozyczenia' => $today
                ]);

            $form->add($key, CheckboxType::class, array(
                'label' => $key . '-' . ($key + 1),
                'disabled' => !is_null($reservationTmp),
                'required' => false
            ));
        }

        $renderForm = $form->getForm();

        $renderForm->handleRequest($request);

        if ($renderForm->isSubmitted() && $renderForm->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $renderForm->getData();
            $cash = 0;
            $reservations = [];

            foreach ($data as $key => $value) {
                if ($value) {
                    $user = $this->getUser();
                    $dataWyp = new \DateTime();
                    $dataWyp->setTimestamp($date);
                    $dataWyp->setTime($key, 0);
                    $dataOdd = new \DateTime();
                    $dataOdd->setTimestamp($date);
                    $dataOdd->setTime($key + 1, 0);

                    $reservation = new Rezerwacje();
                    $reservation->setdata_oddania($dataOdd);
                    $reservation->setdata_wypozyczenia($dataWyp);
                    $reservation->setid_boiska($field);
                    $reservation->setid_uzytkownik($user);
                    $reservation->setOpłata($field->getCenaGodzina());

                    array_push($reservations, $reservation);

                    $cash += $field->getCenaGodzina();
                    $em->persist($reservation);
                    $em->flush();
                }
            }

            return $this->render('reservation/reserveField.html.twig', array(
                'cash' => $cash,
                'reservations' => $reservations
            ));
        }

        return $this->render('reservation/day.html.twig', array(
            'fieldId' => $fieldId,
            'date' => $date,
            'city' => $city,
            'form' => $renderForm->createView()
        ));
    }

    /**
     * @Route("/rezerwacja/{city}/{fieldId}", name="reservation_field")
     * @Security("is_granted('ROLE_USER')")
     */
    public function fieldAction(Request $request, $fieldId)
    {
        $en = $this->getDoctrine()->getManager();
        $field = $en->getRepository('AppBundle:Boiska')
            ->find($fieldId);

        return $this->render('reservation/field.html.twig', array(
            'field' => $field
        ));
    }

    /**
     * @Route("/rezerwacja/{city}", name="reservation_city")
     * @Security("is_granted('ROLE_USER')")
     */
    public function cityAction(Request $request, $city)
    {
        $en = $this->getDoctrine()->getManager();
        $fields = $en->getRepository('AppBundle:Boiska')
            ->findBy(array('miejscowosc' => $city));

        return $this->render('reservation/city.html.twig', array(
            'fields' => $fields
        ));
    }

    /**
     * @Route("/rezerwacja", name="reservation_index")
     * @Security("is_granted('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fields = $em->getRepository('AppBundle\Entity\Boiska')
            ->findAll();
        $cities = array();

        foreach ($fields as $field) {
            if (!in_array($field->getMiejscowosc(), $cities)) {
                array_push($cities, $field->getMiejscowosc());
            }
        }

        return $this->render('reservation/index.html.twig', array(
            'cities' => $cities
        ));
    }
}
