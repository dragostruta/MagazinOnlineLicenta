<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Flex\SymfonyBundle;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_one;

    /**
     * @return mixed
     */
    public function getImageOne()
    {
        return $this->image_one;
    }

    /**
     * @param mixed $image_one
     */
    public function setImageOne($image_one): void
    {
        $this->image_one = $image_one;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_two;

    /**
     * @return mixed
     */
    public function getImageTwo()
    {
        return $this->image_two;
    }

    /**
     * @param mixed $image_two
     */
    public function setImageTwo($image_two): void
    {
        $this->image_two = $image_two;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_three;

    /**
     * @return mixed
     */
    public function getImageThree()
    {
        return $this->image_three;
    }

    /**
     * @param mixed $image_three
     */
    public function setImageThree($image_three): void
    {
        $this->image_three = $image_three;
    }

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct(){
        $this->updatedAt = new \DateTime();
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if($imageFile){
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @ORM\ManyToOne(targetEntity=News::class, inversedBy="products")
     */
    private $news;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productCategory;

    /**
     * @ORM\OneToMany (targetEntity=OrderList::class, mappedBy="orderList")
     */
    private $orderList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getNews(): ?News
    {
        return $this->news;
    }

    public function setNews(?News $news): self
    {
        $this->news = $news;

        return $this;
    }

    public function getProductCategory(): ?ProductCategory
    {
        return $this->productCategory;
    }

    public function setProductCategory(?ProductCategory $productCategory): self
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    public function getOrderList(): ?OrderList
    {
        return $this->orderList;
    }

    public function setOrderList(?OrderList $orderList): self
    {
        $this->orderList = $orderList;

        return $this;
    }

    public function  __toString(): string
    {
        return ' nume: '.$this->getTitle().
                ' pret: '.$this->getPrice().
                ' descriere: '.$this->getDescription();
    }
}
