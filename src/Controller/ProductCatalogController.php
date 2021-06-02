<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductCatalogController extends AbstractController
{
    /**
     * @Route ("/catalog_de_produse", name="product_catalog")
     */
    public function show(ProductRepository $productRepository): Response
    {
        return $this->render('product_catalog/product_catalog.html.twig',[
            'products' => $productRepository->sortProducts(),
        ]);
    }
}
