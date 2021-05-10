<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('reference'),
            TextField::new('nom'),
            TextField::new('marque'),
            TextEditorField::new('description'),
            AssociationField::new('categorie', 'Catégorie'),
            AssociationField::new('proprietaire'),
            ChoiceField::new('etat', 'Etat')
            ->setChoices([
                'Operationnel' => 0,
                'En panne' => 1,
                'HS' => 2
            ]),
            // DateField::new('dateArrivee', 'Date d\'arrivée'),
            ImageField::new('image')
                 ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash.[extension]'),
            TextEditorField::new('commentaire'),

        ];
    }

}
