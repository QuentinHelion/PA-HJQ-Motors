<?php
  session_start();

  if(!isset($_SESSION["id"]) || empty($_SESSION["id"])){
    header("location: index.php");
    exit;
  }

  if(!isset($_GET["action"]) || empty($_GET["action"]) || !isset($_GET["id"]) || empty($_GET["id"])){
    header("location: profil_reservation.php");
    exit;
  }

  include('includes/db_connexion.php');

  $s = 'SELECT id_user FROM reservation WHERE id = ?';
  $req_select = $db->prepare($s);
  $req_select->execute([
    htmlspecialchars($_GET["id"])
  ]);
  $select = $req_select->fetch();

  if($_SESSION["id"] != $select["id_user"]){
    header("location: profil_reservation.php");
    exit;
  }

  if($_GET["action"] == "modif"){
    $s = 'SELECT date_from, date_to FROM reservation WHERE id = ?';
    $req_select = $db->prepare($s);
    $req_select->execute([
      htmlspecialchars($_GET["id"])
    ]);
    $select = $req_select->fetch();

    if($select){
      if(isset($_POST['date_from']) && !empty($_POST['date_from']) && $select['date_from'] != $_POST['date_from']){
        $u = 'UPDATE reservation SET date_from = :date_from WHERE id = :id';
        $req_update = $db->prepare($u);
        $update = $req_update->execute([
          'date_from' => $_POST['date_from'],
          'id' => htmlspecialchars($_GET["id"])
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
          'id' => htmlspecialchars($_GET["id"])
        ]);

        if(!$update){
          // Afficher message si erreur
          header('location: profil_reservation.php?message=Erreur lors du changement');
          exit;
        }
      }
    }
    header('location: profil_reservation.php?message=Changement bien effectuer.');
    exit;

  } else if($_GET["action"] == "delete") {
    $d = "DELETE FROM reservation WHERE id = ?";
    $req_delete = $db->prepare($d);
    $delete = $req_delete->execute([
      htmlspecialchars($_GET["id"])
    ]);
    if($delete){
      header('location: profil_reservation.php');
      exit;
    } else {
      header('location: profil_reservation.php?message=Erreur');
      exit;
    }
  }






?>
