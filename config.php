<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

return [
    'request' => function () {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    },

    'response' => new Response(),
    'emitter' => new SapiEmitter(),

    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/views');

        return new Environment($loader);
    },

    QueryBuilder::class => function () {
        $options = [
            'dbname' => 'phpf',
            'user' => 'root',
            'password' => 'password',
            'host' => '127.0.0.1',
            'driver' => 'pdo_mysql',
        ];

        $connection = DriverManager::getConnection($options);

        return $connection->createQueryBuilder();
    }
];
