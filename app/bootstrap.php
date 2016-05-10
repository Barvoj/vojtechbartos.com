<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

if (isset($_COOKIE['debug']) && $_COOKIE['debug'] === "true") {
    $configurator->setDebugMode(true); // enable for your remote IP
}

//$configurator->enableDebugger(__DIR__ . '/../log');
//$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->enableDebugger('/var/www/writable/log');
$configurator->setTempDirectory('/var/www/writable/temp');

$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->addDirectory(__DIR__ . '/../libs')
    ->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
//$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();

return $container;
