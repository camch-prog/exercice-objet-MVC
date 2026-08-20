<?php
//CONTROLLER
class controllerUsers{
    private ModelUser $modelUser;
    private ViewUser $viewUser;

    public function __construct(ModelUser $model) {
        $this->modelUser = $model;
        $this->viewUser = new ViewUser;
    }

    public function render():void {

        $data = $this -> modelUser -> findAll();
        $this->viewUser->setDataUsers($data);
        $this -> viewUser -> allDisplay();
    } 
    
    
}