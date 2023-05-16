<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumsController extends AbstractController
{
    #[Route('/albums', name: 'app_albums')]
    public function index(): Response
    {
        return $this->render('albums/index.html.twig', [
            'controller_name' => 'Mes albums',
        ]);
    }
}
