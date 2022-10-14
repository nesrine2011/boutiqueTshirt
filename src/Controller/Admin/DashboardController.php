<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Boutique Tshirt');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Accueil','fa fa-home'), // génère un lien vers ce dashboard
            MenuItem::section('Blog'),  // créer une section pour catégoriser les items du menu
            MenuItem::linkToCrud('Produits','fas fa-newspaper', Produit::class),
            MenuItem::section('Membres'),
            MenuItem::linkToCrud('Utilisateurs','fas fa-user', Membre::class),
        ];
    }
}
