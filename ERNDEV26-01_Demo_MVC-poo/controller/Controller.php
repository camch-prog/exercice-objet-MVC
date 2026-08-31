<?php
namespace Controller;
use Model\Model;

//Class Controller regrouper le code commun à tous les Controller
class Controller{
    //ATTRIBUT
    private Model $model; //Peut contenir n'importe quelle class héritant de Model
    private object $view;

    //CONSTRUCTOR
    public function __construct(Model $model, object $view){
        $this->model = $model;
        $this->view = $view;
    }

    //GETTER ET SETTER
    public function getModel():Model {
        return $this->model;
    }

    protected function getView():Object {
        return $this->view;
    }

    //METHODS
    public function render():void{
        //1. Appel du model pour récupérer les données des articles
        $data = $this->model->findAll();

        //2.Passage des data à la View et son Appel pour afficher les data traitées
        $this->view->setData($data)->displayAll();
    }
}