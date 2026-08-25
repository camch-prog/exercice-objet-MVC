<?php
class ViewArticle{
    //ATTRIBUT
    private string $listArticles = '';
    private ?array $dataArticles;
    private ViewFooter $viewFooter;
    private ViewHeader $viewHeader;
    private ?string $buffer;

    //CONSTRUCTOR
    public function __construct(){
        $this->viewFooter = new ViewFooter();
        $this->viewHeader = new ViewHeader("Articles","./public/src/script/scriptArticle.js");
    }

    //GETTER ET SETTER
    // Le Controlleur a besoin de cette méthode public pour donner les data des articles depuis le Model à la View
    public function setDataArticles(array $newArticles):self{
        $this->dataArticles = $newArticles;
        return $this; //return $this (l'objet en cours) est pratique pour utiliser du chaînage de méthode
    }
    //METHODS
    public function launchBuffer():self{
        foreach($this->dataArticles as $row){
            $this->listArticles .="<article><h2>".$row['title']."</h2><h3>By :".$row['pseudo']."</h3></article>";
        };
        ob_start(); //Mise en mémoire tampon (buffer)
    ?>
            <main>
                <h1>Liste des Articles</h1>
                <ul><?= $this->listArticles ?>
                </ul>
            </main>
        
    
    <?php
        $this->buffer = ob_get_clean(); //récupération le contenu du buffer et j'efface le buffer

        return $this;
    }

    public function display(){
        echo $this->buffer;
    }
    //Method pour recomposer l'entièreté de la page
    public function displayAll():void{
        $this->viewHeader->launchBuffer()->display();
        $this->launchBuffer()->display();
        $this->viewFooter->launchBuffer()->display();
    }

}


?>
