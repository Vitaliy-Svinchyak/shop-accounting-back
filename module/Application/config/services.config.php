<?php

use Application\Factory\AuthenticationServiceFactory;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'factories' => [
        \Application\Service\AuthStorage::class => ReflectionBasedAbstractFactory::class,
        \Application\Service\AuthAdapter::class => ReflectionBasedAbstractFactory::class,
        \Zend\Authentication\AuthenticationService::class => AuthenticationServiceFactory::class,
        \Application\Service\AuthManager::class => ReflectionBasedAbstractFactory::class,
    ],
];
