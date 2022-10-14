<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('image'),
            TextareaField::new('content','contenu')->setFormattedValue(20)->hideOnForm(),
            DateTimeField::new('createdAt')->setFormat("d/M/Y à H:m:s")->hideOnForm(),
            AssociationField::new('category'),
            TextEditorField::new('content')->onlyOnForms(),
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $Commande = new $entityFqcn;
        $Commande->setDateEnregistrement(new \DateTime);
        return $Commande;
    
    } 
}

