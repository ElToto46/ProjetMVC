<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Brand</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div_1 class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if(!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
          echo '<a class="nav-link" href="?page=login">Login</a>';
          echo '<a class="nav-item nav-link" href="?page=CreationCompte">S\'inscrire</a>';
      }else{echo '<a class="nav-link" href="?action=user-logout">Logout</a>';
      '<a class="nav-link" href="?action=ModifierCompte">Modifier le compte</a>';}?>
      
  </div_1>
</nav>
    
