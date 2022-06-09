<?php

namespace App\Controller\Admin;
use App\Entity\Drink;
use App\Entity\Pizza;
use App\Entity\Menu;
use App\Entity\Ingredient;
use App\Entity\Cart;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){}

    #[Route('/admin', name: 'admin')]

    public function index(): Response
    {
        $url=$this->adminUrlGenerator
        ->setController(DrinkCrudController::class)
        ->generateUrl();
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PizzaleroSymf');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-home', 'app_accueil');
        yield MenuItem::linkToCrud('Boissons', 'fas fa-beer', Drink::class);
        yield MenuItem::linkToCrud('Ingrédients', 'fas fa-cutlery', Ingredient::class);
        yield MenuItem::linkToCrud('Menu', 'fas fa-bars', Menu::class);
        yield MenuItem::linkToCrud('Pizza', 'fas fa-pie-chart', Pizza::class);
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Cart', 'fas fa-shopping-basket', Cart::class);
    }
}
