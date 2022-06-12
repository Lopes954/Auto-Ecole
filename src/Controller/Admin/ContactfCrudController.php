<?php

namespace App\Controller\Admin;

use App\Entity\Contactf;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactfCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contactf::class;
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
