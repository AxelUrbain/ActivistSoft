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
            <?php if(isset($_GET['section'])) {
              if($_GET['section'] == 'code'){ ?>
              Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>
              <br/>
              <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Code de vérification" name="verif_code" required/><br/>
                  <button type="submit" name="verif_submit" class="btn btn-secondary btn-lg btn-block">Valider</button>
                </div>
              </form>
            <?php } elseif($_GET['section'] == "changemdp") { ?>
            Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
            <form method="post">
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Nouveau mot de passe" name="change_mdp"/><br/>
                <input type="password" class="form-control" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/>
                <button type="submit" name="change_submit" class="btn btn-secondary btn-lg btn-block">Valider</button>
              </div>
            </form>
            <?php } } else { ?>
            <form method="post">
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Votre adresse mail" name="recup_mail"/><br/>
                <button type="submit" name="recup_submit" class="btn btn-secondary btn-lg btn-block">Valider</button>
              </div>
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
