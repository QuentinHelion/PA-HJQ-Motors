<?php
  include("includes/db_connexion.php");

  if(!isset($_GET["id"]) || empty($_GET["id"])){
    header("location:annonce.php");
    exit;
  }
  $s = 'SELECT * FROM annonce WHERE id = ?';
  $req_select = $db->prepare($s);
  $req_select->execute([
    $_GET["id"]
  ]);
  $select = $req_select->fetch();

  echo '<script>let imgArray = [];</script>';
  for($i = 0; $i <= 4; $i++){
    if($select["image_".$i]){
      echo '<script>imgArray.push("'.$select["image_".$i].'")</script>';
    }
  }

  $q = 'SELECT firstname,lastname,pp,admin FROM users WHERE id = ?';
  $req_user = $db->prepare($q);
  $req_user->execute([$select["id_creater"]]);
  $user = $req_user->fetch();




  $date = date_create($select["add_date"]);


  // ajoute 1 vue a l'event
  $u = 'UPDATE annonce SET nb_view = nb_view + 1 WHERE id = ?';
  $req_add = $db->prepare($u);
  $req_add->execute([
    $select["id"]
  ]);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <?php include('includes/head.php') ?>
    <title><?=$select["title"]?></title>
    <link rel="stylesheet" href="css\style.css">
  </head>
  <body>
    <?php include('includes/header.php'); ?>
    <main class="mt-3">
      <div class="container">
        <h1 class="text-center"><?=$select["title"]?></h1>
        <div style="display: flex;justify-content: center;">
          <img src="uploads/photos_profils/<?= $user['pp']  ?>" style="width: 35px; border: 1.5px solid black; margin-bottom: 10px;" class="rounded-circle">
          <h6 style="text-align: center;margin-top: 7px;margin-left: 5px;"><?=$user["firstname"] ."  ".$user["lastname"]?></h6>
        </div>

        <div class="carousel slide mt-4">
          <div class="carousel-inner" id="annonce">
            <div class="carousel-item active">
              <img src="uploads/annonces/<?=$select['image_0']?>" id="image-carousel" class="d-block border">
            </div>
          </div>
          <p class="lead text-center"><?=$select['description']?></p>
        </div>
      </div>

      <div class="d-flex mb-3 mt-3 justify-content-evenly">
        <p><?=$select["price"]?>€</p>
        <p>Publié le <?=date_format($date,"d/m/Y")?></p>
      </div>

      <div class="text-center mb-5">
        <?php
          if(isset($_SESSION["id"])){
            if($select["id_creater"] == $_SESSION["id"] || $user["admin"] == 1){
              echo "<a href='annonce_gestion.php?id=".$select["id"]."'><button class='btn btn-primary'>Gérer l'annonce <i class='bi bi-gear'></i></button></a>";
            } else {
              echo "<a href='EnvoiPV.php'><button class='btn btn-primary'>Contacter le vendeur <i class='bi bi-chat-left-text'></i></button></a>";
            }
          }
        ?>
      </div>
    </div>
        <script>
          const img = document.getElementById("image-carousel");
          let i = 0;
          function prev(){
            i--;
            if(i<0){
              i = imgArray.length-1;
            }
            let y;
            img.src = 'uploads/annonces/'+imgArray[i];
          }
          function next(){
            i++;
            if(i >= imgArray.length){
              i = 0;
            }
            img.src = 'uploads/annonces/'+imgArray[i];
          }

          setInterval(next,10000);
        </script>
    </main>
  </body>
  <?php include('includes/footer.php') ?>
</html>
