<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminConcertsController extends AbstractController
{

    #[Route('/afadmin/concerts', name: 'admin_concerts_index')]
    public function index(): Response
    {
        return $this->render('admin/admin_concerts/index.html.twig', [
            'controller_name' => 'Admin concerts',
        ]);
    }
}
