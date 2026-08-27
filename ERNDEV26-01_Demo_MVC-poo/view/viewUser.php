<?php
namespace View;

use View\View;

class ViewUser extends View{

    

    public function launchBuffer():self{
        //1. traitement des données pour affichage 
        // foreach($this->dataUsers as $row){
        //         $this->listUsers .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
        // };

        ob_start();
?>
            <main>
                <h1>Liste des utilisateurs</h1>
                <ul>
                <form action="" method="post">
                    <label for="email">Email</label><input type="text" name="email" id="email">
                    <label for="password">Mot de passe</label><input type="password" name="password" id='password'>
                    <input type="submit" value="Connexion" name="submit">
                </form>

                <p><?= $this->getMessage()?>
<?php  
                // inclusion de la boucle foreach effectuer en 1. (plus haut) au sein du template HTML mis en buffer
                foreach($this->getData() as $row){
?>
                    <li>Pseudo : <?= $row['pseudo'] ?> - Email : <?= $row['email'] ?> - Role : <?= $row['role'] ?></li>
<?php    
                }
?>
                </ul>
            </main>
<?php
        //Récupération du buffer dans la propriété $this->buffer
        $this->setBuffer(ob_get_clean());
        return $this;
    }

}
