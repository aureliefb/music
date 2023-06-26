<?php

namespace App\Controller;

use App\Entity\Artists;
use App\Entity\ArtistSearch;
use App\Form\ArtistSearchType;
use App\Repository\ArtistsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ArtistsController extends AbstractController
{
    private $entity;

    public function __construct(ManagerRegistry $entity, ArtistsRepository $repo) {
        $this->entity = $entity;
        $this->repo = $repo;
    }

    #[Route('/artists', name: 'app_groupes')]
    public function index(PaginatorInterface $paginator, Request $req): Response
    {
        $search = new ArtistSearch();
        $form = $this->createForm(ArtistSearchType::class, $search);
        $form->handleRequest($req);
        $query = $this->repo->findMyChoice($search);
        //dump($query);
        $bands = $paginator->paginate(
            $query,
            $req->query->getInt('page', 1),
            12
        );
        dump($bands);
        return $this->render('artists/index.html.twig', [
            'bands' => $bands,
            'form' => $form->createView()
        ]);
    }

    #[Route('/artists/{id}', name: 'app_groupes_show')]
    public function show(Artists $band, PaginatorInterface $paginator, Request $req): Response
    {
        
        return $this->render('artists/show.html.twig', [
            'band' => $band
        ]);
    }
}
