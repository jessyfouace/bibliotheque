<?php
include("template/header.php");
include("template/navbar.php");
?>

<div id="container">
    <p class="text-center font-weight-bold pt-3">Ajouter un livre</p>
    <p class="<?= $colorgreen ?> text-center font-weight-bold"><?= $message ?></p>
    <form action="addBooks.php" method="post" enctype="multipart/form-data">
    <div class="row col-10 mx-auto m-0 p-0">
        <div class="col-12 col-md-6 mx-auto mt-3">
            <label for="title">Titre:</label><br>
            <input type="text" class="col-12 mx-auto" id="title" name="title">
        </div>
        <div class="col-12 col-md-6 mx-auto mt-3">
            <label for="author">Auteur:</label><br>
            <input type="text" class="col-12 mx-auto" id="author" name="author">
        </div>
    </div>
    <div class="row col-10 mx-auto m-0 p-0">
        <div class="col-12 col-md-6 mx-auto mt-3">
            <label for="date">Date d'apparution:</label><br>
            <input type="date" class="col-12 mx-auto" id="date" name="date">
        </div>
        <div class="col-12 col-md-6 mx-auto mt-3">
            <label for="selectCategory">Catégorie:</label><br>
            <select id="selectCategory" name="category" required>
                <option value="catégorie" disabled selected>Catégorie</option>
                <?php
                foreach ($allCategories as $category) {
                    ?>
                    <option value="<?= $category->getIdCategory() ?>"><?= $category->getName() ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-10 mx-auto mt-3">
        <label for="desc">Descriptif:</label>
        <textarea class="col-12 " id="desc" name="desc" cols="30" rows="10"></textarea><br>
    </div>
    <div class="row col-10 mx-auto m-0 p-0">
        <div class="col-12 col-md-6 mx-auto mt-3">
            <input type="file" name="image">
        </div>
        <div class="col-12 col-md-6 mx-auto mt-3">
            <label for="alt">Description Image:</label>
            <input type="text" name="alt" id="alt" class="mx-auto">
        </div>
    </div>
    <div class="col-10 mt-3 mx-auto">
        <input type="submit" value="Créer le livre" class="btn btn-primary">
    </div>
    </form>
</div>

<?php include("template/footer.php");
