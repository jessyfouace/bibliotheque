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

$userManager = new UsersManager($bdd);

if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

if (isset($_POST['delete']) and isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $userManager->deleteUserById($userId);
    header('location: user.php');
} else {
    header('location: user.php');
}
