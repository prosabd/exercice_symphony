<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/', name: 'nonepage')]
    public function nonepage(): Response
    {
        return $this->render('Registration/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('Login/login.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
    #[Route('/signin', name: 'app_signin')]
    public function signin(): Response
    {
        return $this->render('Registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
    
    #[Route('/login', name: 'home')]
    public function home(): Response
    {
        return $this->render('list/index.html.twig', [
            'controller_name' => 'ListController',
        ]);
    }
     
}
