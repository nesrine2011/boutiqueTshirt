<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Service\CartService;
use Doctrine\ORM\EntityManager;
use App\Repository\ProductRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cs): Response
    {
$cartWithData= $cs->getCartWithData();
 $total = $cs->getTotal();      

       
        
        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' => $total
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add($id, CartService $cs)
    {

        $cs->add($id);

        return $this->redirectToRoute('app_cart');

    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove($id, CartService $cs)
    {

        $cs->remove($id);

        return $this->redirectToRoute('app_cart');

    }
#[Route('/commande', name: 'app_commande')]
public function commande(EntityManagerInterface $manager, CartService $cs)

{
    $cartWithData= $cs->getCartWithData();
    foreach($cartWithData as $item){

       $commande = new Commande;
       $commande->setQuantite($item['quantite']);
        $commande->setEtat('en cours de traitement');
        $commande->setIdMembre($this->getUser());
        $commande->setIdProduit($item['produit']);
        $commande->setDateEnregistrement(new \DateTime);
        $prixProduit = $item['produit']->getPrix();
        $quantite = $item['quantite'];
        $montant =$prixProduit * $quantite;
       $commande->setMontant($montant);
        
       $manager->persist($commande);
       $manager->flush();
       

    }
    
    
    
    
    return $this->redirectToRoute('app_boutique');



}

}






