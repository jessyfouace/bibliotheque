<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <form action="updateBook.php" method="post" enctype="multipart/form-data">
    <?php
    foreach ($booksAndCategorieById[0] as $book) {
        ?>
        <div class="row col-12 col-md-10 mx-auto m-0 p-0">
            <div class="col-12 col-md-6 mx-auto mt-4">
                <label for="title">Titre: </label>
                <input type="text" class="col-12" name="title" id="title" value="<?= $book->getTitle(); ?>" required>
            </div>
            <div class="col-12 col-md-6 mx-auto mt-4">
                <label for="author">Auteur: </label>
                <input type="text" class="col-12" name="author" id='author' value="<?= $book->getAuthor(); ?>" required>
            </div>
        </div>
        <div class="row col-12 col-md-10 mx-auto p-0 m-0">
            <div class="col-12 col-md-6 mx-auto mt-4">
                <label for="parution">Date de parution: </label>
                <input type="date" class="col-12" name="apparution" id="parution" value="<?= $book->getApparution(); ?>" required>
            </div>        
            <div class="col-12 col-md-6 mx-auto mt-4">
                <label for="selectCategory">Catégorie:</label><br>
                <select id="selectCategory" name="category" required>
        <?php
        foreach ($booksAndCategorieById[1] as $category) {
            ?>
            <?php foreach ($getAllCategory as $categorie) {
                if ($categorie->getName() == $category->getName()) {
                    ?>
                    <option value="<?= $categorie->getIdCategory() ?>" selected><?= $categorie->getName() ?></option>
                <?php
                } else {
                    ?>
                    <option value="<?= $categorie->getIdCategory() ?>"><?= $categorie->getName() ?></option>
                <?php
                }
            }
        } ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-10 mx-auto mt-4">
            <label for="desc">Descriptif:</label><br>
            <textarea name="content" class="col-12" id="desc" cols="30" rows="10" required><?= $book->getContent(); ?></textarea>
        </div>
        <div class="row col-12 col-md-10 mx-auto mt-4">
            <?php foreach ($booksAndCategorieById[3] as $image) {
            if ($image->getIdImage() !== 1) {
                ?>
            <p class="my-auto mx-auto">Ancienne Image:</p><br>
            <div class="col-12 d-flex">
                <img style="height: 170px; max-width: 90%" class="mx-auto" id="lastimg" src="<?= $image->getNameImage() ?>" alt="<?= $image->getAlt() ?>">
            </div>
        <?php
            } ?>
            <input type="hidden" name="lastIdImg" value="<?= $image->getIdImage(); ?>">
            <input type="hidden" name="lastNameImg" value="<?= $image->getNameImage(); ?>">
        <?php
        } ?>
        </div>
        <div class="col-12 col-md-10 mx-auto mt-4 text-center">
            <label for="file">Nouvelle Image:</label><br>
            <input type="file" id="file" name="image">
        </div>
        <div class="col-12 col-md-10 mx-auto mt-4 text-center">
            <label for="lastalt">Description Image:</label><br>
            <input type="text" name="alt" class="col-12" value="<?php if ($image->getIdImage() !== 1) {
            echo $image->getAlt();
        } ?>">
        </div>
    <?php
    }
    ?>
    <input type="hidden" name="idBook" value="<?= $book->getId(); ?>">
    <div class="col-12 col-md-10 mx-auto mt-4 mb-4 text-center">
        <input type="submit" value="Editer" name="update" class="btn btn-primary">
    </div>
    </form>
</div>

<?php include("template/footer.php");
