<?php
  session_start();
  include('includes/db_connexion.php');

  if(isset($_GET["id"]) && !empty($_GET["id"])){
    $s = 'SELECT id_creater,image_0,image_1,image_2,image_3,image_4 FROM annonce WHERE id = ?';
    $req_select = $db->prepare($s);
    $req_select->execute([
      htmlspecialchars($_GET['id'])
    ]);
    $select = $req_select->fetch();

    if($_SESSION['id'] == $select['id_creater']){
      $d = 'DELETE FROM annonce WHERE id = ?';
      $req_delete = $db->prepare($d);
      $delete = $req_delete->execute([
        htmlspecialchars($_GET['id'])
      ]);
      for($i = 0; $i <= 4; $i++){
        if($select['image_'.$i]){
          unlink('uploads/annonces/'.$select['image_'.$i]);
        }
      }
      if($delete){
        header('location: index.php?message=Suppression réussite.');
        exit;
      } else {
        header('location: index.php?message=Erreur lors de la suppression.');
        exit;
      }
    } else {
      header('location: index.php');
      exit;
    }
  } else {
    header('location: index.php');
    exit;
  }

?>
