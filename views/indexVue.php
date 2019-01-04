<?php
  include("template/header.php");
  include("template/navbar.php");
  ?>
<div id="container">
  <div class="row m-0 p-0">
    <form action="index.php" method="get">
      <input type="search" name="terme">
      <input class="mr-2 btn btn-primary" type="submit" name="s" value="Rechercher">
    </form>
    <form action="index.php" method="post">
      <input type="submit" class="btn btn-danger" value="Annuler">
    </form>
  </div>
  <?php if (isset($reponse)) {
      ?>
      <p class="<?= $color ?>"><?= $reponse; ?></p>
  <?php
  } ?>
  <div class="row col-12">
    <?php
    if (!isset($_GET['terme'])) {
        foreach ($allBooksAndImages[0] as $key => $book) {
            ?>
          <div class="m-0 p-0 col-11 col-md-3 mt-4 mx-auto">
            <div class="col-12 col-md-10 m-0 p-0 mx-auto text-center hovereffect">
              <a class="noeffect" href="booksDetail.php?id=<?= $book->getId() ?>">
                  <?php foreach ($allBooksAndImages[1] as $keyImage => $images) {
                if ($key == $keyImage) {
                    ?>
                  <img style="min-width: 100px; max-width: 100%; max-height: 150px; min-height: 150px;" src="<?= $images->getNameImage() ?>" alt="<?= $images->getAlt() ?>"><br>
          <?php
                }
            } ?>
                <p class="font-weight-bold"><?= ucfirst($book->getTitle()); ?></p>
              </a>
            </div>
          </div>
      <?php
        }
    } else {
        foreach ($bookByName[0] as $key => $book) {
            ?>
          <div class="m-0 p-0 col-11 col-md-3 mt-4 mx-auto">
            <div class="col-12 col-md-10 m-0 p-0 mx-auto text-center hovereffect">
              <a class="noeffect" href="booksDetail.php?id=<?= $book->getId() ?>">
                  <?php foreach ($bookByName[1] as $keyImage => $images) {
                if ($key == $keyImage) {
                    ?>
                  <img style="min-width: 100px; max-width: 100%; max-height: 150px; min-height: 150px;" src="<?= $images->getNameImage() ?>" alt="<?= $images->getAlt() ?>"><br>
          <?php
                }
            } ?>
                <p class="font-weight-bold"><?= ucfirst($book->getTitle()); ?></p>
              </a>
            </div>
          </div>
      <?php
        }
    }
    ?>
  </div>
</div>

<?php include("template/footer.php");
