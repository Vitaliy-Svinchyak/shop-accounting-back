<?php

namespace Application\Service;

use Application\Entity\User;
use Application\Entity\UserAuth;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;

class AuthManager
{
    private $authService;

    private $token;

    private $user;

    public function __construct(AuthenticationService $authenticationService, EntityManager $entityManager)
    {
        $this->authService = $authenticationService;
        $this->entityManager = $entityManager;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    public function login(array $userData)
    {
        /** @var AuthAdapter $authAdapter */
        $authAdapter = $this->authService->getAdapter();
        $authAdapter->setEmail($userData['email']);
        $authAdapter->setPassword($userData['password']);
        $result = $this->authService->authenticate();

        if ($result->getCode() === Result::SUCCESS) {
            /** @var UserAuth $userAuth */
            $userAuth = $this->authService->getIdentity();
            $this->token = $userAuth->getHash();

            return true;
        }

        return false;
    }

    /**
     * @param string $token
     *
     * @return bool
     */
    public function authorizeByToken(string $token): bool
    {
        $userAuthRepo = $this->entityManager->getRepository(UserAuth::class);

        /** @var UserAuth $userAuth */
        $userAuth = $userAuthRepo->findOneBy(['hash' => $token]);

        if ($userAuth) {
            $this->user = $userAuth->getUser();

            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}