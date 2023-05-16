<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAlbumsController extends AbstractController
{
    #[Route('/afadmin/albums', name: 'admin_albums_index')]
    public function index(): Response
    {
        return $this->render('admin/admin_albums/index.html.twig', [
            'controller_name' => 'Admin Albums',
        ]);
    }
}
