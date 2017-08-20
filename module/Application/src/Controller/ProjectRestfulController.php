<?php

namespace Application\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;

class ProjectRestfulController extends AbstractRestfulController
{
    public function options()
    {
        return $this->successResponse();
    }

    public function successResponse($content = null): Response
    {
        /** @var Response $response */
        $response =$this->response;
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->setContent(json_encode($content));
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $headers->addHeaderLine('Access-Control-Allow-Credentials', 'true');
        $headers->addHeaderLine('Access-Control-Allow-Origin', '*');
        $headers->addHeaderLine('Access-Control-Allow-Headers', 'Content-Type, *');
        $headers->addHeaderLine('Content-Type', 'application/json');
        $response->setHeaders($headers);

        return $response;
    }

}