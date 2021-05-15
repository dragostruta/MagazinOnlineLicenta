<?php

namespace App\Repository;

use App\Entity\Product;
use ContainerBqjnCAA\getRedirectControllerService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Header;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function sortProducts(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM product';

        if (isset($_POST['submit-search'])) {
            $searchq = $_POST['search'];
            $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
            $sql = 'SELECT * FROM product WHERE title LIKE :searchq OR brand LIKE :searchq OR description LIKE :searchq ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":searchq" => "%{$searchq}%"));

            if ($stmt->rowCount()==0){
                echo "<script>alert('Nu au fost gasite rezultate!')</script>";
                $sql = 'SELECT * FROM product';
                $stmt = $conn->prepare($sql);
                $stmt ->execute();
            }
            return $stmt->fetchAllAssociative();
        }

        if (isset($_POST['price_asc'])) {
            $sql = '
            SELECT * FROM product p
            WHERE p.price
            ORDER BY p.price ASC
            ';
        }elseif (isset($_POST['price_desc'])) {
                $sql = 'SELECT * FROM product p
                WHERE p.price
                ORDER BY p.price DESC';
        }elseif (isset($_POST['by_title'])){
            $sql = 'SELECT * FROM product 
            ORDER BY title ASC';
        }elseif (isset($_POST['by_date'])){
            $sql = 'SELECT * FROM product
            WHERE updated_at
            ORDER BY updated_at ASC';
        }

        if (isset($_POST['submit-brand'])) {
            $brandq = $_POST['submit-brand'];
            $sql = 'SELECT * FROM product WHERE brand=? ASC';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($brandq));

            return $stmt->fetchAllAssociative();
        }

        if (isset($_POST['submit-category'])){

            $categoryq = $_POST['submit-category'];
            $sql = 'SELECT * FROM product p JOIN (SELECT * FROM product_category c WHERE name = ?) c ON p.product_category_id = c.id';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array($categoryq));

            if ($stmt->rowCount()==0){
                echo "<script>alert('Nu au fost gasite produse din aceasta categorie!')</script>";
                $sql = 'SELECT * FROM product';
                $stmt = $conn->prepare($sql);
                $stmt ->execute();
            }

            return $stmt->fetchAllAssociative();
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    }
}


