<?php
class ViewUser{
    //ATTRIBUT
    private string $listUsers = '';
    private ?array $dataUsers;
    private ViewFooter $viewFooter;
    private ViewHeader $viewHeader;
    private ?string $buffer;

    //CONSTRUCTEUR

    //GETTER ET SETTER
    public function setDataUsers(array $newData){
        $this->dataUsers = $newData;
        $this->viewFooter = new ViewFooter();
        $this->viewHeader = new ViewHeader("Utilisateurs","./public/src/script/scriptUser.js");
    }

    //METHODS
    public function launchBuffer():self{
        foreach($this->dataUsers as $row) {
                $this->listUsers.= "<li>Pseudo :". $row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
        };
        ob_start(); //Mise en mémoire tampon (buffer)
?>
            <main>
                <h1>Liste des utilisateurs</h1>
                <ul><?= $this->listUsers ?></ul>
            </main>

<?php
        $this->buffer = ob_get_clean();
        return $this;
    }

    public function display():void{
        echo $this->buffer;
    }

    public function displayAll():void{
        $this->viewHeader->launchBuffer()->display();
        $this->launchBuffer()->display();
        $this->viewFooter->launchBuffer()->display();
    }
}
