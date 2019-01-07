<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <?php foreach ($getUserToken as $user) {
    ?>
    <h1 class="font-weight-bold text-center">Profil de <?= $user->getFirstName() ?></h1>
    <p>Prénom: <?= $user->getFirstName() ?></p>
    <p>Nom: <?= $user->getLastName() ?></p>
    <p>Identifiant: <?= $user->getTokenId() ?></p>
    <p>Nombre de livre emprunté: <?php
    $i = 0;
    foreach ($getBookByUserId as $book) {
        $i++;
    }
    echo $i; ?></p>
    <p>Nom des livres emprunté: <?php foreach ($getBookByUserId as $book) {
        echo '<a href="booksDetail.php?id='. $book->getId() .'" target="_blank">'.ucfirst($book->getTitle()).'</a>, ';
    } ?></p>
<?php
} ?>

</div>

<?php include("template/footer.php");
