<?php
session_start();
if (isset($_SESSION['name'])) {
} else {
    header('location: connect.php');
}

session_destroy();
header('location: connect.php');
