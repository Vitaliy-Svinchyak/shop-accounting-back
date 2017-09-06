<?php

namespace Application;

use Application\Controller\AuthController;
use Application\Service\AuthManager;
use Zend\Http\Header\HeaderInterface;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * This method is called once the MVC bootstrapping is complete and allows
     * to register event listeners.
     * @param MvcEvent $event
     */
    public function onBootstrap(MvcEvent $event)
    {
        // Get event manager.
        $eventManager = $event->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        // Register the event listener method.
        $sharedEventManager->attach(AbstractRestfulController::class,
            MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 100);
    }

    /**
     * Event listener method for the 'Dispatch' event. We listen to the Dispatch
     * event to call the access filter. The access filter allows to determine if
     * the current visitor is allowed to see the page or not. If he/she
     * is not authenticated and is not allowed to see the page, we redirect the user
     * to the login page.
     * @param MvcEvent $event
     * @return Response
     *
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Zend\Http\Exception\InvalidArgumentException
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function onDispatch(MvcEvent $event)
    {
        $controllerName = $event->getRouteMatch()->getParam('controller', null);

        // Get the instance of AuthManager service.
        /** @var AuthManager $authManager */
        $authManager = $event->getApplication()->getServiceManager()->get(AuthManager::class);
        /** @var Request $request */
        $request = $event->getRequest();

        // Execute the access filter on every controller except AuthController
        // (to avoid infinite redirect).
        if ($controllerName !== AuthController::class && !$request->isOptions()) {
            $errorResponse = new Response();
            $errorResponse->setStatusCode(Response::STATUS_CODE_401);

            /** @var Request $request */
            $request = $event->getRequest();
            /** @var HeaderInterface $header */
            $header = $request->getHeaders()->get('X-Auth-Token');

            if (!$header) {
                return $errorResponse;
            }

            $authToken = $header->getFieldValue();
            $result = $authManager->authorizeByToken($authToken);

            if (!$result) {
                return $errorResponse;
            }

        }
    }
}
