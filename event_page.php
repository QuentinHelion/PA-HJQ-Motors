<?php
  include("includes/db_connexion.php");
  if(!isset($_GET["id"]) || empty($_GET["id"])){
    header("location:event_list.php");
    exit;
  }
  $q = 'SELECT * FROM event WHERE id = ?';
  $req = $db->prepare($q);
  $req->execute([$_GET["id"]]);
  $event = $req->fetch();

  echo '<script>let imgArray = [];</script>';
  for($i = 0; $i <= 4; $i++){
    if($event["image_".$i]){
      echo '<script>imgArray.push("'.$event["image_".$i].'")</script>';
    }
  }

  $date = date_create($event["date_event"]);


  // ajoute 1 vue a l'event
  $u = 'UPDATE event SET nb_view = nb_view + 1 WHERE id = ?';
  $req_add = $db->prepare($u);
  $req_add->execute([$event["id"]]);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <?php include('includes/head.php') ?>
    <title><?=$event["title"]?></title>
    <link rel="stylesheet" href="css\style.css">
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <main>
      <?php
        $q = 'SELECT firstname,lastname,pp FROM users WHERE id = ?';
        $req_user = $db->prepare($q);
        $req_user->execute([$event["id_creater"]]);
        $user = $req_user->fetch();


        $s = 'SELECT admin FROM users WHERE id = ?';
        $req_admin = $db->prepare($s);
        $req_admin->execute([$_SESSION['id']]);
        $admin = $req_admin->fetch();

        $req_verif = $db->prepare('SELECT * FROM participe WHERE id_user = ? AND id_event = ?');
        $req_verif->execute([$_SESSION["id"],$_GET['id']]);
        $verif = $req_verif->fetch();
      ?>
      <div class="container mt-4">
        <h1 class="text-center"><?=$event["title"]?></h1>
        <div style="display: flex;justify-content: center;">
          <img src="uploads/photos_profils/<?= $user['pp']  ?>" style="width: 35px; border: 1.5px solid black; margin-bottom: 10px;" class="rounded-circle">
          <h6 style="text-align: center;margin-top: 7px;margin-left: 5px;"><?=$user["firstname"] ."  ".$user["lastname"]?></h6>
        </div>

        <div class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="uploads/event/<?=$event['image_0']?>" id="image-carousel" class="d-block w-100">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" onclick="prev()">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next" type="button" onclick="next()">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </button>
        </div>


        <div class="d-flex mb-3 mt-3 justify-content-evenly">
          <p><?=$event["type"]?></p>
          <p><?=date_format($date,"d/m/Y")?></p>
        </div>

        <div class="text-center mb-3">
          <p><?=$event["description"]?>
        </div>

        <div class="text-center mb-5">
          <?php
            if(isset($_SESSION["id"])){
              if($event["id_creater"] == $_SESSION["id"] || $admin["admin"] == 1){
                echo "<a href='event_gestion.php?id=".$event["id"]."'><button class='btn btn-primary'>Gérer l'event</button></a>";
              } else {
                if($verif){
                  echo "<a href='event_participe.php?id=".$event["id"]."&action=annule'><button class='btn btn-primary'>Annuler la participation</button></a>";
                } else {
                  echo "<a href='event_participe.php?id=".$event["id"]."&action=participe'><button class='btn btn-primary'>Participer</button></a>";
                }
              }
            } else {
              echo "<h5>Vous devez être connecté pour participer</h5>
                    <a href='inscription.php'>
                      <button class='btn btn-primary'>Connexion/Inscription</button>
                    </a>";
            }

          ?>
        </div>
      </div>
      <div class="parallax" style="background-image: url('uploads/event/<?=$event['type']?>.png')"></div>

        <script>
          const img = document.getElementById("image-carousel");
          let i = 0;
          function prev(){
            i--;
            if(i<0){
              i = imgArray.length-1;
            }
            let y;
            img.src = 'uploads/event/'+imgArray[i];
          }
          function next(){
            i++;
            if(i >= imgArray.length){
              i = 0;
            }
            img.src = 'uploads/event/'+imgArray[i];
          }

          setInterval(next,10000);
        </script>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>
