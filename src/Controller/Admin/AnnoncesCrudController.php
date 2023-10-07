<?php

namespace App\Controller\Admin;

use App\Entity\Annonces;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnnoncesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Annonces::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('date'),
            TextField::new('title'),
            TextareaField::new('content'),
            TextField::new('link'),
            AssociationField::new('jeu'),
        ];
    }
}
