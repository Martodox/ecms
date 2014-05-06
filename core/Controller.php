<?php

class Controller
{

    /**
     *
     * @var Model
     */
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function display($tpl = null)
    {
        if ($this->model->displayTemplate) {
            $tpl = ($tpl === null || devmode ? $this->model->template : $tpl);
            App::$smarty->display($this->model->template . '.tpl');
        }
    }

    public function setLanguage()
    {

        $_SESSION['lang'] = $this->model->lng->currentVars(0);
        $location = rootpatch;
        $vars = $this->model->lng->currentVars(1);
        if (!empty($vars)) {
            $location .= $vars;
        }
        header('Location: ' . $location);
    }

    public function hideTemplate()
    {
        $this->model->displayTemplate = false;
    }

}
