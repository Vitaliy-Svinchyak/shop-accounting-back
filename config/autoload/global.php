<?php

use Doctrine\ORM\EntityManager;

return [
    'service_manager' => array(
        'aliases' => array(
            'entity_manager' => EntityManager::class,
        ),
    ),
];
