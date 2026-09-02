<?php

namespace View;

class ViewAccount extends View {

    public function launchBuffer():self {
        
        if(!empty($_SESSION["pseudo"])){
            ob_start();
?>
<main>
                <h1>Mon compte</h1>
                <div>
                    <h2>Pseudo</h2>
                    <span><?= $this->getData()["pseudo"]; ?></span>
                    <h2>Email</h2>
                    <span><?=$this->getData()["email"]; ?></span>
                    <h2>Compte crée le</h2>
                    <span><?=$this->getData()["created_at"]; ?></span>
                </div>
                <form action="" method="post">
                    <?php if (!isset($_POST["submit"])){
                        echo '<input type="submit" value="Supprimer mon compte" name="submit">';
                        }
                    else {echo 
                    '<label for="">Entrez votre mdp pour supprimer votre compte</label><input type="password" name="password">
                    <input type="submit" value="Supprimer mon compte" name="validate">';
                    }?>
                    <?php echo "<ul>".$this->getMessage()."</ul>"?>
                </form>
</main>
<?php
}else {
    ob_start();
    ?>
    <div> Vous devez vous connecter </div>
    <?php
}
    return $this->setBuffer(ob_get_clean());
    }
}