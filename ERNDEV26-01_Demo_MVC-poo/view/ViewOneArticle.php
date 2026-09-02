<?php

namespace View;

use View\View;

class ViewOneArticle extends View{

    public function launchBuffer():self{

    ob_start();
?>
    <main>
        <h1>Articles</h1>
                
<?php
            foreach($this->getData() as $row){
?>
                <article>
                    <h2> <?= $row['title'] ?></h2>
                    
                    <p><?= $row['content'] ?></p>

                    <h3>By : <?= $row['pseudo'] ?></h3>
            </article>
<?php 
            } 
?>
    <form action="" method="post">
        <input type="text" name="content">
        <input type="submit" value="modifier le contenu de l'article" name="submit">
    </form>
    </main>
<?php
        //Récupération du Buffer et nettoyage de ce dernier
        $this->setBuffer(ob_get_clean());
        return $this;
    }
}