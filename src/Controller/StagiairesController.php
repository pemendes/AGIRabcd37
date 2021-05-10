<?php

namespace App\Controller;

use App\Entity\Stagiaires;
use App\Form\StagiairesType;
use App\Repository\StagiairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stagiaires")
 */
class StagiairesController extends AbstractController
{
    /**
     * @Route("/", name="stagiaires_index", methods={"GET"})
     */
    public function index(StagiairesRepository $stagiairesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('stagiaires/index.html.twig', [
            'stagiaires' => $stagiairesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="stagiaires_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $stagiaire = new Stagiaires();
        $form = $this->createForm(StagiairesType::class, $stagiaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            return $this->redirectToRoute('stagiaires_index');
        }

        return $this->render('stagiaires/new.html.twig', [
            'stagiaire' => $stagiaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stagiaires_show", methods={"GET"})
     */
    public function show(Stagiaires $stagiaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('stagiaires/show.html.twig', [
            'stagiaire' => $stagiaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stagiaires_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Stagiaires $stagiaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(StagiairesType::class, $stagiaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stagiaires_index');
        }

        return $this->render('stagiaires/edit.html.twig', [
            'stagiaire' => $stagiaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stagiaires_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Stagiaires $stagiaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isCsrfTokenValid('delete'.$stagiaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stagiaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stagiaires_index');
    }
}
