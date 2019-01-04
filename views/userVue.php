<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <h1 class="text-center">Listes des utilisateurs</h1>
    <form class="text-center" action="addUser.php" method="post">
        <input type="submit" class="btn btn-info" value="Créer un utilisateur">
    </form>
    <div class="col-12 row">
    <?php foreach ($getAllUsers as $user) {
    ?>
        <div class="col-11 col-md-5 col-lg-3 m-0 p-0 mt-2 mx-auto">
            <div class="col-11 col-md-9 text-center mx-auto borderall m-0 p-0">
                <p>Nom: <?= $user->getFirstName() . ' ' . $user->getLastName() ?></p>
                <p>Id: <?= $user->getTokenId() ?></p>
                <form action="userDetail.php" method="post"><input type="hidden" value="<?= $user->getIdUser(); ?>" name="userId"><input class="btn btn-dark" type="submit" value="Voir Page"></form>
                <div class="row m-0 p-0 mt-2 mb-1 text-center">
                    <form class="mx-auto" action="userUpdate.php" method="post"><input type="hidden" value="<?= $user->getIdUser(); ?>" name="userId"><input class="btn btn-warning" name="edit" type="submit" value="Editer"></form>
                    <form class="mx-auto" action="userDelete.php" method="post"><input type="hidden" value="<?= $user->getIdUser(); ?>" name="userId"><input class="btn btn-danger" name="delete" type="submit" value="Supprimer"></form>
                </div>
            </div>
        </div>
<?php
} ?>
</div>
</div>

<?php include("template/footer.php");
