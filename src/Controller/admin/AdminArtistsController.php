<?php

namespace App\Controller\admin;

use App\Entity\Artists;
//use App\Entity\MusicStyles;
use App\Form\ArtistType;
use App\Form\MusicStyleType;
use App\Repository\ArtistsRepository;
use App\Repository\MusicStylesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class AdminArtistsController extends AbstractController
{

    public function __construct(ArtistsRepository $repo, MusicStylesRepository $repo_styles) {
        $this->repo = $repo;
        $this->repo_styles = $repo_styles;
    }

    #[Route('/afadmin/artists', name: 'admin_groupes_index')]
    public function index(PaginatorInterface $paginator, Request $req): Response
    {
        //$bands = $this->repo->findBy(array(), array('artist'=>'ASC'));
        $bands = $paginator->paginate(
            $this->repo->findBy(array(), array('artist'=>'ASC')),
            $req->query->getInt('page', 1),
            6
        );
        return $this->render('admin/admin_artists/index.html.twig', [
            'bands' => $bands,
        ]);
    }

    #[Route('/afadmin/artists/edit/{id}', name: 'admin_groupes_edit', methods: ['GET', 'POST'])]
    public function edit(Artists $bands, Request $request, SluggerInterface $slugger) {
        $form_edit = $this->createForm(ArtistType::class, $bands);
        $form_edit->handleRequest($request);
        if($form_edit->isSubmitted() && $form_edit->isValid()) {
            $imgFile = $form_edit->get('filename')->getData();
            if($imgFile) {
                $nameFile = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($nameFile);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();
                
                // Move the file to the directory where brochures are stored
                try {
                    $imgFile->move(
                        $this->getParameter('images_dir'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $bands->setFilename($newFilename);
                //$bands->setIdStyle();
                //$bands->setUpdatedAt();

                $em = $this->getDoctrine()->getManager();
                $em->persist($bands);
                $em->flush();
                return $this->redirectToRoute('admin_groupes_index');
            }
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

    #[Route('/afadmin/artists/del/{id}', name: 'admin_groupes_delete', methods: ['DELETE'])]
    public function delete(Artists $bands, Request $request) {
        if($this->isCsrfTokenValid('delete'.$bands->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bands);
            $em->flush();
            return $this->redirectToRoute('admin_groupes_index');
        }
    }

}
