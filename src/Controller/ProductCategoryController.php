<?php

namespace App\Controller;

use App\Repository\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductCategoryController extends AbstractController

{
    /**
     * @Route ("/test1")
     */
    public function show(ProductCategoryRepository $productCategoryRepository): Response
    {
        return $this->render('product_catalog/product_categories.html.twig',[
            'product_categories' => $productCategoryRepository->findAll(),
        ]);
    }
}
