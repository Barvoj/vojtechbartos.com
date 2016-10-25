<?php

require __DIR__ . '/../vendor/backend/autoload.php';

$configurator = new Nette\Configurator;

const ENV_LOCAL = "local";
const ENV_TESTING = "testing";
const ENV_PRODUCTION = "production";

if (file_exists(__DIR__ . '/config/environment.local.php')) {
    require __DIR__ . '/config/environment.local.php';
} else {
    define('ENVIRONMENT', ENV_PRODUCTION);
}

$enableDebugger = in_array(ENVIRONMENT, [ENV_LOCAL]);

$configurator->setDebugMode($enableDebugger); // enable for your remote IP

$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->addDirectory(__DIR__ . '/../extensions')
    ->addDirectory(__DIR__ . '/../libs')
    ->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();

return $container;
