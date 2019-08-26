<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <?php include('../template/header.php'); ?>
  <body>
    <div id="menu">
      <nav class="navbar navbar-expand-lg">
        <a class="color-menu" href="../index.php">
          <img class="img-fluid" src="../img/logo.png" alt="">
        </a>
      </nav>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4">
          <h4 class="">Récupération de mot de passe</h4>
            <?php if($_GET['section'] == 'code') { ?>
              Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>
              <br/>
              <form method="post">
                <input type="text" placeholder="Code de vérification" name="verif_code"/><br/>
                <input type="submit" value="Valider" name="verif_submit"/>
              </form>
            <?php } elseif($_GET['section'] == "changemdp") { ?>
            Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
            <form method="post">
              <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/><br/>
              <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/>
              <input type="submit" value="Valider" name="change_submit"/>
            </form>
            <?php } else { ?>
            <form method="post">
              <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/>
              <input type="submit" value="Valider" name="recup_submit"/>
            </form>
            <?php } ?>
            <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo ""; } ?>
        </div>
        <div class="col-lg-4 col-md-4"></div>
      </div>
    </div>
    <?php include('../template/footer.php'); ?>
  </body>
  <?php include('../template/framework.php'); ?>
</html>
