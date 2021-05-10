<?php

namespace App\Controller\Admin;

use App\Controller\AccueilController;
use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Prets;
use App\Entity\Proprietaires;
use App\Entity\Stagiaires;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(ArticleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AGIRabcd PRETS');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Aller à la page d\'accueil', 'fa fa-home', 'home');
        // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Propriétaires', 'fas fa-users', Proprietaires::class);
        yield MenuItem::linkToCrud('Stagiaires', 'fas fa-male', Stagiaires::class);
        yield MenuItem::linkToCrud('Articles', 'fas fa-laptop', Articles::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('Prêts', 'fas fa-retweet', Prets::class);
    }
}
