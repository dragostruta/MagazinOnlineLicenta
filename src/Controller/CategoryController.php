<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/test", name = "test")
     */
    public function show(CategoryRepository $categoryRepository): Response
    {
        return $this->render('product_catalog/test.html.twig',[
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
