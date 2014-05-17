<?php

require_once 'classIncluder.php';

class SSF
{

    /**
     *
     * @var Controller
     */
    private $controller;

    /**
     *
     * @var Model
     */
    private $model;

    public function __construct()
    {
        header('Content-Type: text/html; charset=utf-8');
        $globalRewrite = App::$route->getGlobalRewrite();
        User::checkFields();

        //checks whether access level is sufficient and redirects to login page if not 
        if ($globalRewrite['access'] > User::getLevel()) {
            Help::redirect('Auth', null, null, 'notauthorised');
        }
        $modelName = $globalRewrite['component'] . 'Model';
        $controllerName = $globalRewrite['component'] . 'Controller';
        $this->model = new $modelName();


        $this->controller = new $controllerName($this->model);

        if (!empty($globalRewrite['action'])) {
            if ($globalRewrite['file'] === 'Controller') {
                if (method_exists($this->controller, $globalRewrite['action'])) {
                    $this->controller->{$globalRewrite['action']}();
                }
            } elseif ($globalRewrite['file'] === 'Model') {
                if (method_exists($this->controller->model, $globalRewrite['action'])) {
                    $this->controller->model->{$globalRewrite['action']}();
                }
            }
        }

        $this->controller->syncMethods();

        try {
            $this->controller->display();
        } catch (Exception $ex) {
            $this->controller->display('404');
        }
    }

}
