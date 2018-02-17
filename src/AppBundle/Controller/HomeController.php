<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            return $this->render('home/index.html.twig');
        }
        return $this->redirectToRoute('security_login');
    }
}
