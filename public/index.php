<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

$segments = explode('/', $_SERVER['REQUEST_URI']);

if(isset($segments[2])){
    $pageName = $segments[2];

    if($pageName === 'categories' || $pageName === 'category')
        require_once '../app/api/category.php';
    elseif($pageName === 'post' || $pageName === 'posts')
        require_once '../app/api/post.php';
}

$app->run();