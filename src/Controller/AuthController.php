<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/compte/connexion', name: 'auth_login')]
    public function login(): Response
    {
        $loginForm = $this->createForm(LoginType::class);

        return $this->render('auth/index.html.twig', [
            'loginForm' => $loginForm->createView(),
        ]);
    }

    #[Route('/compte/inscription', name: 'auth_register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig');
    }
}
