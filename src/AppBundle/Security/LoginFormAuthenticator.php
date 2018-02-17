<?php

namespace AppBundle\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 26.11.2017
 * Time: 13:49
 */

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;
    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    public function __construct(\Symfony\Component\Form\FormFactoryInterface $formFactory,
        \Doctrine\ORM\EntityManager $em,
        \Symfony\Component\Routing\RouterInterface $router,
        UserPasswordEncoder $encoder)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->encoder = $encoder;
    }

    public function getCredentials(\Symfony\Component\HttpFoundation\Request $request)
    {
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
        if (!$isLoginSubmit) {
            return;
        }

        $form = $this->formFactory->create(\AppBundle\Form\LoginForm::class);
        $form->handleRequest($request);
        $data = $form->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_username']
        );

        return $data;
    }

    public function getUser($credentials, \Symfony\Component\Security\Core\User\UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];

        return $this->em->getRepository('AppBundle:Uzytkownicy')
            ->findOneBy(['login' => $username]);
    }

    public function checkCredentials($credentials, \Symfony\Component\Security\Core\User\UserInterface $user)
    {
        $password = $credentials['_password'];

        if ($this->encoder->isPasswordValid($user, $password)) {
            return true;
        }

        return false;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }

    protected function getDefaultSuccessRedirectUrl() {
        return $this->router->generate('homepage');
    }
}