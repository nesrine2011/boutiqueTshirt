<?php

namespace App\Service;

use App\Repository\ProductRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService {

  private $repo;
  private $rs;

  //injection de dépendances hors d'un controller : constructeur
  public function __construct(ProduitRepository $repo, RequestStack $rs)
  {
    $this->repo=$repo;
    $this->rs=$rs;
   
   return ;
  }

  public function add($id)
  {
    //nous allons récupérer ou créer une session grâce à la classe RequestStack
    $session=$this->rs->getSession();

    //je récupère l'attr de session 'cart' s'il existe ou un tableau vide
    $cart=$session->get('cart', []);

    //si le produit existe déjà, j'incrémente sa quantité
    if(!empty($cart[$id])) {
        //équivaut $cart[$id] = $cart[$id]+1;
        $cart[$id]++;
    }
    else {
        //dans le tableau $cart, à la case $id, j'insère la valeur 1
        $cart[$id]=1;
    }

    //je sauvegarde l'état de mon panier en session à l'attr de session 'cart'
    $session->set('cart', $cart);

    // dd($session->get('cart'));
   
   return ;
  }

  public function remove($id)
  {
    $session=$this->rs->getSession();
        $cart=$session->get('cart', []);

        //si l'id existe dans $cart, je le supprime du tableau
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        //je sauvegarde l'état de mon panier en session à l'attr de session 'cart'
        $session->set('cart', $cart);
   
   return ;
  }
public function getCartWithData(){
    $session = $this->rs->getSession();
    $cart = $session->get('cart', []);

    ///Nous allons créer un nvo tableau qui contiendra des objets Product et les quantités de chaque objet 
    $cartWithData = [];

    foreach ($cart as $id => $quantite) {
        $cartWithData[] = [
            'produit' => $this->repo->find($id),
            'quantite' => $quantite
        ];
    }
return $cartWithData;

}
public function getTotal()

{ $cartWithData = $this->getCartWithData();
    
    
    $total = 0;

    foreach ($cartWithData as $item) {
        $totalUnitaire = $item['produit']->getPrix() * $item['quantite'];
        $total = $total + $totalUnitaire; /// Equivaut à $total+= $totalUnitaire;
    }
return $total;

}
}