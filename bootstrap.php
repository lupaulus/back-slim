<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

date_default_timezone_set('America/Lima');
require_once "vendor/autoload.php";

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$conn = array(
'host' => 'localhost',
'driver' => 'pdo_pgsql',
'user' => 'dbshop',
'password' => 'changeme',
'dbname' => 'dbshop',
'port' => '5432'
);

$entityManager = EntityManager::create($conn, $config);