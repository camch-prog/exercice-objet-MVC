<?php
class ViewUser{
    //ATTRIBUT
    private string $listUsers = '';
    private ?array $dataUsers;
    private ViewFooter $viewFooter;
    private ViewHeader $viewHeader;

    //CONSTRUCTEUR
    public function __construct() {
        $this->viewFooter = new ViewFooter();
        $this->viewHeader = new ViewHeader("Mes utilisateurs");
    }
    //GETTER ET SETTER
    public function setDataUsers(array $newData){
        $this->dataUsers = $newData;
        $this->viewFooter = new ViewFooter();
    }

    //METHODS
    public function display():void{
        //1. traitement des données pour affichage 
        foreach($this->dataUsers as $row){
                $this->listUsers .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
        };
                
        //2. Affichage de la ViewUsers
        echo "<main>
                <h1>Liste des utilisateurs</h1>
                <ul>".$this->listUsers."</ul>
            </main>";
    }

    public function displayAll():void{
        $this->viewHeader->display();
        $this->display();
        $this->viewFooter->display();
    }
}
