<?php
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driverClass' => Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => '',
                    'dbname' => 'shop-accounting',
                    'driverOptions' => [
                        'charset' => 'utf8',
                    ],
                ],

            ],
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache' => 'filesystem',
                'query_cache' => 'filesystem',
                'generate_proxies' => false,
            ]
        ],
        'driver' => [
            'vendor_entities' => [
                'class' => AnnotationDriver::class,
                'paths' => [

                ]
            ],
            'application_entities' => [
                'class' => AnnotationDriver::class,
                'paths' => [
                    'module/Application/src/Entity',
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'application_entities',
                ]
            ]
        ],
    ],
];
