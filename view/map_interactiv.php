<?php
require '../models/dbconfig.php';
require '../models/script-connect.php';
session_start();
if(empty($_SESSION['email']) OR empty($_SESSION['id_role'])){
  header('Location: ../index.php');
  exit();
}
elseif ($_SESSION['id_role'] != 2) {
  header('Location: ../index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<?php include('../template/header.php'); ?>
  <head>
    <meta charset="utf-8">
    <title>ActivistSoft</title>
  </head>
  <body>
    <div id="menu">
      <nav class="navbar navbar-expand-lg">
        <a class="color-menu" href="../index.php">
          <img class="img-fluid" src="../img/logo.png" alt="">
        </a>
      </nav>
    </div>
    <div class="container-fluid" style="padding-top: 18%; padding-bottom: 20%; background-color:#ecf0f1; color:#e67e22; text-align:center; height:850px;">
      <center>Votre compte est en cours de vérification ! Cela peut prendre quelques jours !</center>
      <h1 style="">Vous êtes militant de la plateforme</h1>
    </div>
    <?php include('../template/footer.php'); ?>
  </body>
    <?php include('../template/framework.php'); ?>
</html>
