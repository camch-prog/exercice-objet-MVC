<?php
namespace Controller;

use Model\Model;
use View\View;

class Controller {
    private Model $model;
    private View $view;

    public function __construct(Model $model,object $view) {
        $this->model=$model;
        $this->view=$view;
    }
    public function getModel():Model {
        return $this->model;
    }

    public function setModel(Model $model):self{
        $this->model =$model;
        return $this;
    }

    public function getView():object {
        return $this->view;
    }

    public function setView($view):self{
        $this->view =$view;
        return $this;
    }
    
    public function render():void {
        $data = $this->getModel()->findAll();
        $this->view->setData($data)->displayAll();
    }
}