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

$title = 'BIBILIOTEQUE - Accueil';
$indexActive = "activeNavBar";

if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

$bdd = Database::BDD();

$booksManager = new BooksManager($bdd);
if (isset($_GET['s'])) {
    if (!empty($_GET['terme'])) {
        $_GET["terme"] = htmlspecialchars($_GET["terme"]);
        $terme = $_GET["terme"];
        $terme = trim($terme);
        $terme = strip_tags($terme);
        $terme = ucfirst($terme);

        $bookByName = $booksManager->getBookByName($terme);
        if (empty($bookByName[0])) {
            $color = 'colorred';
            $reponse = 'Aucun livre ne correspond à votre recherche: "'. $terme. '", essayez avec des espaces.';
        }
    } else {
        header('location: index.php');
    }
} else {
    $allBooksAndImages = $booksManager->getBooksAndCategories();
}
require "../views/indexVue.php";
