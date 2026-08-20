<?php
//Initialiser ma variable d'affichage
$listeArticle = "";
?>

    <main>
        <h1>Liste des Articles</h1>
        <ul>
            <?php
                //traitement des données pour affichage 
                foreach($data as $row){
                    $listeArticle .="<article><h2>".$row['title']."</h2><h3>By :".$row['pseudo']."</h3></article>";
                };
                echo $listeArticle;
            ?>
        </ul>
    </main>
