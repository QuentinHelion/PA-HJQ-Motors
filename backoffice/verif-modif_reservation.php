<?php
  session_start();

  if(!isset($_SESSION["id"]) || empty($_SESSION["id"])){
    header("location: index.php");
    exit;
  }

  if(!isset($_POST["id"]) || empty($_POST["id"])){
    header("location: db_reservation.php");
    exit;
  }

  include('../includes/db_connexion.php');

  $s = 'SELECT admin FROM users WHERE id = ?';
  $req_select = $db->prepare($s);
  $req_select->execute([
    $_SESSION['id']
  ]);
  $select = $req_select->fetch();

  if(!$select["admin"]){
    header("location: index.php");
    exit;
  }

  $s = 'SELECT date_from, date_to FROM reservation WHERE id = ?';
  $req_select = $db->prepare($s);
  $req_select->execute([
    htmlspecialchars($_POST["id"])
  ]);
  $select = $req_select->fetch();

  if($select){
    if(isset($_POST['date_from']) && !empty($_POST['date_from']) && $select['date_from'] != $_POST['date_from']){
      $u = 'UPDATE reservation SET date_from = :date_from WHERE id = :id';
      $req_update = $db->prepare($u);
      $update = $req_update->execute([
        'date_from' => $_POST['date_from'],
        'id' => $_POST["id"]
      ]);

      if(!$update){
        // Afficher message si erreur
        header('location: profil_reservation.php?message=Erreur lors du changement');
        exit;
      }
    }

    if(isset($_POST['date_to']) && !empty($_POST['date_to']) && $select['date_to'] != $_POST['date_to']){
      $u = 'UPDATE reservation SET date_to = :date_to WHERE id = :id';
      $req_update = $db->prepare($u);
      $update = $req_update->execute([
        'date_to' => $_POST['date_to'],
        'id' => $_POST["id"]
      ]);

      if(!$update){
        // Afficher message si erreur
        header('location: db_reservation.php?message=Erreur lors du changement');
        exit;
      }
    }
  }
  header('location: db_reservation.php?message=Changement bien effectuer.');
  exit;
?>
