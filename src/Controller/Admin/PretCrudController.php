<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Prets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PretCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prets::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('stagiaire'),
            CollectionField::new('articlesPretes', 'Article(s)'),
            DateField::new('dateDebut', 'Date du prêt'),
            DateField::new('dateFin', 'Date de retour'),
            TextEditorField::new('commentaireDebut', 'Commentaire lors du prêt'),
            TextEditorField::new('commentaireFin', 'Commentaire lors du retour'),
            BooleanField::new('IsReturned', 'Retourné ?'),
            BooleanField::new('validation'),
        ];
    }

}
