<?php

namespace App\Controller\Admin;

use App\Entity\Stagiaires;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StagiaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stagiaires::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
