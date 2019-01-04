<?php
  include("template/header.php");
  include("template/navbar.php");
?>

<div id="container">
    <?php
    foreach ($booksAndCategorieById[0] as $key => $bookInfo) {
        ?>
        <nav class="fixedbc position-fixed">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="noeffectblack" href="index.php">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($bookInfo->getTitle()) ?></li>
            </ol>
        </nav>
        <?php if ($bookInfo->getDisponibility() == 0) {
            ?>
            <div class="row col-12 text-center pt-5">
                <?php
                if (isset($booksAndCategorieById[2])) {
                    foreach ($booksAndCategorieById[2] as $user) {
                        ?>
                <p class="mr-2 colorred font-weight-bold">Ce livre est déjà emprunté par <?= $user->getFirstName().' '.$user->getLastName(); ?></p>
                <form class="mx-auto m-md-0" action="booksUnset.php" method="post">
                    <input type="hidden" value="<?= $bookInfo->getId() ?>" name="idBook">
                    <input type="hidden" value="<?= $user->getIdUser() ?>" name="idUser">
                    <input type="hidden" value="<?= $token ?>" name="token">
                    <input type="submit" class="btn btn-danger" value="Restituer">
                </form>
                <?php
                    }
                } ?>
            </div>
        <?php
        } else {
            ?>
                <p class="pt-5 colorgreen font-weight-bold">Ce livre est disponible.</p>
        <?php
        } ?>
        <div class="row d-flex mt-5">
            <div class="text-center col-11 col-md-6 my-auto">
                <?php foreach ($booksAndCategorieById[3] as $keyImage => $image) {
            if ($key == $keyImage) {
                ?>
                    <img style="max-width: 100%; max-height: 400px" src="<?= $image->getNameImage(); ?>" alt="<?= $image->getAlt() ?>">
                <?php
            }
        } ?>
            </div>
            <div class="col-11 col-md-6">
                <p>Titre: <?= ucfirst($bookInfo->getTitle()); ?></p>
                <p>Auteur: <?= ucfirst($bookInfo->getAuthor()); ?></p>
                <p>Date de parrution: <?php $bookDate = date_create($bookInfo->getApparution());
        echo $bookDate->format('d-m-Y')?></p>
                <?php foreach ($booksAndCategorieById[1] as $bookCategorie) {
            ?>
                <p>Catégorie: <?= ucfirst($bookCategorie->getName()) ?></p>
        <?php
        } ?>
                <div class="line"></div>
                <p>Descriptif: <?= ucfirst($bookInfo->getContent()); ?></p>
            </div>
        </div>
        <div class="m-0 p-0">
            <?php if ($bookInfo->getDisponibility() == 1) {
            ?>
                <form class="row" action="attributeBooks.php" method="post">
                    <div class="mr-2 ml-5 mt-5 selectWrapper">
                        <select name="idUser" required>
                            <option value="" disabled selected>Utilisateurs</option>
                            
                            <?php
                            foreach ($getAllUsers as $user) {
                                ?>
                                <option value="<?php echo $user->getIdUser() ; ?>"><?php echo $user->getFirstName() . ' ' . $user->getLastName() ; ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <input type="hidden" value="<?= $bookInfo->getId(); ?>" name="idBook">
                    <input type="submit" class="btn btn-primary mt-5" name="attribute" value="Attribuer">
                </form>
            <?php
        } ?>
        </div>
        <div class="row col-12 text-center m-0 p-0 pt-5">
            <form action="updateBook.php" method="post">
                <div class="mr-2 ml-5">
                    <input type="hidden" name="idBook" value="<?= $bookInfo->getId(); ?>">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <input type="submit" class="btn btn-warning" name="update" value="Modifier le livre">
                </div>
            </form>
            <?php if ($bookInfo->getDisponibility() == 1) {
            ?>
            <form action="deleteBook.php" method="post">
                <div class="mr-2 ml-5">
                    <input type="hidden" name="idBook" value="<?= $bookInfo->getId(); ?>">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <input type="submit" class="btn btn-danger" name="delete" value="Supprimer le livre">
                </div>
            </form>
            <?php
        } ?>
        </div>
    <?php
    }
            ?>
</div>

<?php include("template/footer.php");
