<?php

namespace App\Controller;

use App\Entity\Proprietaires;
use App\Form\ProprietairesType;
use App\Repository\ProprietairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proprietaires")
 */
class ProprietairesController extends AbstractController
{
    /**
     * @Route("/", name="proprietaires_index", methods={"GET"})
     */
    public function index(ProprietairesRepository $proprietairesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('proprietaires/index.html.twig', [
            'proprietaires' => $proprietairesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="proprietaires_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $proprietaire = new Proprietaires();
        $form = $this->createForm(ProprietairesType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proprietaire);
            $entityManager->flush();

            return $this->redirectToRoute('proprietaires_index');
        }

        return $this->render('proprietaires/new.html.twig', [
            'proprietaire' => $proprietaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proprietaires_show", methods={"GET"})
     */
    public function show(Proprietaires $proprietaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('proprietaires/show.html.twig', [
            'proprietaire' => $proprietaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="proprietaires_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Proprietaires $proprietaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(ProprietairesType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proprietaires_index');
        }

        return $this->render('proprietaires/edit.html.twig', [
            'proprietaire' => $proprietaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proprietaires_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Proprietaires $proprietaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isCsrfTokenValid('delete'.$proprietaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proprietaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proprietaires_index');
    }
}
