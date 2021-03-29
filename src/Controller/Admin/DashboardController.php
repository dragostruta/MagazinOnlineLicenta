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
            ->setTitle('Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Category', 'fas fa-folder-open', Category::class);
        yield MenuItem::linkToCrud('ProductCategories', 'fas fa-folder-open', ProductCategory::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-box', Product::class);
        yield MenuItem::linkToCrud('News', 'fas fa-newspaper', News::class);
        yield MenuItem::linkToCrud('Orders', 'fas fa-truck', Order::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
