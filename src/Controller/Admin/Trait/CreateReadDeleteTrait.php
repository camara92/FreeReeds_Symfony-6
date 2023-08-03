<?php
 namespace App\Controller\Admin\Trait;
 use EasyCorp\Bundle\EasyAdminBundle\Config\Action; 
 use EasyCorp\Bundle\EasyAdminBundle\Config\Actions; 
 use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; 

 trait CreateReadDeleteTrait
  {
    public function configureActions(Actions $actions): Actions {
      //  $actions = parent::configureActions(); 
      // desactiver la fonction d'édition 
        $actions->disable(Action::EDIT);
        $actions->add(Crud::PAGE_INDEX, Action::DETAIL); 

        return $actions; 
    }
  }

?>