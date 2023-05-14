<?php
namespace app\core;
class Router {
    protected array $routes = [];
    public Request $request;
    public Response $response;
    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function put($path, $callback): void
    {
        $this->routes['put'][$path] = $callback;
    }

    public function delete($path, $callback){
        $this->routes['delete'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderOnlyView('404');
        }else if(is_string($callback)){
            return $this->renderView($callback);
        }
        if (is_array($callback)){
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback);
    }

    public function renderView(string $view, $params = []): string|array|bool
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }
    public function renderContent(string $viewContent): string|array|bool
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }
    protected function layoutContent(): bool|string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/view/layouts/main.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view, $params=[]): bool|string
    {
        ob_start();
        if (is_array($params) && count($params) > 0){
            foreach ($params as $key => $value){
                $$key = $value;
            }
        }
        include_once Application::$ROOT_DIR . "/view/$view.php";
        return ob_get_clean();
    }
}