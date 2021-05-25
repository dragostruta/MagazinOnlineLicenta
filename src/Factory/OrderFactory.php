<?php

namespace App\Factory;

use App\Entity\Order;
use App\Entity\OrderList;
use App\Entity\Product;
use App\Entity\User;


class OrderFactory{
    public function create(): Order{
        $order = new Order();

        $order ->setStatus(Order::STATUS_CART)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

        return $order;
    }

    public function createItem(Product $product): OrderList{
        $item = new OrderList();
        $item->setProduct($product);
        $item->setQuantity(1);

        return $item;
    }
}