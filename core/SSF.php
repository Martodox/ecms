<?php

require_once 'classIncluder.php';

class SSF
{

    public function __construct()
    {
        header('Content-Type: text/html; charset=utf-8');
        global $globalRewrite;
        $modelName = $globalRewrite['component'] . 'Model';
        $controllerName = $globalRewrite['component'] . 'Controller';

        $controller = new $controllerName(new $modelName());

        if (!empty($globalRewrite['action'])) {
            if ($globalRewrite['file'] === 'Controller') {
                if (method_exists($controller, $globalRewrite['action'])) {
                    $controller->{$globalRewrite['action']}();
                }
            } elseif ($globalRewrite['file'] === 'Model') {
                if (method_exists($controller->model, $globalRewrite['action'])) {
                    $controller->model->{$globalRewrite['action']}();
                }
            }
        }

        try {
            $controller->display();
        } catch (Exception $ex) {
            $controller->display('404');
        }
    }

}
