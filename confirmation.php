<?php
// try{
//   $db = new PDO('mysql:host=localhost;dbname=HJQ', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// }catch(Exception $e){
//   die('Erreur : ' . $e->getMessage()); // Si erreur, afficher le message d'erreur
// }

//Connexion à la base de données
include('includes/db_connexion.php');

if isset($_POST['confirmation']){ //si le bouton confirmer est touché la colonne passe à 1
 $u= 'UPDATE user SET confirme = 1';
 $req = $db->prepare($u);
 header('location: inscription.php'); //redirection vers la page de connexion
 exit;
}




 ?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="index.php" method="post">
      <p> Veuillez appuyer sur le confirmer pour valider votre compte <p>
      <input type="submit" name="confirmation" value="confirmer">
    </form>
  </body>
</html>
