<nav id="effectClick" class="navbar-primary">
  <ul class="navbar-primary-menu">
    <li>
      <img style="width: 50%;" class="mx-auto d-none d-md-block" src="../assets/img/user.png" alt="Photo Utilisateur">
      <span class="nav-label navName"> Bonjour <?php echo ucfirst($_SESSION['name']) ?></span>
      
      <a href="index.php" class="<?php if (isset($indexActive)) {
    echo $indexActive;
} ?>"><i class="fas fa-home"></i><span class="nav-label"> Accueil</span></a>
      
      <a href="user.php" class="<?php if (isset($userActive)) {
    echo $userActive;
} ?>"><i class="fas fa-users"></i><span class="nav-label"> Utilisateurs</span></a>
      
      <a href="addBooks.php" class="<?php if (isset($addActive)) {
    echo $addActive;
} ?>"><i class="fas fa-book"></i><span class="nav-label"> Ajouter Livre</span></a>

      <a href="disconnect.php"><i class="fas fa-user-slash"></i><span class="nav-label"> Déconnection</span></a>
    </li>
  </ul>
  <button id="idClick" class="btn-expand-collapse"><i id="arrow" class="fas fa-angle-left"></i></button>
</nav>
