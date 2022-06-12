<?php

namespace App\Controller\Admin;

use App\Entity\Renseignement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RenseignementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Renseignement::class;
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
