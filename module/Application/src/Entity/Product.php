<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product implements \JsonSerializable
{

    use BaseEntity;
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="photo", type="string", nullable=false)
     */
    private $photo;

    /**
     * @var string
     * @ORM\Column(name="firm", type="string", nullable=false)
     */
    private $firm;

    /**
     * @var integer
     * @ORM\Column(name="buy_price", type="integer", nullable=false)
     */
    private $buyPrice;

    /**
     * @var integer
     * @ORM\Column(name="sale_price", type="integer", nullable=false)
     */
    private $salePrice;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $author;

    /**
     * @var ProductToStock[]
     * @ORM\OneToMany(targetEntity="Application\Entity\ProductToStock", mappedBy="id")
     */
    private $productsToStock;

    public function __construct()
    {
        $this->initDefaultParams();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getFirm(): string
    {
        return $this->firm;
    }

    /**
     * @param string $firm
     */
    public function setFirm(string $firm)
    {
        $this->firm = $firm;
    }

    /**
     * @return int
     */
    public function getBuyPrice(): int
    {
        return $this->buyPrice;
    }

    /**
     * @param int $buyPrice
     */
    public function setBuyPrice(int $buyPrice)
    {
        $this->buyPrice = $buyPrice;
    }

    /**
     * @return int
     */
    public function getSalePrice(): int
    {
        return $this->salePrice;
    }

    /**
     * @param int $salePrice
     */
    public function setSalePrice(int $salePrice)
    {
        $this->salePrice = $salePrice;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    /**
     * @return ProductToStock[]
     */
    public function getProductsToStock()
    {
        return $this->productsToStock;
    }

    /**
     * @param ProductToStock[] $productsToStock
     */
    public function setProductsToStock($productsToStock)
    {
        $this->productsToStock = $productsToStock;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    private function initDefaultParams()
    {
        $this->productsToStock = new ArrayCollection();
    }
}