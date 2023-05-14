<?php

namespace app\core;

class Application
{
    public static Application $app;
    public Request $request;
    public Response $response;
    public Router $router;
    public static string $ROOT_DIR;
    public function __construct($rootPath){
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
    }
    public function run(): void
    {
        echo $this->router->resolve();
    }

}