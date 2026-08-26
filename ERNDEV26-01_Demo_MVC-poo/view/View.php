<?php

namespace View;

class View {
    private array $data;
    private ViewHeader $header;
    private ViewFooter $footer;
    private ?string $buffer;

    public function __construct(){
        $this->footer = new ViewFooter();
        $this->header = new ViewHeader();
    }
    public function setData(array $newData):self{
        $this->data = $newData;
        return $this; //return $this (l'objet en cours) est pratique pour utiliser du chaînage de méthode
    }
    public function getData():array{
        return $this->data;
    }
    public function setBuffer(string $buffer):void{
        $this->buffer = $buffer;
    }
    public function getBuffer():?string{
        return $this->buffer;
    }

    public function display(){
        echo $this->buffer;
    }

    //Method pour recomposer l'entièreté de la page
    public function displayAll():void{
        $this->header->launchBuffer()->display();
        $this->launchBuffer()->display();
        $this->footer->launchBuffer()->display();
    }
}