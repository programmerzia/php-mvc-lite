<?php

namespace app\controllers;

use app\core\Application;

class Controller
{
    public function render($view, $params=[]): bool|array|string
    {
        return Application::$app->router->renderView($view, $params);
    }
}