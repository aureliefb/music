<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertsController extends AbstractController
{
    #[Route('/concerts', name: 'app_concerts')]
    public function index(): Response
    {
        return $this->render('concerts/index.html.twig', [
            'controller_name' => 'ConcertsController',
        ]);
    }
}
