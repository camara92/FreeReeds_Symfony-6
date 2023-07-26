<?php

namespace App\Controller\Admin;

use App\Entity\UserBook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserBookCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait; 
    public static function getEntityFqcn(): string
    {
        return UserBook::class;
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
