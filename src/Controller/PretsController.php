<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Prets;
use App\Entity\Stagiaires;
use App\Entity\Utilisateur;
use App\Form\EditPretsType;
use App\Form\PretsType;
use App\Repository\ArticlesRepository;
use App\Repository\PretsRepository;
use \Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prets")
 */
class PretsController extends AbstractController
{

    /**
     * @Route("/creer", name="prets_new", methods={"GET","POST"})
     */
    public function new(Request $request, ArticlesRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $articles = $this->getDoctrine()->getRepository(Articles::class)->getCustomInformations();
        $stagiaires = $this->getDoctrine()->getRepository(Prets::class)->findStagiairesAyantPretEnCours();

        $pret = new Prets();
        $form = $this->createForm(PretsType::class, $pret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->all();

            foreach ($stagiaires as $st){
                if (in_array($pret->getStagiaire()->getId(), $st)) {
                $this->addFlash('warning', 'Ce stagiaire a déjà un prêt en cours ! Veuillez le mettre à jour');
                }
                else{
                    if ($data['articles']) {
                        foreach($data['articles'] as $id) {
                            $article = $repo->findOneBy(['id' => $id]);
                            $pret->addArticlesPrete($article);
                        }
                    }
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($pret);
                    $entityManager->flush();

                    return $this->redirectToRoute('home');
                }
            }
        }

        return $this->render('prets/new.html.twig', [
            'pret' => $pret,
            'form' => $form->createView(),
            'arts' => $articles,
        ]);
    }

    /**
     * @Route("/pret/{id}", name="prets_show", methods={"GET"})
     */
    public function show(Prets $pret): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $articles = $this->getDoctrine()->getRepository(Articles::class)->getArticlesParPret($pret->getId());
        // dd($articles);
        return $this->render('prets/show.html.twig', [
            'pret' => $pret,
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/stagiaire/{id}/prets", name="prets_stagiaire", methods={"GET"})
     */
    public function stagiairesPrests(Stagiaires $stagiaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $prets = $this->getDoctrine()->getRepository(Prets::class)->findBy(['stagiaire' => $stagiaire]);

        return $this->render('prets/index.html.twig', [
            'prets' => $prets,
            'stagiaire' => $stagiaire,
        ]);
    }


    /**
     * @Route("/{id}", name="prets_articles", methods={"GET"})
     */
    public function articlesPret(Prets $pret): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $articles = $this->getDoctrine()->getRepository(Articles::class)->findByPret($pret->getId());

        return $this->render('prets/articlesPret.html.twig', [
            'pret' => $pret,
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="prets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prets $pret, ArticlesRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(EditPretsType::class, $pret);
        $form->handleRequest($request);

        $articles = [];
        $arts = $repo->getCustomInformations();

        if ($arts) {
            foreach($arts as $id) {
                array_push($articles, $repo->findOneBy(['id' => $id]));
            }
        }

        foreach($pret->getArticlesPretes() as $art) {
            array_push($articles, $art);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->all();

            if ($data['articles']) {
                foreach($pret->getArticlesPretes() as $art) {
                    $pret->removeArticlesPrete($art);
                }
                foreach($data['articles'] as $id) {
                    $article = $repo->findOneBy(['id' => $id]);
                    $pret->addArticlesPrete($article);
                }
            }
            $pret->setDateDebut(new \DateTime());
            if ($pret->getIsReturned() == true){
                $pret->setDateFin(new \DateTime());
            }else{
                $pret->setDateFin(null);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pret);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('prets/edit.html.twig', [
            'pret' => $pret,
            'artsPrets' => $pret->getArticlesPretes(),
            'form' => $form->createView(),
            'arts' => $articles,
            'artsNew' => $arts,
        ]);
    }

    /**
     * @Route("/{id}/retouner", name="prets_return", methods={"GET","POST"})
     */
    public function returned(Request $request, Prets $pret)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $this->denyAccessUnlessGranted('ROLE_USER');

        $response = array("ok" => true, "response" => "Article(s) retourné(s) !");

        try {
           $pret->setIsReturned(true);
           $pret->setDateFin(new \DateTime());

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Article(s) retourné(s) !');

        } catch (Exception $e) {
            $response["ok"] = false;
            $this->addFlash('success', "Quelque chose s'est mal passée !");
        }
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/supprimer", name="prets_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Prets $pret): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isCsrfTokenValid('delete'.$pret->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pret);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
