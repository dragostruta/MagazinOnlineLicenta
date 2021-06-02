<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\News;
use App\Entity\Order;
use App\Entity\OrderList;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/layout.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panou de administrator');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Categorie', 'fas fa-folder-open', Category::class);
        yield MenuItem::linkToCrud('Subcategorie', 'fas fa-folder-open', ProductCategory::class);
        yield MenuItem::linkToCrud('Produse', 'fas fa-box', Product::class);
        yield MenuItem::linkToCrud('Oferte', 'fas fa-newspaper', News::class);
        yield MenuItem::linkToCrud('Utilizatori', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Comenzi', 'fas fa-truck', OrderList::class);
    }
}
