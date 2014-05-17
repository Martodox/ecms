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

    /**
     * @uses Model::passToControll()
     * @return none
     */
    public function syncMethods()
    {

        foreach ($this->model->controlSync as $method) {
            try {
                call_user_func(array($this, $method));
            } catch (Exception $ex) {
                SLog::toFile($ex);
            }
        }
    }

}
