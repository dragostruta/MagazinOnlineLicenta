<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CartType;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AppCustomAuthentificatorAuthenticator;

class CartController extends AbstractController
{
    /**
     * @Route ("/cart", name = "cart")
     */
    public function index(CartManager $cartManager, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null);

        $cart = $cartManager->getCurrentCart();

        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $cart->setUpdatedAt(new \DateTime());

            $cartManager->save($cart);

            return $this->redirectToRoute('cart');
        }
        if(isset($_POST['submitOrder'])){
            $user = $this->getUser();

            $cart->setUser($user);

            $cart->setStatus('trimis');

            $cartManager->save($cart);

            return $this->redirectToRoute('product_catalog');
        }

        return $this->render('cart/cart.html.twig', [
            'cart' => $cart,
            'form' => $form->createView()
        ]);
    }
}
