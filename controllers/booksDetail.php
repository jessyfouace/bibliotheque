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

$title = 'BIBILIOTEQUE - Detail Livre';

$bytes = random_bytes(5);
$token = bin2hex($bytes);
$_SESSION['token'] = $token;

if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

$bdd = Database::BDD();

$booksManager = new BooksManager($bdd);
$usersManager = new UsersManager($bdd);
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
} else {
    header('location: index.php');
}

$booksAndCategorieById = $booksManager->getBookAndCategoryById($id);
$getAllUsers = $usersManager->getUsers();

require "../views/booksDetailVue.php";
