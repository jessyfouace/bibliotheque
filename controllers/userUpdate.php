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

if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

$title = 'BIBILIOTEQUE - Update utilisateur';
$userActive = "activeNavBar";

$usersManager = new UsersManager($bdd);

if (isset($_POST['update'])) {
    if (isset($_POST['firstname'])) {
        if (isset($_POST['lastname'])) {
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $iduser = (int) $_POST['userid'];
            $tokenid = htmlspecialchars($_POST['tokenid']);
            var_dump($tokenid);
            $user = new Users([
                'idUser' => $iduser,
                'firstName' => $firstname,
                'lastName' => $lastname
            ]);

            $usersManager->updateUser($user);
            header('location: user.php?name=tokenId&terme='.$tokenid.'&s=Rechercher');
        }
    }
}

if (isset($_POST['userToken'])) {
    $getUserToken = $usersManager->getUserByTarget($_POST['userToken']);
}

require "../views/userUpdateVue.php";
