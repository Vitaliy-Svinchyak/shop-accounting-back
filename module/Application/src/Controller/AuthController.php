<?php

namespace Application\Controller;

use Application\Service\AuthManager;
use Zend\Http\Response;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthController extends ProjectRestfulController
{
    /**
     * @var AuthManager
     */
    private $authManager;

    public function __construct(ServiceLocatorInterface $serviceLocator, AuthManager $authManager)
    {
        parent::__construct($serviceLocator);
        $this->authManager = $authManager;
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public function create($data): Response
    {
        $result = $this->authManager->login($data);

        if($result){
            return $this->successResponse(['token'  => $this->authManager->getToken()]);
        }

        return $this->successResponse($result);
    }
}