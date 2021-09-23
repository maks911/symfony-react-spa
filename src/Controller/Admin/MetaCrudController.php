<?php

namespace App\Controller\Admin;

use App\Entity\Meta;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MetaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Meta::class;
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
