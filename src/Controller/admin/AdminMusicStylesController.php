<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMusicStylesController extends AbstractController
{
    #[Route('/afadmin/styles', name: 'admin_styles_index')]
    public function index(): Response
    {
        return $this->render('admin/admin_music_styles/index.html.twig', [
            'controller_name' => 'Admin styles de musique',
        ]);
    }
}
