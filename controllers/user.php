<?php

function chargerClasse($classname)
{
    if (file_exists('../model/'. ucfirst($classname).'.php')) {
        require '../model/'. ucfirst($classname).'.php';
    } elseif (file_exists('../entities/'. ucfirst($classname).'.php')) {
        require '../entities/'. ucfirst($classname).'.php';
    } elseif (file_exists('../traits/'. ucfirst($classname).'.php')) {
        require '../traits/'. ucfirst($classname).'.php';
    } else {
        require '../interface/'. ucfirst($classname).'.php';
    }
}
spl_autoload_register('chargerClasse');

session_start();

$bdd = Database::BDD();

if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

$title = 'BIBILIOTEQUE - Listes des utilisateurs';
$userActive = "activeNavBar";

$usersManager = new UsersManager($bdd);

$getAllUsers = $usersManager->getUsers();

require "../views/userVue.php";
