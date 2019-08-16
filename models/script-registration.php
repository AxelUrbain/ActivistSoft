<?php
//SCRIPT INSCRIPTION
require 'dbconfig.php';

function registration($bdd){
  $error= array();
  $success = array();

  //echo $name.' '.$firstname.' '.$ddn.' '.$town.' '.$cp.' '.$address.' '.$phone.' '.$email.' '.$password.' '.$repeat_password;
  //Si le bouton est appuyé
  if(isset($_POST['submit_registration'])){
    //récupérer les champs de manière sécurisé
    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $ddn = htmlspecialchars($_POST['ddn']);
    $town = htmlspecialchars($_POST['town']);
    $address = htmlspecialchars($_POST['address']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $repeat_password = htmlspecialchars($_POST['repeat_password']);
    $cp = htmlspecialchars($_POST['cp']);
    $phone = htmlspecialchars($_POST['phone']);
    //Test si les champs sont remplis
    if(!empty($name) && !empty($firstname) && !empty($ddn) && !empty($town)
    && !empty($address) && !empty($email) && !empty($password) && !empty($repeat_password)
    && !empty($cp) && !empty($phone)){
      //Vérifier le Nom , Prénom, Ville
      if(preg_match("/^[a-zA-Z ]*$/",$name) && preg_match("/^[a-zA-Z ]*$/",$firstname)){
        //Vérifier code postal ----- && preg_match("/^[a-zA-Z ]*$/",$town)
        if(preg_match("/^[0-9]{5,5}$/",$cp)){
          //Vérifier le numéro de téléphone
          if(preg_match("/^((\+|00)33\s?|0)[67](\s?\d{2}){4}$/",$phone)){
            //SI Vérifier si le numéro est déjà utilisé dans la bdd
            $reqphone = $bdd->prepare("SELECT phone FROM activist WHERE phone = ?");
            $reqphone->execute(array($phone));
            $existphone = $reqphone->rowCount();
            if($existphone == 1){
              $error = '<div class="alert alert-danger">ERREUR - Le numéro est déjà utilisé !</div>';
              return $error;
            }
            //SINON Vérifier l'age
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$ddn)){
              //Vérifier si l'utilisateur est majeur
              $date = new DateTime();
              //date - 18 ans
              $date18 = $date->sub(new DateInterval('P18Y'));
              $date_naissance = new DateTime($ddn);
              if($date_naissance >= $date18){
                $error = '<div class="alert alert-danger">ERREUR - Il faut être majeur !</div>';
                return $error;
              }
              else {
                //Vérification des mots de passes
                //Vérifier si le mdp contient 8 caractères
                if(strlen($password)>=8){
                  //Vérifier si les deux mdp sont bons
                  if ($password == $repeat_password) {
                    //Alors hashage du mdp avec BCRYPT
                    $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                    //SI Vérification si le mdp hashé est déjà utilisé par un utilisateur
                    //..........................................................

                    //SINON Vérification de l'adresse mail
                    if(preg_match("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/",$email)){
                      //SI Vérifier si l'adresse mail est déjà utilisé par un utilisateur
                      $reqemail = $bdd->prepare("SELECT email FROM activist WHERE email = ?");
                      $reqemail->execute(array($email));
                      $existemail = $reqemail->rowCount();
                      if($existemail == 1){
                        $error = '<div class="alert alert-danger">ERREUR - Email déjà utilisé !</div>';
                        return $error;
                      }
                      //SINON ---- SCRIPT ENVOIE UN MAIL DE CONFIRMATION
                      //Génération d'une clé aléatoire
                      $lengthkey = 15;
                      $key = "";
                      for ($i=1; $i < $lengthkey; $i++) {
                        $key .= mt_rand(0,9);
                      }
                      //Insertion de tout les éléments dans la table membre
                      $insertactivist = $bdd->prepare('INSERT INTO activist(name, firstname, age, town, cp, address, phone, email, password, confirmkey, confirme)
                      VALUES(:name,:firstname,:age,:town,:cp,:address,:phone,:email,:password,:confirmkey,0)');

                      $insertactivist->execute(array(
                        'name'=> $name,
                        'firstname'=> $firstname,
                        'age'=> $ddn,
                        'town'=> $town,
                        'cp'=> $cp,
                        'address'=> $address,
                        'phone'=> $phone,
                        'email'=> $email,
                        'password'=> $password_hashed,
                        'confirmkey'=> $key
                      ));
                      //Envoi d'un mail de vérification
                      $header="MIME-Version: 1.0\r\n";
                      $header.='From:"ActivistSoft.fr"<support@activistsoft.fr>'."\n";
                      $header.='Content-Type:text/html; charset="uft-8"'."\n";
                      $header.='Content-Transfer-Encoding: 8bit';
                      $message='
                      <html>
                         <body>
                         <head>
                         <meta charset="utf-8">
                         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
                          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
                         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
                         integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
                         <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
                         <link rel="stylesheet" type="text/css" href="css/style.css">
                         <link rel="stylesheet" type="text/css" href="../css/style.css">
                        <title>ActivistSoft</title>
                         </head>
                            <div style="color:#16a085;" align="center">
                               <h1 style="font-size:32px;">ACTIVISTSOFT</h1>
                               <h2>Merci de vous êtres inscrit sur ActivistSoft.fr</h2>
                               <p style="font-size:16px;">Sans plus attendre veuillez confirmer votre compte ci-dessous !</p>
                                 <a style="text-decoration: none;
                                 font-size: 24px;
                                 height:75px;
                                 width:200px;
                                 background-color:#38ada9;
                                 color:white;
                                 border-radius:10px;
                                 padding-top:10px;
                                 padding-bottom:10px;
                                 padding-left:10px;
                                 padding-right:10px;"
                                 href="http://127.0.0.1/my-app/ActivistSoft/models/confirm-registration.php?name='.urlencode($name).'&firstname='.urlencode($firstname).'&key='.$key.'">Confirmez votre compte !</a>
                                 <br>
                            </div>
                         </body>
                      </html>
                      ';
                      //Corriger le problème du mail !!!
                      mail("urbain.axel79@gmail.com", "Confirmation de compte", $message, $header);
                      $erreur = "Votre compte a bien été créé ! <a href=\"index.php\">Me connecter</a>";
                      $success = '<div class="success alert-success">Votre compte est créé ! Un mail de confirmation a été envoyé !</div>';
                      return $success;
                    }
                    else {
                      $error = '<div class="alert alert-danger">ERREUR - Votre adresse email est incorrecte !</div>';
                      return $error;
                    }
                  }
                  else {
                    $error = '<div class="alert alert-danger">ERREUR - Les mots de passes ne sont pas correct !</div>';
                    return $error;
                  }
                }
                else {
                  $error = '<div class="alert alert-danger">ERREUR - Le mot de passe est trop court !</div>';
                  return $error;
                }
              }
            }
            else {
              $error = '<div class="alert alert-danger">ERREUR - Le format de la date de naissance est invalide !</div>';
              return $error;
            }
          }
          else {
            $error = '<div class="alert alert-danger">ERREUR - Votre numéro de téléphone est invalide !</div>';
            return $error;
          }
        }
        else {
          $error = '<div class="alert alert-danger">ERREUR - Votre code postal est invalide !</div>';
          return $error;
        }
      }
      else {
        $error = '<div class="alert alert-danger">ERREUR - Veuillez correctement remplir les champs !</div>';
        return $error;
      }
    }
    else{
      $error = '<div class="alert alert-danger">ERREUR - Veuillez remplir les champs !</div>';
      return $error;
    }
  }

}
