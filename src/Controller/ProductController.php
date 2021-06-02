<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use http\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class ProductController extends AbstractController
{
    /**
     * @Route("/{id}", name="product_detail", requirements={"id":"\d+"})
     */
    public function detail(Product $product, Request $request, CartManager $cartManager)
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $item = $form->getData();
            $item->setProduct($product);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $cartManager->save($cart);

            $this->addFlash(
                'succes',
                'Produsul a fost adaugat in cos!'
            );

            $this->redirectToRoute('product_catalog');
        }

        return $this->render('product/product_detail.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
