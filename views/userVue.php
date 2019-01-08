<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <h1 class="text-center">Listes des utilisateurs</h1>
    <form class="text-center" action="addUser.php" method="get">
        <input type="submit" class="btn btn-info" value="Créer un utilisateur">
    </form>
    <form class="row mt-2 col-10 col-md-6 mx-auto text-center" action="user.php" method="get">
        <div class="selectWrapper noborder col">
            <select class="" name="name" required>
                <option value="tokenId" selected>Identifiant</option>
            </select>
        </div>
        <div class="m-0 p-0">
            <input type="search" class="userSearch col p-0" name="terme" required>
        </div>
        <input class="btn btn-primary col" type="submit" name="s" value="Rechercher" required>
    </form>
    <p class="<?= $colorred ?> text-center font-weight-bold"><?= $message ?></p>
    <div class="col-12 row m-0">
    <?php foreach ($getAllUsers as $user) {
    ?>
        <div class="col-11 col-md-5 col-lg-3 m-0 p-0 mt-2 mx-auto">
            <div class="col-11 col-md-9 text-center mx-auto borderall m-0 p-0">
                <p>Nom: <?= $user->getFirstName() . ' ' . $user->getLastName() ?></p>
                <p>Id: <?= $user->getTokenId() ?></p>
                <form action="userDetail.php" method="post"><input type="hidden" value="<?= $user->getTokenId(); ?>" name="userToken"><input type="hidden" value="<?= $user->getIdUser(); ?>" name="userId"><input class="btn btn-dark" type="submit" value="Voir Page"></form>
                <div class="row m-0 p-0 mt-2 mb-1 text-center">
                    <form class="mx-auto" action="userUpdate.php" method="post"><input type="hidden" value="<?= $user->getTokenId(); ?>" name="userToken"><input class="btn btn-warning" name="edit" type="submit" value="Editer"></form>
                    <form class="mx-auto" action="userDelete.php" method="post"><input type="hidden" value="<?= $user->getIdUser(); ?>" name="userId"><input class="btn btn-danger" name="delete" type="submit" value="Supprimer"></form>
                </div>
            </div>
        </div>
<?php
} ?>
</div>
</div>

<?php include("template/footer.php");
