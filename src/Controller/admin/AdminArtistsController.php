<?php

namespace App\Controller\admin;

use App\Entity\Artists;
use App\Form\ArtistType;
use App\Repository\ArtistsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArtistsController extends AbstractController
{

    public function __construct(ArtistsRepository $repo) {
        $this->repo = $repo;
    }

    #[Route('/afadmin/artists', name: 'admin_groupes_index')]
    public function index(): Response
    {
        $bands = $this->repo->findAll();
        return $this->render('admin/admin_artists/index.html.twig', [
            'bands' => $bands,
        ]);
    }

    #[Route('/afadmin/artists/{id}', name: 'admin_groupes_edit', methods: ['GET', 'POST'])]
    public function edit(Artists $bands, Request $request) {
        $form_edit = $this->createForm(ArtistType::class, $bands);
        $form_edit->handleRequest($request);
        if($form_edit->isSubmitted() && $form_edit->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_groupes_index');
        }
        return $this->render('admin/admin_artists/edit.html.twig', [
            'band' => $bands,
            'form' => $form_edit->createView()
        ]);
    }

    #[Route('/afadmin/artists/new', name: 'admin_groupes_new')]
    public function new(Request $request) {
        $band = new Artists();
        $form_new = $this->createForm(ArtistType::class, $band);
        $form_new->handleRequest($request);
        if($form_new->isSubmitted() && $form_new->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($band);
            $em->flush();
            return $this->redirectToRoute('admin_groupes_index');
        }

        return $this->render('admin/admin_artists/new.html.twig', [
            'band' => $band,
            'form' => $form_new->createView()
        ]);
    }

    #[Route('/afadmin/artists/{id}', name: 'admin_groupes_delete', methods: ['DELETE'])]
    public function delete(Artists $bands, Request $request) {
        if($this->isCsrfTokenValid('delete'.$bands->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bands);
            $em->flush();
            return $this->redirectToRoute('admin_groupes_index');
        }
    }

}
