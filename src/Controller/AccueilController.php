<?php

namespace App\Controller;

use App\Repository\PretsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PretsRepository $pretsRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('accueil/index.html.twig', [
            'prets' => $pretsRepository->findAll(),
        ]);
    }
}
