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
$imageManager = new ImageManager($bdd);

if (isset($_POST['update'])) {
    if (isset($_POST['title'])) {
        if (isset($_POST['author'])) {
            if (isset($_POST['apparution'])) {
                if (isset($_POST['content'])) {
                    if (isset($_POST['category'])) {
                        if (isset($_POST['alt'])) {
                            $titleBook = htmlspecialchars($_POST['title']);
                            $author = htmlspecialchars($_POST['author']);
                            $apparution = htmlspecialchars($_POST['apparution']);
                            $content = htmlspecialchars($_POST['content']);
                            $category = (int)$_POST['category'];
                            $alt = htmlspecialchars($_POST['alt']);
                            $lastImage = htmlspecialchars($_POST['lastNameImg']);
                            $lastIdImg = (int) $_POST['lastIdImg'];
                            $idBook = (int) $_POST['idBook'];
                            if (isset($_FILES['image'])) {
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
                                        if ($lastImage !== '../assets/img/NoBook.png') {
                                            $deleteImg = $imageManager->deleteImage($lastIdImg);
                                            unlink($lastImage);
                                        }
                                        echo "c";
                                    }
                                }
                            }
                            if (!isset($image)) {
                                $image = $lastIdImg;
                            }
                            $addBook = new Books([
                                'id' => $idBook,
                                'title' => $titleBook,
                                'author' => $author,
                                'apparution' => $apparution,
                                'content' => $content,
                                'images_id' => $image,
                                'categories_id' => $category
                            ]);
                            if ($image !== 1) {
                                $updateAlt = new Images([
                                    'idImage' => $lastIdImg,
                                    'alt' => $alt
                                ]);
                                $updateImg = $imageManager->updateAlt($updateAlt);
                            }
                            $createBook = $booksManager->updateBook($addBook);
                            $message = 'Le livre a étais modifier avec succès';
                            $colorgreen = 'colorgreen';
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
