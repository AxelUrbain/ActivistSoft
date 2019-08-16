<?php
require 'dbconfig.php';

function connect_activist($bdd){
  $error = array();
  if(isset($_POST['button_connect'])){
    //Vérification des champs
    if(empty($_POST['email']) OR empty($_POST['password'])){
      if(empty($_POST['email'])){
        $error = '<div class="alert alert-danger">ERREUR - Le champ utilisateur est vide !</div>';
      }
      if(empty($_POST['password'])){
        $error ='<div class="alert alert-danger">ERREUR - Le champ mot de passe est vide !</div>';
      }
      return $error;
    }
    else{
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);

      $reqconnect = $bdd->prepare("SELECT * FROM activist WHERE email = ?");
      $reqconnect->execute(array($email));
      $userexist = $reqconnect->rowCount();

      if($userexist == 1){
        $user = $reqconnect->fetch();
        //récupérer le mdp
        $password_hashed = $user['password'];
        if(password_verify($password, $password_hashed)){
          if(!empty($user['confirmkey']) AND $user['confirme'] == 1){
            //Déterminer le role de l'utilisateur
            if(!empty($user['role'])){
              if($user['role'] == 1){
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['id_role'] = $user['role'];
                //Connexion en tant que visiteur
                header('Location: view/visitor.php');
                exit();
              }
              elseif($user['role'] == 2){
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['id_role'] = $user['role'];
                //Connexion en tant que militant
                header('Location: view/map_interactiv.php');
                exit();
              }
              elseif ($user['role'] == 3) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['id_role'] = $user['role']; 
                //Connexion en tant que administrateur
                header('Location: view/panel_admin.php');
                exit();
              }
              else {
                $error = '<div class="alert alert-danger">ERREUR - Role inexistant !</div>';
                return $error;
              }
            }
            else {
              $error = '<div class="alert alert-danger">ERREUR - Militant sans role - Contacter administrateur !</div>';
              return $error;
            }
          }
          else{
            $error = '<div class="alert alert-danger">ERREUR - Compte pas activé !</div>';
            return $error;
          }
        }
        else {
            $error = '<div class="alert alert-danger">ERREUR - Mauvais mot de passe !</div>';
            return $error;
        }
      }
      else {
        $error = '<div class="alert alert-danger">ERREUR - Mauvais nom utilisateur ou mot de passe !</div>';
        return $error;
      }
    }
  }
}
?>
