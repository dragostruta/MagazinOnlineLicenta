<?php

namespace App\Manager;

use App\Entity\Order;
use App\Storage\CartSessionStorage;
use App\Factory\OrderFactory;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CartManager
 * @package App\Manager
 */
class CartManager{
    /**
     * @var CartSessionStorage
     */
    private $cartSessionStorage;

    /**
     * @var OrderFactory
     */
    private $cartFactory;

    /**
     * @Var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param CartSessionStorage $cartStorage
     * @param OrderFactory $orderFactory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        CartSessionStorage $cartSessionStorage,
        OrderFactory $orderFactory,
        EntityManagerInterface $entityManager
    ){
        $this->cartSessionStorage = $cartSessionStorage;
        $this->cartFactory = $orderFactory;
        $this->entityManager = $entityManager;
    }

    public function getCurrentCart(): Order{
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart){
            $cart = $this->cartFactory->create();
        }
        return $cart;
    }

    /**
     * @param Order $cart
     */
    public function save(Order $cart): void
    {
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        $this->cartSessionStorage->setCart($cart);
    }
}