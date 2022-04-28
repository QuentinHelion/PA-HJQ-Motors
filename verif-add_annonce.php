<?php
session_start();

//condition incomplete
if( !isset($_POST['title']) || empty($_POST['title']) || !isset($_POST['description']) || empty($_POST['description']) || !isset($_POST['price']) || empty($_POST['price'])){
	// Rediriger vers inscription.php avec un message d'erreur
	header('location: annonce_creation.php?message=Vous devez remplir tous les champs.');
	exit;
}

// Ajout des images
// Bon type de fichier
$acceptable = [
  'image/jpeg',
  'image/png'
];
// Taille max du fichier
$maxSize = 2 * 1024 * 1024;  //2Mo

// Chemin d'enregistrement
$path = 'uploads/annonces';

// Vérifier que le dossier uploads existe, sinon le créer
if(!file_exists($path)){
  mkdir($path, 0777);
}

// Vérifier si fichier envoyé
$y = 0;
for($i = 0; $i < 6; $i++){
  if(isset($_FILES['image'.$i]) && !empty($_FILES['image'.$i]['name'])){
			$y++;
  		if(!in_array($_FILES['image'.$i]['type'], $acceptable)){
  			// Rediriger vers inscription.php avec un message d'erreur
  			header('location: annonce_creation.php?message=Type de fichier incorrect.');
  			exit;
  		}

  		if($_FILES['image'.$i]['size'] > $maxSize){
  			// Rediriger vers inscription.php avec un message d'erreur
  			header('location: annonce_creation.php?message=Ce fichier est trop lourd.');
  			exit;
  		}

  		$filename[$i] = $_FILES['image'.$i]['name'];

      //Récupérer l'extentiondu Fichier
  		// $ext
  		$exte = explode('.',$filename[$i]);
  		$ext = end($exte);
  		$filename[$i] = $_SESSION['id'] .'-'.htmlspecialchars($_POST['title']). '-'.$i.'.'.$ext;

  		// Déplacer le fichier vers son emplacement définitif (le dossier uploads)
  		$destination = $path . '/' . $filename[$i];
  		move_uploaded_file($_FILES['image'.$i]['tmp_name'], $destination);

  } else {
    $filename[$i] = NULL;
  }
}
if($y == 0){
	header('location: annonce_creation.php?message=Vous devez ajouter au moins 1 image');
	exit;
}



// Connexion à la base de données
include("includes/db_connexion.php");

// Insérer un nouvel event
$i = 'INSERT INTO annonce (title, id_creater,description,price,image_0,image_1,image_2,image_3,image_4) VALUES (:title, :id_creater,:description,:price,:image_0,:image_1,:image_2,:image_3,:image_4)';
$req_insert = $db->prepare($i);
$insert = $req_insert->execute([
	'title' => htmlspecialchars($_POST['title']),
	'id_creater' => $_SESSION['id'],
  'description' => htmlspecialchars($_POST['description']),
  'price' => htmlspecialchars($_POST['price']),
	'image_0' => $filename[0],
  'image_1' => $filename[1],
  'image_2' => $filename[2],
  'image_3' => $filename[3],
  'image_4' => $filename[4]
]);


if($insert){
	// Afficher message de réussite
	header('location: annonce.php?message=Annonce déposer avec succès.');
	exit;
}else{
	// Rediriger vers inscription.php avec un message d'erreur
	header('location: annonce_creation.php?message=Echec lors du dépot de l\'annonce');
	exit;
}

?>
