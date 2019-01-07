<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <?php foreach ($getUserToken as $user) {
    ?>
    <form action="userUpdate.php" method="post">
        <div class="row col-12 m-0">
            <div class="col-12 col-md-5 mx-auto">
                <label for="firstname">Prénom:</label>
                <input type="text" class="col-12" name="firstname" id="firstname" value="<?= $user->getFirstName() ?>">
            </div>
            <div class="col-12 col-md-5 mx-auto">
                <label for="lastname">Nom:</label>
                <input type="text" name="lastname" class="col-12" id="lastname" value="<?= $user->getLastName() ?>">
            </div>
        </div>
        <input type="hidden" name="userid" value="<?= $user->getIdUser() ?>">
        <input type="hidden" name="tokenid" value="<?= $user->getTokenId() ?>">
        <div class="col-12 mx-auto text-center mt-4">
            <input type="submit" name="update" class="btn btn-primary" value="Editer">
        </div>
    </form>
    <?php
} ?>

</div>

<?php include("template/footer.php");
