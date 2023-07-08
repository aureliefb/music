<?php

namespace App\Controller\admin;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


class AdminCountryController extends AbstractController
{

    public function __construct(CountryRepository $repo) {
        $this->repo = $repo;
    }

    #[Route('/afadmin/country', name: 'admin_country_index')]
    public function index(PaginatorInterface $paginator, Request $req): Response
    {
        $countries = $paginator->paginate(
            $this->repo->findBy(array(), array('country'=>'ASC')),
            $req->query->getInt('page', 1),
            6
        );
        return $this->render('admin/admin_country/index.html.twig', [
            'countries' => $countries,
        ]);
    }

    #[Route('/afadmin/country/edit/{id}', name: 'admin_country_edit', methods: ['GET', 'POST'])]
    public function edit(Country $country, Request $request) {
        $form_edit = $this->createForm(CountryType::class, $country);
        $form_edit->handleRequest($request);
        if($form_edit->isSubmitted() && $form_edit->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_country_index');
        }
        return $this->render('admin/admin_country/edit.html.twig', [
            'country' => $country,
            'form' => $form_edit->createView()
        ]);
    }

    #[Route('/afadmin/country/new', name: 'admin_country_new')]
    public function new(Request $request) {
        $country = new Country();
        $form_new = $this->createForm(CountryType::class, $country);
        $form_new->handleRequest($request);
        if($form_new->isSubmitted() && $form_new->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();
            return $this->redirectToRoute('admin_country_index');
        }
        return $this->render('admin/admin_country/new.html.twig', [
            'country' => $country,
            'form' => $form_new->createView()
        ]);
    }

    #[Route('/afadmin/country/del/{id}', name: 'admin_country_delete', methods: ['DELETE'])]
    public function delete(Country $country, Request $request) {
        if($this->isCsrfTokenValid('delete'.$country->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($country);
            $em->flush();
            return $this->redirectToRoute('admin_country_index');
        }
    }
}
