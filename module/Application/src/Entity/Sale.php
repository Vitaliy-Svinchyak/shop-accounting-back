<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Repository\SaleRepository")
 * @ORM\Table(name="sale")
 */
class Sale
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="sale_price", type="integer", nullable=false)
     */
    private $salePrice;

    /**
     * @var string
     * @ORM\Column(name="size", type="string", nullable=false)
     */
    private $size;

    /**
     * @var int
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count;

    /**
     * @var bool
     * @ORM\Column(name="show", type="boolean", nullable=false)
     */
    private $show = true;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $author;

    /**
     * @var Stock
     * @ORM\ManyToOne(targetEntity="Application\Entity\Stock")
     * @ORM\JoinColumn(name="stock_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $stock;

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
     * @return int
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * @param int $salePrice
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return bool
     */
    public function isShow()
    {
        return $this->show;
    }

    /**
     * @param bool $show
     */
    public function setShow($show)
    {
        $this->show = $show;
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
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }

    /**
     * @param Stock $stock
     */
    public function setStock(Stock $stock)
    {
        $this->stock = $stock;
    }
}