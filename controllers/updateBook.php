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

$booksManager = new BooksManager($bdd);
$categoryManager = new CategoryManager($bdd);

if (isset($_POST['update'])) {
    if (isset($_POST['title'])) {
        if (isset($_POST['author'])) {
            if (isset($_POST['apparution'])) {
                if (isset($_POST['content'])) {
                    if (isset($_POST['categories'])) {
                        if (isset($_FILES['images'])) {
                        }
                    }
                }
            }
        }
    }
}

if (isset($_POST['idBook'])) {
    $id = (int) $_POST['idBook'];
    $booksAndCategorieById = $booksManager->getBookAndCategoryById($id);
    $getAllCategory = $categoryManager->getCategories();
}

require "../views/updateBookVue.php";
