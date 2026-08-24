<?php

class ControllerArticle {
    private ModelArticle $modelArticle;
    private ViewArticle $viewArticle;

    public function __construct(ModelArticle $modelArticle) {
        $this->modelArticle = $modelArticle;
        $this->viewArticle = new ViewArticle("Mes articles");
    }

    public function displayArticles(){

    $data=$this->modelArticle->getArticles();
    $this->viewArticle->setData($data);
    $this->viewArticle->renderAll();
    }
}
