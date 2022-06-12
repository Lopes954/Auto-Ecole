<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Forfait;
use App\Entity\Calendar;
use App\Entity\Contactf;
use App\Entity\Categorie;
use App\Entity\Horairebureau;
use App\Entity\Renseignement;
use App\Entity\Horaireconduite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index() : Response
    {
        return $this->render('admin/dashboard.html.twig');    
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tableau de Bord');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-user-circle', User::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-mail-bulk', Contactf::class);
        yield MenuItem::linkToCrud('Question utilisateur', 'fas fa-question-circle', Renseignement::class);
        yield MenuItem::linkToCrud('Horaire de bureau', 'fas fa-building', Horairebureau::class);
        yield MenuItem::linkToCrud('Horaire de conduite', 'fas fa-car', Horaireconduite::class);
        yield MenuItem::linkToCrud('Forfait', 'fas fa-euro-sign', Forfait::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-boxes', Categorie::class);
        yield MenuItem::linkToCrud('Reservation', 'fas fa-calendar-alt', Calendar::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
