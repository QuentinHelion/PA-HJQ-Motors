<?php
session_start();
?>

<?php
// Connexion à la base de données
include("includes/db_connexion.php");

if( isset($_POST['firstname']) && !empty($_POST['firstname']) ){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE users SET firstname = (:firstname) WHERE id = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'firstname' => htmlspecialchars($_POST['firstname'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}

if( isset($_POST['lastname']) && !empty($_POST['lastname']) ){
  // Si Nom changer, mettre à jours les informations
  $q = 'UPDATE users SET lastname = (:lastname) WHERE id = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'lastname' => htmlspecialchars($_POST['lastname'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}

if( isset($_POST['tel']) && !empty($_POST['tel']) ){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE users SET tel = (:tel) WHERE id = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'tel' => htmlspecialchars($_POST['tel'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}

if( isset($_POST['adresse']) && !empty($_POST['adresse']) ){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE users SET adresse = (:adresse) WHERE id = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'adresse' => htmlspecialchars($_POST['adresse'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}

$req_verif = $db->prepare('SELECT birth_date FROM users WHERE id = '.$_SESSION["id"]);
$req_verif->execute();
$verif = $req_verif->fetch();


if( isset($_POST['birth_date']) && !empty($_POST['birth_date']) && $_POST['birth_date'] != $verif['birth_date']){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE users SET birth_date = (:birth_date) WHERE id = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'birth_date' => htmlspecialchars($_POST['birth_date'])
  ]);


  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}

if( isset($_POST['permis_class']) && !empty($_POST['permis_class']) && $_POST['permis_class'] != "..." ){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE users SET permis_class = (:permis_class) WHERE id = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'permis_class' => htmlspecialchars($_POST['permis_class'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}

//========PHOTOS==========//

// Type de d'image acceptable
$acceptable = [
  'image/jpeg',
  'image/png'
];

// Poids max du fichier
$maxSize = 2 * 1024 * 1024;  //2Mo

// Vérifier si photo de profil ajouter
if(isset($_FILES['pp']) && !empty($_FILES['pp']['name'])){

		if(!in_array($_FILES['pp']['type'], $acceptable)){
			// Rediriger vers inscription.php avec un message d'erreur
			header('location:profil_modif.php?message=Type de fichier incorrect.');
			exit;
		}

		if($_FILES['pp']['size'] > $maxSize){
			// Rediriger vers inscription.php avec un message d'erreur
			header('location:profil_modif.php?message=Ce fichier est trop lourd.');
			exit;
		}


		// Enregistrer le fichier sur le serveur
		// Chemin d'enregistrement
		$path_pp = 'uploads/photos_profils';

		// Vérifier que le dossier uploads existe, sinon le créer
		if(!file_exists($path_pp)){
			mkdir($path_pp, 0777);
		}

		$filename = $_FILES['pp']['name'];

    $s = 'SELECT firstname, lastname,id,pp FROM users WHERE id = ?';
    $req_select = $db->prepare($s);
    $req_select->execute([
      $_SESSION['id']
    ]);
    $select = $req_select->fetch();

    if($select['pp'] != 'default_user.png'){
      unlink($path.'/'.$select['pp']);
    }

		//Récupérer l'extentiondu Fichier
		// $ext
		$exte = explode('.',$filename);
		$ext = end($exte);
		$filename = $select['id'] . '-' . $select['firstname'] .'-' . $select['lastname'] .'.'.$ext;

		// Déplacer le fichier vers son emplacement définitif (le dossier uploads)
		$destination = $path_pp . '/' . $filename;
		move_uploaded_file($_FILES['pp']['tmp_name'], $destination);

    // Si Prénom changer, mettre à jours les informations
    $q = 'UPDATE users SET pp = (:pp) WHERE id = '.$_SESSION["id"];
    $req = $db->prepare($q);
    $reponse = $req->execute([
      'pp' => $filename
    ]);

    if(!$reponse){
    	// Afficher message si erreur
      header('location: profil.php?message=Erreur lors de l\'inscription.');
    	exit;
    }
}


// Vérifier si photo du permis a été ajouter
if(isset($_FILES['permis_img']) && !empty($_FILES['permis_img']['name'])){

		if(!in_array($_FILES['permis_img']['type'], $acceptable)){
			// Rediriger vers inscription.php avec un message d'erreur
			header('location:profil_modif.php?message=Type de fichier incorrect.');
			exit;
		}

		if($_FILES['permis_img']['size'] > $maxSize){
			// Rediriger vers inscription.php avec un message d'erreur
			header('location:profil_modif.php?message=Ce fichier est trop lourd.');
			exit;
		}


		// Enregistrer le fichier sur le serveur
		// Chemin d'enregistrement
		$path_pp = 'uploads/photos_profils';

		// Vérifier que le dossier uploads existe, sinon le créer
		if(!file_exists($path_pp)){
			mkdir($path_pp, 0777);
		}

		$filename = $_FILES['permis_img']['name'];

		// Déplacer le fichier vers son emplacement définitif (le dossier uploads)
		$destination = $path_pp . '/' . $_FILES['permis_img']['name'];
		move_uploaded_file($_FILES['permis_img']['tmp_name'], $destination);

    // Si Prénom changer, mettre à jours les informations
    $q = 'UPDATE users SET permis_img = (:permis_img) WHERE id = '.$_SESSION["id"];
    $req = $db->prepare($q);
    $reponse = $req->execute([
      'permis_img' => $filename
    ]);

    if(!$reponse){
    	// Afficher message si erreur
      header('location: profil.php?message=Erreur lors de l\'inscription.');
    	exit;
    }
}


//========== PARTIE GOUT=========//
$v = 'SELECT id_user FROM gouts WHERE id_user = ?';
$req_verif = $db->prepare($v);
$req_verif->execute([$_SESSION["id"]]);
$verif = $req_verif->fetch();
echo $verif;
if(!$verif){
  $q = 'INSERT INTO gouts(id_user) VALUES (:id_user)';
  $req = $db->prepare($q);
  $req->execute(['id_user' => $_SESSION["id"]]);
}

if( isset($_POST['gout1']) && !empty($_POST['gout1']) && $_POST['gout1'] != "..." ){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE gouts SET gout1 = (:gout1) WHERE id_user = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'gout1' => htmlspecialchars($_POST['gout1'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}


if( isset($_POST['gout2']) && !empty($_POST['gout2']) && $_POST['gout2'] != "..." ){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE gouts SET gout2 = (:gout2) WHERE id_user = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'gout2' => htmlspecialchars($_POST['gout2'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}


if( isset($_POST['gout3']) && !empty($_POST['gout3']) && $_POST['gout3'] != "..." ){
  // Si Prénom changer, mettre à jours les informations
  $q = 'UPDATE gouts SET gout3 = (:gout3) WHERE id_user = '.$_SESSION["id"];
  $req = $db->prepare($q);
  $reponse = $req->execute([
    'gout3' => htmlspecialchars($_POST['gout3'])
  ]);

  if(!$reponse){
  	// Afficher message si erreur
    header('location: profil.php?message=Erreur lors de l\'inscription.');
  	exit;
  }
}


if($reponse){
	// Afficher message de réussite
	header('location: profil.php?message=Modif réussite');
	exit;
}

header('location: profil.php');

?>
