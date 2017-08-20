<?php

namespace Application\Factory;

use Application\Service\AuthAdapter;
use Application\Service\AuthStorage;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory responsible for creating of authentication service.
 */
class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service
     * and returns its instance.
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return AuthenticationService
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        $authStorage = $container->get(AuthStorage::class);
        $authAdapter = $container->get(AuthAdapter::class);

        // Create the service and inject dependencies into its constructor.
        return new AuthenticationService($authStorage, $authAdapter);
    }
}