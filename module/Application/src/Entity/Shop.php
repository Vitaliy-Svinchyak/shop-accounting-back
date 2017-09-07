<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="Application\Repository\ShopRepository")
 * @ORM\Table(name="shop")
 */
class Shop implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;


    /**
     * @var User[]|Collection
     * @ORM\ManyToMany(targetEntity="Application\Entity\User", inversedBy="shop", cascade={"persist"})
     * @ORM\JoinTable(
     *     name="user_to_shop",
     *     joinColumns={
     *         @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *     }
     * )
     */
    private $users;

    /**
     * @var Stock[]
     * @ORM\OneToMany(targetEntity="Application\Entity\Stock", mappedBy="shop")
     */
    private $stocks;

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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        if (!$this->hasUser($user)) {
            $this->users[] = $user;
        }
    }

    /**
     * @param User $user
     */
    public function removeUser(User $user)
    {
        if ($this->hasUser($user)) {
            $this->users->removeElement($user);
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasUser(User $user): bool
    {
        return $this->getUsers()->contains($user);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    private function initDefaultParams()
    {
        $this->users = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    /**
     * @return Stock[]
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * @param Stock[] $stocks
     */
    public function setStocks($stocks)
    {
        $this->stocks = $stocks;
    }


}