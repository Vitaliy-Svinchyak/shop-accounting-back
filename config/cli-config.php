<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
$config = include  'autoload/doctrine.global.php';

$paths = $config['doctrine']['driver']['application_entities']['paths'];
$dbParams = $config['doctrine']['connection']['orm_default']['params'];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);
return ConsoleRunner::createHelperSet($entityManager);