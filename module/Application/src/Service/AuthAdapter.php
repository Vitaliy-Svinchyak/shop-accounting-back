<?php

namespace Application\Service;

use Application\Entity\User;
use Application\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

class AuthAdapter implements AdapterInterface
{
    /**
     * User email.
     * @var string
     */
    private $email;

    /**
     * Password
     * @var string
     */
    private $password;

    /**
     * Entity manager.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Sets user email.
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Sets password.
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = (string)$password;
    }

    /**
     * Performs an authentication attempt.
     * @throws \Zend\Crypt\Password\Exception\InvalidArgumentException
     */
    public function authenticate(): Result
    {
        /** @var UserRepository $userRepo */
        $userRepo = $this->entityManager->getRepository(User::class);
        /** @var User $user */
        $user = $userRepo->findOneByEmail($this->email);

        if ($user === null) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid credentials.']
            );
        }

        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();

        if ($bcrypt->verify($this->password, $passwordHash)) {
            return new Result(
                Result::SUCCESS,
                $user,
                ['Authenticated successfully.']
            );
        }

        return new Result(
            Result::FAILURE_CREDENTIAL_INVALID,
            null,
            ['Invalid credentials.']
        );
    }
}