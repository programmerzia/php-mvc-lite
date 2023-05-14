<?php

namespace app\controllers;

class SiteController extends Controller
{
    public function home(){
        $weather = array(
            'title'=>'Home Page'
        );
        return $this->render('home',$weather);
    }
    public function handleSubmittedData(){
        return 'Handling submitted data in controller';
    }
    public function contact(){
        return 'form data received';
    }
}