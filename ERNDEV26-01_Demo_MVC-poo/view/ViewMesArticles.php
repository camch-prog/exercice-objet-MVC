<?php
namespace View;

use View\View;

class ViewMesArticles extends View{

    private string $messageDelete;

    public function setMessageDelete(string $message) {
        $this->messageDelete=$message;
    }
    public function launchBuffer():self{
        //Lancement de la mise en mémoire tampon
        ob_start();
?>
            <main>
                <h1>Liste des Articles de <?= $_SESSION["pseudo"] ?></h1>
                <ul>
<?php
                    //Boucle d'affichage du tableau de donnée des articles au sein du template HTML
                    foreach($this->getData() as $row){
?>
                        <article>
                            <h2> <?= $row['title'] ?></h2>
                            <h3>By : <?= $row['pseudo'] ?></h3>
                            <form action="" method="post">
                                <?php if (!isset($_POST["submitDelete"])){
                                    echo '<input type="submit" value="Supprimer cet article" name="submitDelete">';
                                    }
                                else {echo 
                                '<label for="">Entrez votre mdp pour supprimer cet article</label><input type="password" name="password">
                                <input type="hidden" name="articleTitle" value="'.$row["title"].'">
                                <input type="submit" value="Supprimer cet article" name="validate">';
                                
                                }?>
                                <?= $this->messageDelete ?? ""?>
                            </form>
                        </article>
<?php
                    }
?>
                </ul>

                <h2>Ajouter un article</h2>
                <form action=""method="post">
                    <label for="">Titre<input type="text" name="title"></label>
                    <label for="">Contenu de l'article<input type="text" name="content"></label>
                    <input type="submit" value="Publier l'article" name="submit">
                </form>
                <div><?= $this->getMessage() ?? "" ?></div>
            </main>
<?php
        //Récupération du Buffer et nettoyage de ce dernier
        $this->setBuffer(ob_get_clean());

        //Retour de l'objet pour permettre le chaînage de méthode
        return $this;
    }

}


?>
