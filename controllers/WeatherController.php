<?php

namespace app\controllers;

class WeatherController extends Controller
{
    public function weather(): bool|array|string
    {
        return $this->render('weather');
    }
}