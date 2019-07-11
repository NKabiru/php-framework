<?php

namespace App\Http\Controllers;

use App\Users\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;
use Zend\Diactoros\Response\RedirectResponse;

class GreetingsController extends BaseController
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(Environment $twig, UserRepository $userRepository)
    {
        parent::__construct($twig);

        $this->userRepository = $userRepository;
    }

    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $arguments
    ) :ResponseInterface
    {
        $otherUsers = $this->userRepository->getAll();
        $users = array_merge($arguments, ['users' => $otherUsers]);


        return $this->render($response, 'home', $users);
    }

    public function store(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $arguments
    )
    {
        $this->userRepository->add($arguments['name']);

        return new RedirectResponse('/hello/' . $arguments['name'], 301);
    }
}
