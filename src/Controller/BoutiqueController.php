<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoutiqueController extends AbstractController
{
    #[Route('/', name: 'app_boutique')]
    public function index(ProduitRepository $repo): Response
    {
        //pour récuperer le repository, passer en arg de la methode index()
        //cela s'appelle une injection de dépendance
        $produits=$repo->findAll(); //findAll() pour récupérer tous les articles en BDD
        return $this->render('boutique/index.html.twig', [
            'produit' => $produits //envoie les articles au template
        ]);
        //render() permet d'afficher le contenu d'un template
    }
}
