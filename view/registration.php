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
    <div id="" class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4">
          <h1 class="form-text">Inscription</h1>
          <form action="../models/script-registration.php" method="post">
            <div class="row">
              <div class="col form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control" placeholder="Martin" required>
              </div>
              <div class="col form-group">
                <label for="firstname">Prenom</label>
                <input type="text" name="firstname" class="form-control" placeholder="Thomas" required>
              </div>
            </div>
            <div class="form-group">
              <label for="ddn">Date de Naissance</label>
              <input type="date" name="ddn" class="form-control" placeholder="" required>
            </div>
            <div class="row">
              <div class="col form-group">
                <label for="ville">Ville</label>
                <input type="text" name="town" class="form-control" placeholder="Thouars" required>
              </div>
              <div class="col form-group">
                <label for="cp">Code Postal</label>
                <input type="text" name="cp" class="form-control" placeholder="79000" required>
              </div>
            </div>
            <div class="form-group">
              <label for="address">Adresse</label>
              <input type="text" name="address" class="form-control" placeholder="20 rue du lac" required>
            </div>
            <div class="row">
              <div class="col form-group">
                <label for="email">E-Mail</label>
                <input type="email" name="email" class="form-control" placeholder="machin@free.fr" required>
              </div>
              <div class="col form-group">
                <label for="tel">Numéro de Téléphone</label>
                <input type="tel" name="phone" class="form-control" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required>
              </div>
            </div>
            <div class="row">
              <div class="col form-group">
                <label for=password>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="col form-group">
                <label for=password>Répétez votre mot de passe</label>
                <input type="password" name="repeat_password" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <input type="checkbox" class="form-check-input" required>
              <label class="form-check-label" for="">Je ne suis pas un robot</label>
            </div>
            <button type="submit" name="submit" class="btn btn-color btn-lg btn-block">Vous inscrire</button>
          </form>
        </div>
        <div class="col-lg-4 col-md-4"></div>
      </div>
      <div class="clear"></div>
    </div>
    <?php include('../template/footer.php'); ?>
  </body>
  <?php include('../template/framework.php'); ?>
</html>
