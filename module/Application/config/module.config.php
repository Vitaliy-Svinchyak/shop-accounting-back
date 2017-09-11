<?php

namespace Application;

use Application\Factory\ServiceManagerControllerFactory;
use Application\Middleware\AuthMiddleware;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'service_manager' => include __DIR__ . '/services.config.php',
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'auth' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/user/auth',
                    'defaults' => [
                        'controller' => Controller\AuthController::class
                    ],
                ],
            ],
            'shop' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/shop',
                    'defaults' => [
                        'controller' => Controller\ShopController::class
                    ],
                ],
            ],
            'shop_stocks' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/stock/:id/products',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\StockController::class,
                        'action' => 'getProducts'
                    ],
                ],
            ],
            'stock_products' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/shop/:id/stocks',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ShopController::class,
                        'action' => 'getShopStocks'
                    ],
                ],
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Factory\IndexControllerFactory::class,
            Controller\AuthController::class => ReflectionBasedAbstractFactory::class,
            Controller\ShopController::class => ServiceManagerControllerFactory::class,
            Controller\StockController::class => ServiceManagerControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
