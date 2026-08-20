<?php
function nav(){
    echo`<nav>
            <a href="/MVC/">Utilisateurs</a>
            <a href="/MVC/articles">Articles</a>
        </nav>`;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>
<body>
    <header>
        <nav>
            <a href=<?php echo $_ENV['utilisateurs'] ?>>Utilisateurs</a>
            <a href=<?php echo $_ENV['articles'] ?>>Articles</a>
        </nav>
    </header>