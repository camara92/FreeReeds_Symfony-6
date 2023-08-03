<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Invitation;
use App\Entity\Publisher;
use App\Entity\Status;
use App\Entity\User;
use App\Entity\UserBook;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){


    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url=$this->adminUrlGenerator
        ->setController(BookCrudController::class)
        ->generateUrl();
        return $this->redirect($url);
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FreeReads' );
         
           
    }
    

    public function configureMenuItems(): iterable
    {
       
        yield MenuItem::linkToCrud('Livres', 'fas fa-book', Book::class);
        yield MenuItem::linkToCrud('Invitations', 'fas fa-envelope-open-text', Invitation::class);
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-user-pen',  Author::class);
        yield MenuItem::linkToCrud('Editeurs', 'fas fa-building', Publisher::class);
        yield MenuItem::linkToCrud('Status', 'fas fa-info-circle', Status::class);
        yield MenuItem::linkToCrud('Livres lus', 'fas fa-list', UserBook::class);
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-user', User::class);
      

        
    }
}