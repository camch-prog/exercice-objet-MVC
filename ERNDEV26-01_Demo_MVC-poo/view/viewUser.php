<?php
class ViewUser {
    private string $listeUsers ="";
    private array $dataUsers = [];
    private ViewHeader $header;
    private ViewFooter $footer;

    public function __construct() {
        $this->header = new ViewHeader("Mes Utilisateurs");
        $this->footer = new ViewFooter;
    }
    public function setDataUsers(array $newDataUsers ): void {
            $this->dataUsers = $newDataUsers;
        }

    public function display() {
        echo 
        "<main>
            <h1>Liste des utilisateurs</h1>
                <ul>";
                foreach($this -> dataUsers as $row){
                            $this->listeUsers ="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
                            echo $this->listeUsers;
                        };
                    
            echo "</ul>
        </main>";
    }
    

    public function allDisplay() {
        $this->header;
        $this->display();
        $this->footer;
    }
}
        
