<?php

use Quiz\Controlers\NotFoundController;
use Quiz\Models\QuizModel;
use Illuminate\Support\Arr;
use Quiz\Route;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/functions.php';

$routes = require_once __DIR__ . '/../src/routes.php';


/** @var Route[] $routes */
$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

/** @var Route $route */
$route = Arr::get($routes, $path, new Route(NotFoundController::class));
$route->handle();







//$quiz = QuizModel::query()->where(['id' => 1])->first();
//
//echo $quiz->title . '</br>';
//foreach ($quiz->questions as $question) {
//    echo $question->text . '</br>';
//    foreach ($question->answers as $answer) {
//        echo $answer->text . '</br>';
//    }
//}


//$dsn = 'mysql:host=127.0.0.1;charset=utf8;dbname=quizes';
//
//$connection = new PDO($dsn, 'homestead', 'secret');
//
//$quizId = $_GET['quizId'] ?? 1;
//
//$query = "SELECT * FROM quizzes WHERE id = :id";
//
//$statement = $connection->prepare($query);
//
//$statement->execute([
//
//    'id' => (int)$quizId
//
//]);
//
//$quizData = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//$quizData = $quizData[0];
//
//$quiz = QuizzeModel::fromArray($quizData);
//
//var_dump($quiz);




