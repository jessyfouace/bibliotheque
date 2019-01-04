<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <?php if (isset($message)) {
    ?>
        <p class="<?= $color ?> font-weight-bold text-center"><?= $message; ?></p>
    <?php
} ?>
    <form action="addUser.php" method="post">
        <div class="row col-12 col-md-6 mx-auto">
            <div class="mx-auto">    
                <label for="firstname">Prénom: </label><br>
                <input type="text" name="firstname" placeholder="Prénom" id="firstname" required>
            </div>
            <div class="mx-auto">
                <label for="lastname">Nom: </label><br>
                <input type="text" name="lastname" placeholder="Nom" id="lastname" required><br>
            </div>
        </div>
        <div class="col-12 col-md-6 text-center mx-auto">
            <input type="submit" class="btn btn-primary mt-2" name="submit" value="Créer utilisateur">
        </div>
    </form>
</div>

<?php include("template/footer.php");
