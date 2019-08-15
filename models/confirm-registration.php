<?php
require 'dbconfig.php';

if(isset($_GET['name'], $_GET['firstname'], $_GET['key']) AND !empty($_GET['name']) AND !empty($_GET['firstname']) AND !empty($_GET['key'])) {
   $name = htmlspecialchars(urldecode($_GET['name']));
   $firstname = htmlspecialchars(urldecode($_GET['firstname']));
   $key = htmlspecialchars($_GET['key']);

   $requser = $bdd->prepare("SELECT * FROM activist WHERE name = ? AND firstname = ? AND confirmkey = ?");
   $requser->execute(array($name, $firstname, $key));
   $userexist = $requser->rowCount();
   if($userexist == 1) {
      $user = $requser->fetch();
      if($user['confirme'] == 0) {
         $updateuser = $bdd->prepare("UPDATE activist SET confirme = 1 WHERE name = ? AND firstname = ? AND confirmkey = ?");
         $updateuser->execute(array($name, $firstname, $key));
         echo "Votre compte a bien été confirmé !";
         header('Location: ../index.php');
         exit();
      } else {
         echo "Votre compte a déjà été confirmé !";
      }
   } else {
      echo "L'utilisateur n'existe pas !";
   }
}
