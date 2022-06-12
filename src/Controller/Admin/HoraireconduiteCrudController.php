<?php

namespace App\Controller\Admin;

use App\Entity\Horaireconduite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HoraireconduiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaireconduite::class;
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
