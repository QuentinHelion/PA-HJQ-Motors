<?php
  session_start();

  if(!isset($_SESSION["id"]) || empty($_SESSION["id"])){
    header("location: index.php");
    exit;
  }

  if(!isset($_GET["id"]) || empty($_GET["id"])){
    header("location: annonce.php");
    exit;
  }

  include('includes/db_connexion.php');

  $s = 'SELECT id_creater FROM annonce WHERE id = ?';
  $req_select = $db->prepare($s);
  $req_select->execute([
    htmlspecialchars($_GET["id"])
  ]);
  $select = $req_select->fetch();

  if($_SESSION["id"] != $select["id_creater"]){
    header("location: annonce.php");
    exit;
  }

  $s = 'SELECT description, title, image_0, image_1, image_2, image_3, image_4, price FROM annonce WHERE id = ?';
  $req_select = $db->prepare($s);
  $req_select->execute([
    htmlspecialchars($_GET["id"])
  ]);
  $select = $req_select->fetch();

  if($select){
    if(isset($_POST['title']) && !empty($_POST['title']) && $select['title'] != $_POST['title']){
      $u = 'UPDATE annonce SET title = :title WHERE id = :id';
      $req_update = $db->prepare($u);
      $update = $req_update->execute([
        'title' => htmlspecialchars($_POST['title']),
        'id' => htmlspecialchars($_GET["id"])
      ]);

      if(!$update){
        // Afficher message si erreur
        header('location: annonce_gestion.php?id='.htmlspecialchars($_GET["id"]).'&message=Erreur lors du changement');
        exit;
      }
    }

    if(isset($_POST['description']) && !empty($_POST['description']) && $select['description'] != $_POST['description']){
      $u = 'UPDATE annonce SET description = :description WHERE id = :id';
      $req_update = $db->prepare($u);
      $update = $req_update->execute([
        'description' => htmlspecialchars($_POST['description']),
        'id' => htmlspecialchars($_GET["id"])
      ]);

      if(!$update){
        // Afficher message si erreur
        header('location: annonce_gestion.php?id='.htmlspecialchars($_GET["id"]).'&message=Erreur lors du changement');
        exit;
      }
    }

    if(isset($_POST['price']) && !empty($_POST['price']) && $select['price'] != $_POST['price']){
      $u = 'UPDATE annonce SET price = :price WHERE id = :id';
      $req_update = $db->prepare($u);
      $update = $req_update->execute([
        'price' => htmlspecialchars($_POST['price']),
        'id' => htmlspecialchars($_GET["id"])
      ]);

        if(!$update){
          // Afficher message si erreur
          header('location: annonce_gestion.php?id='.htmlspecialchars($_GET["id"]).'&message=Erreur lors du changement');
          exit;
        }
      }

    //========PHOTOS==========//

    // Type de d'image acceptable
    $acceptable = [
      'image/jpeg',
      'image/png'
    ];

    $path = 'uploads/annonces';
    // Vérifier que le dossier uploads existe, sinon le créer
    if(!file_exists($path)){
      mkdir($path, 0777);
    }

    // Poids max du fichier
    $maxSize = 2 * 1024 * 1024;  //2Mo

    // Vérifier si fichier envoyé
    for($i = 0; $i < 5; $i++){
      if(isset($_FILES['image'.$i]) && !empty($_FILES['image'.$i]['name'])){
      		if(!in_array($_FILES['image'.$i]['type'], $acceptable)){
      			// Rediriger vers inscription.php avec un message d'erreur
      			header('location: event_gestion.php?id='.$_GET["id"].'?message=Erreur lors de la modification.');
      			exit;
      		}

      		if($_FILES['image'.$i]['size'] > $maxSize){
      			// Rediriger vers inscription.php avec un message d'erreur
      			header('location: event_gestion.php?id='.$_GET["id"].'?message=Erreur lors de la modification.');
      			exit;
      		}

          if(isset($select["image_".$i])){
            unlink($path.'/'.$select["image_".$i]);
          }

      		$filename = $_FILES['image'.$i]['name'];

          //Récupérer l'extentiondu Fichier
      		// $ext
          $title = str_replace(' ','',$_POST['title']);
      		$exte = explode('.',$filename);
      		$ext = end($exte);
      		$filename = $_SESSION['id'] .'-'.$select['title']. '-'.$i.'.'.$ext;;

      		// Déplacer le fichier vers son emplacement définitif (le dossier uploads)
      		$destination = $path . '/' . $filename;
      		move_uploaded_file($_FILES['image'.$i]['tmp_name'], $destination);

          $imgNum = "image_".$i;

          $q = 'UPDATE annonce SET '.$imgNum.' = :imgName WHERE id = '.htmlspecialchars($_GET["id"]);
          $req = $db->prepare($q);
          $reponse = $req->execute([
            'imgName' => $filename
          ]);

          if(!$reponse){
          	// Afficher message si erreur
            header('location: profil.php?message=Erreur lors de l\'inscription.');
          	exit;
          }
        }
    }
    header('location: annonce_gestion.php?id='.htmlspecialchars($_GET["id"]).'&message=Changement effectuer.');
    exit;
  }
?>
