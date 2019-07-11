<?php

use App\Factory\RouteFactory;
use DI\ContainerBuilder;

require_once __DIR__ . "/../vendor/autoload.php";

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . "/../config.php");
$container = $containerBuilder->build();

$route = RouteFactory::build($container);

$response = $route->dispatch($container->get('request'), $container->get('response'));

$container->get('emitter')->emit($response);

