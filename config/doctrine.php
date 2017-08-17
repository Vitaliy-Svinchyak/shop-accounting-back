<?php
$doctrineConfig = include 'autoload/doctrine.global.php';
// Paths to Entities that we want Doctrine to see
$paths = array(
    'module/Application/src/Entity',
);

// Tells Doctrine what mode we want
$isDevMode = true;

// Doctrine connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'dbname' => 'shop-accounting'
);