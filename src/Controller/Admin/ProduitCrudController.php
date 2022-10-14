<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('description')->setMaxLength(20),
            TextField::new('collection'),
            TextField::new('couleur'),
            TextField::new('taille'),
            TextField::new('photo'),
            IntegerField::new('prix'),
            IntegerField::new('stock'),
            DateTimeField::new('dateEnregistrement')->setFormat("d/M/Y à H:m:s")->hideOnForm(),
            
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $Produit = new $entityFqcn;
        $Produit->setDateEnregistrement(new \DateTime);
        
        return $Produit;
    
    }   
}


// id_produit (int 11) PK - AI
// - titre (varchar 255) 
// - description (text)
// - couleur (varchar 50)
// - taille (varchar 50)
// - collection (enum [m,f])
// - photo (varchar 255)
// - prix (int 11)
// - stock (int 11)
// - date_enregistrement (datetime)