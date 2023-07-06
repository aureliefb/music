<?php

namespace App\Controller\admin;

use App\Entity\Style;
use App\Form\MusicStyleType;
use App\Repository\StyleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class AdminMusicStylesController extends AbstractController
{
    public function __construct(StyleRepository $repo) {
        $this->repo = $repo;
    }

    #[Route('/afadmin/styles', name: 'admin_styles_index')]
    public function index(PaginatorInterface $paginator, Request $req): Response
    {
        //$styles = $this->repo->findBy(array(), array('music_style'=>'ASC'));
        $styles = $paginator->paginate(
            $this->repo->findBy(array(), array('style'=>'ASC')),
            $req->query->getInt('page', 1),
            6
        );
        return $this->render('admin/admin_music_styles/index.html.twig', [
            'styles' => $styles
        ]);
    }

    #[Route('/afadmin/styles/edit/{id}', name: 'admin_styles_edit', methods: ['GET', 'POST'])]
    public function edit(Style $style, Request $request) {
        $form_edit = $this->createForm(MusicStyleType::class, $style);
        $form_edit->handleRequest($request);
        if($form_edit->isSubmitted() && $form_edit->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_styles_index');
        }
        return $this->render('admin/admin_music_styles/edit.html.twig', [
            'style' => $style,
            'form' => $form_edit->createView()
        ]);
    }

    #[Route('/afadmin/styles/new', name: 'admin_styles_new')]
    public function new(Request $request) {
        $style = new Style();
        $form_new = $this->createForm(MusicStyleType::class, $style);
        $form_new->handleRequest($request);
        if($form_new->isSubmitted() && $form_new->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($style);
            $em->flush();
            return $this->redirectToRoute('admin_styles_index');
        }
        return $this->render('admin/admin_music_styles/new.html.twig', [
            'style' => $style,
            'form' => $form_new->createView()
        ]);
    }

    #[Route('/afadmin/styles/del/{id}', name: 'admin_styles_delete', methods: ['DELETE'])]
    public function delete(Style $styles, Request $request) {
        if($this->isCsrfTokenValid('delete'.$styles->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($styles);
            $em->flush();
            return $this->redirectToRoute('admin_styles_index');
        }
    }
}
