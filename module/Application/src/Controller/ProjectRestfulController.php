<?php

namespace Application\Controller;

use Traversable;
use Zend\Http\Response;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;

class ProjectRestfulController extends AbstractRestfulController
{
    /**
     * @var ServiceManager
     */
    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function options()
    {
        return $this->successResponse();
    }

    public function successResponse($result = null): Response
    {
        $answer = [
            'result' => $result
        ];

        /** @var Response $response */
        $response = $this->response;
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->setContent(json_encode($answer));
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $headers->addHeaderLine('Access-Control-Allow-Credentials', 'true');
        $headers->addHeaderLine('Access-Control-Allow-Origin', '*');
        $headers->addHeaderLine('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, *');
        $headers->addHeaderLine('Content-Type', 'application/json');
        $response->setHeaders($headers);

        return $response;
    }

    /**
     * @return ServiceManager
     */
    public function getServiceLocator(): ServiceManager
    {
        return $this->serviceLocator;
    }

}