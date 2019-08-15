<?php
require 'models/script-connect.php';
require 'models/dbconfig.php';

$result = connect_activist($bdd);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <?php include('template/header.php'); ?>
  <body>
    <div id="menu">
      <nav class="navbar navbar-expand-lg">
        <a class="color-menu" href="#">
          <img src="img/logo.png" alt="">
        </a>
      </nav>
    </div>
    <div id="body-main" class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4">
          <h1 class="form-text">Connexion</h1>
          <!-- Gestion des erreurs de connexion -->
          <center> <?php echo $result; ?> </center>
          <form action="index.php" method="post">
            <div class="form-group">
              <label for="email">Identifiant</label>
              <input type="email" name="email" class="form-control" placeholder="martin.michel@free.fr" required>
            </div>
            <div class="form-group">
              <label for=password>Mot de passe</label>
              <input type="password" name="password" class="form-control" placeholder="Mot de Passe" required>
              <a href="view/mdpforget.php"><small id="mdpforget" class="text-muted">Mot de passe oublié ?</small></a>
              <a href="view/registration.php"><small id="registration" class="text-muted">Vous souhaitez vous inscrire ?</small></a>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" name="captcha" class="form-check-input" required>
              <label class="form-check-label">Je ne suis pas un robot</label>
            </div>
            <button type="submit" name="button_connect" class="btn btn-color btn-lg btn-block">Connexion</button>
          </form>
        </div>
        <div class="col-lg-4 col-md-4"></div>
      </div>
    </div>
    <?php include('template/footer.php'); ?>
  </body>
  <?php include('template/framework.php'); ?>
</html>
