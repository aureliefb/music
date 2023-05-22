<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $auth): Response
    {
        $error = $auth->getLastAuthenticationError();
        $last_username = $auth->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $last_username,
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(AuthenticationUtils $auth): Response
    {
        return $this->redirectToRoute('app_groupes');
    }
}
