<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Repository\UserRepository")
 * @ORM\Table(name="user", indexes={
 *    @ORM\Index(name="erp_users_email_idx", columns={"email"}),
 * },
 * uniqueConstraints={@ORM\UniqueConstraint(name="user_email", columns={"email"})}
 * )
 */
class User implements \JsonSerializable
{
    use BaseEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name = '';

    /**
     * @ORM\Column(name="surname", type="string", length=50, nullable=false)
     */
    private $surname = '';

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email = '';

    /**
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    private $password = '';

    /**
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar = '';

    /**
     * @var UserAuth[]
     * @ORM\OneToMany(targetEntity="Application\Entity\UserAuth", mappedBy="user", cascade={"persist"})
     */
    private $auth;

    /**
     * @var Shop[]
     * @ORM\ManyToMany(targetEntity="Application\Entity\Shop", mappedBy="users", cascade={"persist"})
     */
    private $shops;

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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return UserAuth[]
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param UserAuth[] $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return ArrayCollection<Shop>
     */
    public function getShops()
    {
        return $this->shops;
    }

    /**
     * @param User[] $shops
     */
    public function setShops($shops)
    {
        $this->shops = $shops;
    }

    private function initDefaultParams()
    {
        $this->shops = new ArrayCollection();
    }

}