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

$title = 'BIBILIOTEQUE - Ajouter un livre';
$addActive = "activeNavBar";

$bdd = Database::BDD();
$booksManager = new BooksManager($bdd);
$categoriesManager = new CategoryManager($bdd);
$imageManager = new ImageManager($bdd);
$allCategories = $categoriesManager->getCategories();
$color = '';
$message = '';

if (isset($_POST['title'])) {
    if (isset($_POST['author'])) {
        if (isset($_POST['date'])) {
            if (isset($_POST['category'])) {
                if (isset($_POST['desc'])) {
                    $titleBook = htmlspecialchars($_POST['title']);
                    $author = htmlspecialchars($_POST['author']);
                    $apparution = htmlspecialchars($_POST['date']);
                    $content = htmlspecialchars($_POST['desc']);
                    $category = (int) $_POST['category'];
                    if (isset($_FILES['image'])) {
                        if (isset($_POST['alt'])) {
                            $alt = htmlspecialchars($_POST['alt']);
                        }
                        $target_dir = "../assets/img/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        
                        $addImage = new AddImages([
                            'target_dir' => $target_dir,
                            'target_file' => $target_file,
                            'uploadOk' => $uploadOk,
                            'imageFileType' => $imageFileType,
                            'tmpname' => $_FILES["image"]["tmp_name"]
                        ]);

                        $message = $addImage->checkImage($addImage);
                        if ($addImage->getUploadOk() == 1) {
                            $addImage = new Images([
                                'nameImage' => $target_file,
                                'alt' => $alt
                            ]);
                            $image = $imageManager->addImage($addImage);
                        } else {
                            $messageImage = $addImage->getError();
                        }
                    }
                    if (!isset($image)) {
                        $image = 1;
                    }
                    $addBook = new Books([
                        'title' => $titleBook,
                        'author' => $author,
                        'apparution' => $apparution,
                        'content' => $content,
                        'disponibility' => 1,
                        'images_id' => $image,
                        'categories_id' => $category
                    ]);
                    $createBook = $booksManager->addBook($addBook);
                    if (isset($messageImage)) {
                        $message = 'Le livre a étais ajouté avec succès mais l\'image a eu un problème';
                        $color = 'colorred';
                    } else {
                        $color = 'colorgreen';
                        $message = 'Le livre a étais ajouté avec succès ainsi que l\'image';
                    }
                }
            }
        }
    }
}

require "../views/addBooksVue.php";
