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
$colorgreen = '';
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
                        // Check if image file is a actual image or fake image
                        if (isset($_POST["submit"])) {
                            $check = getimagesize($_FILES["image"]["tmp_name"]);
                            if ($check !== false) {
                                $message = "Il s'agit bien d'une image.";
                                $color = "colorgreen";
                                $uploadOk = 1;
                            } else {
                                $message = "Désolé, il ne s'agit pas d'une image.";
                                $color = "colorred";
                                $uploadOk = 0;
                            }
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            $message = "Désolé, une image porte déjà ce nom là.";
                            $color = "colorred";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                            $message = "Désolé, uniquement du JPG, JPEG, PNG.";
                            $color = "colorred";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $message = "Désolé, Votre image n'as pas étais chargée.";
                            $color = "colorred";
                        // if everything is ok, try to upload file
                        } else {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                $addImage = new Images([
                                    'nameImage' => '../assets/img/' . basename($_FILES["image"]["name"]),
                                    'alt' => $alt
                                ]);
                                $createImage = $imageManager->addImage($addImage);
                                $image = $createImage;
                                echo "c";
                            }
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
                    $message = 'Le livre a étais rajouter avec succès';
                    $colorgreen = 'colorgreen';
                }
            }
        }
    }
}

require "../views/addBooksVue.php";
