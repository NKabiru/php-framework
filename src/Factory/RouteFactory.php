<?php

namespace App\Factory;

use App\Routes;
use DI\Container;
use League\Route\RouteCollection;

class RouteFactory
{
    public static function build(Container $container)
    {
        $route = new RouteCollection($container);

        Routes::routes($route);

        return $route;
    }
}
