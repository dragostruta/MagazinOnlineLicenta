<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany (targetEntity=OrderList::class, mappedBy="orderRef", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $items;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = self::STATUS_CART;

    /**
     * @var string
     */
    const STATUS_CART = 'in cos';

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $created_at;
    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct(){
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|OrderList[]
     */
    public function getItems(): Collection{
        return $this->items;
    }
    public function addItem(OrderList $item): self{
        foreach ($this->getItems() as $existingItem)
        if($existingItem->equals($item)){
            $existingItem->setQuantity(
                $existingItem->getQuantity() + $item->getQuantity()
            );
            return $this;
        }

        $this->items[] = $item;
        $item->setOrderRef($this);

        return $this;
    }

    /**
     * @return $this
     */
    public function removeItem(OrderList $item): self{
        if ($this->items->removeElement($item)){
            if ($item->getOrderRef() === $this){
                $item->setOrderRef(null);
            }
        }
        return $this;
    }

    public function removeItems(): self{
        foreach ($this->getItems() as $item){
            $this->removeItem($item);
        }
        return $this;
    }

    public function getStatus(): ?string{
        return $this->status;
    }

    public function setStatus(string $status): self{
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface{
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self{
        $this->created_at = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface{
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updateAt): self{
        $this->updatedAt = $updateAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float{
        $total = 0;

        foreach ($this->getItems() as $item){
            $total += $item->getTotal();
        }

        return $total;
    }

    public function __toString(){
        return "id: ".$this->id.
            " status: ".$this->status;
    }
}
