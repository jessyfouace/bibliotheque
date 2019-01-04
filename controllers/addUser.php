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
if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

$title = 'BIBILIOTEQUE - Ajouter un Utilisateur';
$bdd = Database::BDD();

$usersManager = new UsersManager($bdd);
$color = '';
$message = '';

if (isset($_POST['submit'])) {
    if (isset($_POST['firstname']) and isset($_POST['lastname'])) {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $bytes = random_bytes(4);
        $token = bin2hex($bytes);
        $newUser = new Users([
            'firstName' => $firstname,
            'lastName' => $lastname,
            'tokenId' => $token
        ]);

        $verifUser = $usersManager->VerifDispoUser($newUser);
        if ($verifUser) {
            $color = 'colorred';
            $message = 'Utilisateur déjà créer';
            header('Refresh: 0.9; url=addUser.php');
        } else {
            $addUser = $usersManager->addUsers($newUser);
            $color = 'colorgreen';
            $message = 'Utilisateur créer';
            header('Refresh: 0.9; url=addUser.php');
        }
    }
}

require "../views/addUserVue.php";
