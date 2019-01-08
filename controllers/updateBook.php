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

$color = '';
$message = '';

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
                            if (!empty($_FILES['image']['name'])) {
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
                                    if ($lastImage !== '../assets/img/NoBook.png') {
                                        $deleteImg = $imageManager->deleteImage($lastIdImg);
                                        unlink($lastImage);
                                    }
                                } else {
                                    $messageImage = $addImage->getError();
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
                            if (isset($messageImage)) {
                                $message = 'Le livre a étais modifier avec succès mais l\'image a eu un problème';
                                $color = 'colorred';
                            } else {
                                $color = 'colorgreen';
                                $message = 'Le livre a étais modifier avec succès ainsi que l\'image';
                            }
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
