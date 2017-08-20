<?php

namespace Application\Service;

use Application\Entity\User;
use Application\Entity\UserAuth;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Storage\StorageInterface;
use Zend\Math\Rand;

class AuthStorage implements StorageInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var UserAuth
     */
    private $identity;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Defined by Zend\Authentication\Storage\StorageInterface
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->identity === null;
    }

    /**
     * Defined by Zend\Authentication\Storage\StorageInterface
     *
     * @return UserAuth
     */
    public function read()
    {
        return $this->identity;
    }

    /**
     * Defined by Zend\Authentication\Storage\StorageInterface
     *
     * @param  User $contents
     *
     * @return void
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Zend\Math\Exception\DomainException
     */
    public function write($contents)
    {

        $userAuth = new UserAuth();
        $userAuth->setUser($contents);
        $userAuth->setHash(Rand::getString(100));

        $this->identity = $userAuth;

        $this->em->persist($userAuth);
        $this->em->flush($userAuth);
    }

    /**
     * Defined by Zend\Authentication\Storage\StorageInterface
     *
     * @return void
     */
    public function clear()
    {
        $this->identity = null;
    }
}