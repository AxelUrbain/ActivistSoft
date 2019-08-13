<?php
//SCRIPT INSCRIPTION
$error= array();
$success = array();
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

echo $name.' '.$firstname.' '.$ddn.' '.$town.' '.$address.' '.$email.' '.$password.' '.$repeat_password;
//Si le bouton est appuyé
if(isset($_POST['submit'])){
  //Test si les champs sont remplis
  if(!empty($name) && !empty($firstname) && !empty($ddn) && !empty($town)
  && !empty($address) && !empty($email) && !empty($password) && !empty($repeat_password)){
    //Vérifier le Nom , Prénom, Ville
    if(preg_match("/^[a-zA-Z ]*$/",$name) && preg_match("/^[a-zA-Z ]*$/",$firstname) && preg_match("/^[a-zA-Z ]*$/",$town)){
      //Vérifier code postal
      if(preg_match("/^[0-9]{5,5}$/",$cp)){
        //Vérifier le numéro de téléphone
        if(preg_match(" \^(\d\d\s){4}(\d\d)$\ "),$phone){
          //SI Vérifier si le numéro est déjà utilisé dans la bdd
          //..................................................

          //SINON Vérifier l'age
          if(preg_match(" \^([0-3][0-9]})(/)([0-9]{2,2})(/)([0-3]{2,2})$\ "),$ddn){
            //Vérifier si l'utilisateur est majeur
            $date = new DateTime();
            //date - 18 ans
            $date18 = $date->sub(new DateInterval('P18Y'));
            $date_naissance = new DateTime($ddn);
            if($date_naissance >= $date18){
              echo "ERREUR- Vous n'avez pas encore 18 ans !"
            }
            else {
              //Vérification des mots de passes
              //Vérifier si le mdp contient 8 caractères
              if(strlen($password)>=8){
                //Vérifier si les deux mdp sont bons
                if ($password == $repeat_password) {
                  //Alors hashage du mdp avec BCRYPT
                  $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                  echo "Test du mdp hashé : ";
                  echo $password_hashed;
                  //SI Vérification si le mdp hashé est déjà utilisé par un utilisateur
                  //..........................................................

                  //SINON Vérification de l'adresse mail
                  if(preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ",$email)){
                    //SI Vérifier si l'adresse mail est déjà utilisé par un utilisateur
                    //..............................................................
                    //SINON ---- SCRIPT ENVOIE UN MAIL DE CONFIRMATION
                    //Génération d'une clé aléatoire
                    //Insertion de tout les éléments dans la table membre
                    //Envoi d'un mail de vérification

                  }
                  else {
                    echo "Votre adresse mail n'est pas corecte !";
                  }
                }
                else {
                  echo "Les mots de passes ne sont pas correct !";
                }
              }
              else {
                echo "Le mot de passe est trop court !";
              }
            }
          }
          else {
            echo "Le format de la date de naissance n'est pas valide";
          }
        }
        else {
          echo "Votre numéro de téléphone n'est pas valide !";
        }
      }
      else {
        echo "Le code postal n'est pas valide !";
      }
    }
    else {
      echo "Les champs n'ont pas été correctement remplis !";
    }

    //Vérification et cryptage des mdp
    //inscription des infos sur bdd et envoi d'un mail de confirmation
  }
  else{
    echo "Veuillez saisir tout les champs !";
  }
}
?>
