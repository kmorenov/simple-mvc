<?php

namespace Core;

use Core\View;

abstract class Controller {

    public function post($name) {
        return $this->getRequestData(INPUT_POST, $name);
    }
    
    public function get($name) {
        return $this->getRequestData(INPUT_GET, $name);
    }
    
    private function getRequestData($type, $name) {
        return filter_input($type, $name);
    }
    
    public function getModel($modelName)
    {
        $class = 'Model\\'.$modelName;
        return new $class;
    }
    
    public function render($template, $data = null, $layout = null)
    {
        $view = new View();
        return $view->render($template, $data, $layout);
    }
    
    public function redirect($route, array $parameters = [])
    {
        global $router;
        $url =  $router->generate($route, $parameters);
         
        header("Location: $url");
        exit;
    }

    public function json(array $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    public function error404()
    {
        http_response_code(404);
        echo "<h1>404 Page Not Found</h1>";
        die;
    }
    
    public function addFlash($alias, $message)
    {
        FlashBag::addFlash($alias, $message);
    }
}