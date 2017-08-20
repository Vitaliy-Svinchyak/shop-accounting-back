<?php

namespace Application\Service;

use Application\Entity\UserAuth;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;

class AuthManager
{
    private $authService;

    private $token;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authService = $authenticationService;
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
}