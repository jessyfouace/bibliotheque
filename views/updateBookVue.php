<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <form action="updateBook.php" method="post">
    <?php
    foreach ($booksAndCategorieById[0] as $book) {
        ?>
        <div class="row col-12 m-0">
            <div class="col-12 col-md-5 mx-auto mt-4">
                <label for="title">Titre: </label>
                <input type="text" class="col-12" name="title" id="title" value="<?= $book->getTitle(); ?>">
            </div>
            <div class="col-12 col-md-5 mx-auto mt-4">
                <label for="author">Auteur: </label>
                <input type="text" class="col-12" name="author" id='author' value="<?= $book->getAuthor(); ?>">
            </div>
        </div>
        <div class="row col-12 m-0">
            <div class="col-12 col-md-5 mx-auto mt-4">
                <label for="parution">Date de parution: </label>
                <input type="date" class="col-12" name="apparution" id="parution" value="<?= $book->getApparution(); ?>">
            </div>        
            <div class="col-12 col-md-5 mx-auto mt-4">
                <label for="selectCategory">Catégorie:</label><br>
                <select id="selectCategory" name="category" required>
        <?php
        foreach ($booksAndCategorieById[1] as $category) {
            ?>
            <?php foreach ($getAllCategory as $categorie) {
                if ($categorie->getName() == $category->getName()) {
                    ?>
                    <option value="<?= $categorie->getName() ?>" selected><?= $categorie->getName() ?></option>
                <?php
                } else {
                    ?>
                    <option value="<?= $categorie->getName() ?>"><?= $categorie->getName() ?></option>
                <?php
                }
            }
        } ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-10 mx-auto mt-4">
            <label for="desc">Descriptif:</label>
            <textarea name="content" class="col-12" id="desc" cols="30" rows="10"><?= $book->getContent(); ?></textarea>
        </div>
    <?php
    }
    ?>
    </form>
</div>

<?php include("template/footer.php");
