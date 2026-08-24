<?php

class ViewArticle {
    private ?array $data ;
    private string $listeArticle ="";
    private ViewFooter $viewFooter;
    private ViewHeader $viewHeader;
    
    public function __construct() {
        $this->viewFooter = new ViewFooter();
        $this->viewHeader = new ViewHeader("Mes articles");
    }

    public function render(){
    $listeArticle = "";

        echo "<main>
            <h1>Liste des Articles</h1>
            <ul>";
                    foreach($this->data as $row){
                        $this->listeArticle .="<article><h2>".$row['title']."</h2><h3>By :".$row['pseudo']."</h3></article>";
                    };
                    
                echo $this->listeArticle;
            echo "</ul>
        </main>";
    }

    public function setData(array $data) {
        $this->data=$data;
    }
    
    public function renderAll(){
        $this->viewHeader->display();
        $this->render();
        $this->viewHeader->display();
    }

}
//Initialiser ma variable d'affichage
