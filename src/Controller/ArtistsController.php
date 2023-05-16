<?php

namespace App\Controller;

use App\Entity\Artists;
use App\Repository\ArtistsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistsController extends AbstractController
{
    private $entity;

    public function __construct(ManagerRegistry $entity, ArtistsRepository $repo) {
        $this->entity = $entity;
        $this->repo = $repo;
    }

    #[Route('/artists', name: 'app_groupes')]
    public function index(): Response
    {
        $bands = $this->repo->findAll();
        return $this->render('artists/index.html.twig', [
            'bands' => $bands,
        ]);
    }
}
