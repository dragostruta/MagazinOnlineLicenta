<?php

namespace App\Entity;

use App\Repository\OrderListRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrderListRepository::class)
 */
class OrderList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     */
    private $quantity;

    /**
     * @ORM\ManyToOne (targetEntity=Product::class)
     * @ORM\JoinColumn (nullable = false)
     */
    private $product;
    /**
     * @ORM\ManyToOne (targetEntity=Order::class, inversedBy = "items")
     * @ORM\JoinColumn (nullable = false)
     */
    private $orderRef;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return float|int
     */
    public function getTotal(): float
    {
        return $this->getProduct()->getPrice() * $this->getQuantity();
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getProduct(): ?Product{
        return $this->product;
    }

    public function setProduct(?Product $product): self{
        $this->product = $product;

        return $this;
    }

    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Order $orderRef): self{
        $this->orderRef = $orderRef;

        return $this;
    }

    /**
     * @param OrderList $item
     *
     * @return bool
     */
    public function equals(OrderList $item): bool{
        return $this->getProduct()->getId() === $item->getProduct()->getId();
    }
}
