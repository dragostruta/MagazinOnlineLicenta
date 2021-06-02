<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Product;
use App\Repository\NewsRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route ("/oferte", name="news")
     */
    public function show(NewsRepository $newsRepository, ProductRepository $productRepository): Response
    {


        if (isset($_POST['like'])){

        }

        return $this->render('news/news.html.twig', [
            'news' => $newsRepository->findAll(),
            'product' => $productRepository->findAll(),
        ]);
    }
}
