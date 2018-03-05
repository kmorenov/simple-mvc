<?php

require 'config.php';
session_start();

spl_autoload_register(function ($class) {
    $path = __DIR__ .'/'. str_replace('\\', '/', $class) . '.php';
    if (is_file($path)) {
        require $path;
        return;
    }
    
    $path = __DIR__ .'/../src/'. str_replace('\\', '/', $class) . '.php';
    if (is_file($path)) {
        require $path;
        return;
    }
    
    throw new \LogicException(sprintf('Class "%s" not found in "%s"!', $class, $path));
});

use Routing\Router;
use Routing\MatchedRoute;
use Routing\Helper;

try {
    $router = new Router(Helper::GET_HTTP_HOST());

    require 'routes.php';

    $route = $router->match(Helper::GET_METHOD(), Helper::GET_PATH_INFO());

    if (null == $route) {
        $route = new MatchedRoute('Main:error404');
    }

    Core\View::renderController($route->getController(), $route->getParameters());

} catch (Exception $e) {

    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

    echo $e->getMessage();
    echo $e->getTraceAsString();
    exit;
}
