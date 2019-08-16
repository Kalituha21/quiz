<?php

use Quiz\Controlers\AuthController;
use Quiz\Controlers\IndexController;
use Quiz\Controlers\QuizController;
use Quiz\Controlers\ResultsController;
use Quiz\Route;

return [
    '/' => new Route(IndexController::class),
    '/about' => new Route(IndexController::class, 'about'),
    '/viewResults' => new Route(ResultsController::class, 'viewResults'),
    '/register' => new Route(AuthController::class, 'register'),
    '/registerPost' => new Route(AuthController::class, 'registerPost'),
    '/login' => new Route(AuthController::class, 'login'),
    '/loginPost' => new Route(AuthController::class, 'loginPost'),
    '/logout' => new Route(AuthController::class, 'logout'),
    '/quiz/start' => new Route(QuizController::class, 'start'),
    '/quiz/next-question' => new Route(QuizController::class, 'nextQuestion')
];