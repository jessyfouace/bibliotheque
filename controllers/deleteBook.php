<?php

function chargerClasse($classname)
{
    if (file_exists('../model/' . ucfirst($classname) . '.php')) {
        require '../model/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../entities/' . ucfirst($classname) . '.php')) {
        require '../entities/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../traits/' . ucfirst($classname) . '.php')) {
        require '../traits/' . ucfirst($classname) . '.php';
    } else {
        require '../interface/' . ucfirst($classname) . '.php';
    }
}
spl_autoload_register('chargerClasse');

session_start();

$bdd = Database::BDD();

$booksManager = new BooksManager($bdd);

if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

if (isset($_SESSION['token']) and isset($_POST['token']) and !empty($_SESSION['token']) and !empty($_POST['token']) and isset($_POST['delete']) and isset($_POST['idBook'])) {
    if ($_SESSION['token'] == $_POST['token']) {
        $idBook = $_POST['idBook'];
        $booksManager->deleteBookById($idBook);
        header('location: index.php');
    }
} else {
    header('location: index.php');
}
