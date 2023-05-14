<?php
require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;
use app\controllers\SiteController;
$app = new Application(dirname(__DIR__));

//$app->router->get('/', function(){
//    return 'Hello World!';
//});
$app->router->get('/', [\app\controllers\WeatherController::class,'weather']);

$app->router->get('/home', [SiteController::class,'home']);
$app->router->post('/contact', [SiteController::class, 'handleSubmittedData']);
$app->run();