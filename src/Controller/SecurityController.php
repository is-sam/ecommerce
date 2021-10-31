<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request, AuthenticationUtils $auth): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $auth->getLastAuthenticationError(),
            'lastUsername' => $auth->getLastUsername()
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(Request $request, AuthenticationUtils $auth): void
    {
        
    }
}
