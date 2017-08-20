<?php

use Application\Factory\AuthenticationServiceFactory;
use Application\Factory\ServiceManagerControllerFactory;
use Application\Middleware\AuthMiddleware;
use Application\Service\ShopService;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'factories' => [
        \Application\Service\AuthStorage::class => ReflectionBasedAbstractFactory::class,
        \Application\Service\AuthAdapter::class => ReflectionBasedAbstractFactory::class,
        \Zend\Authentication\AuthenticationService::class => AuthenticationServiceFactory::class,
        \Application\Service\AuthManager::class => ReflectionBasedAbstractFactory::class,
        ShopService::class => ServiceManagerControllerFactory::class,
        AuthMiddleware::class => InvokableFactory::class
    ],
];
