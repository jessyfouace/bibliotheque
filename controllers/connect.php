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
if (isset($_SESSION['name'])) {
    header('location: index.php');
} else {
}

$title = 'BIBILIOTEQUE - Connection';

$bdd = Database::BDD();

$messageConnection = "";

$adminManager = new AdminManager($bdd);

if (isset($_POST['connect'])) {
    if ($_POST['connect'] == "connect") {
        if (isset($_POST['nickname'])) {
            if ($_POST['nickname'] !== "") {
                if (isset($_POST['password'])) {
                    if ($_POST['password'] !== "") {
                        $nickname = htmlspecialchars($_POST['nickname']);
                        $password = htmlspecialchars($_POST['password']);
                        $objectAdmin = new Admin([
                            'name' => $nickname,
                            'password' => $password
                        ]);
                        $getAdmin = $adminManager->getAdminByName($objectAdmin);
                        if ($getAdmin) {
                            var_dump($getAdmin->getId());
                            if ($getAdmin->getPassword() == password_verify($password, $getAdmin->getPassword())) {
                                $_SESSION['id'] = $getAdmin->getId();
                                $_SESSION['name'] = $getAdmin->getName();
                                $_SESSION['password'] = $getAdmin->getPassword();
                                $_SESSION['mail'] = $getAdmin->getMail();
                                header('location: index.php');
                            } else {
                                header('location: connect.php');
                            }
                        } else {
                            header('location: connect.php');
                        }
                    }
                }
            }
        }
    }
} elseif (isset($_POST['inscription'])) {
    if ($_POST['inscription'] == "inscription") {
        if (isset($_POST['nickname'])) {
            if ($_POST['nickname'] !== "") {
                if (isset($_POST['password'])) {
                    if ($_POST['password'] !== "") {
                        if (isset($_POST['confirmpassword'])) {
                            if ($_POST['confirmpassword'] !== "") {
                                if (isset($_POST['mail'])) {
                                    if ($_POST['mail'] !== "") {
                                        if (preg_match("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])) {
                                            if ($_POST['password'] == $_POST['confirmpassword']) {
                                                $nickname = htmlspecialchars(strip_tags($_POST['nickname']));
                                                $password = htmlspecialchars(strip_tags($_POST['password']));
                                                $password = password_hash($password, PASSWORD_DEFAULT);
                                                $mail = htmlspecialchars(strip_tags($_POST['mail']));
                                                $objectAdmin = new Admin([
                                                    'name' => $nickname,
                                                    'password' => $password,
                                                    'mail' => $mail
                                                ]);
                                                $getAdmin = $adminManager->getAdminByName($objectAdmin);
                                                if (!$getAdmin) {
                                                    $adminManager->addAdmin($objectAdmin);
                                                    $messageConnection = "Inscription terminées, merci de vous connecter.";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

require "../views/connectVue.php";
