<!DOCTYPE html>
<html>
  <head>
    <?php include('includes/head.php') ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Mes réservations</title>
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <main class="mb-5">
      <?php
        include('includes/db_connexion.php');
        if(isset($_SESSION['email'])){
          $q = 'SELECT id,email,lastname,firstname,pp,adresse,tel,permis_class,birth_date,permis_img FROM users WHERE email = ?';
          $req = $db->prepare($q);
          $req ->execute([$_SESSION['email']]);
          $user = $req -> fetch();
        }

        if($user["lastname"] && $user["firstname"] && $user["adresse"] && $user["tel"] && $user["permis_class"] && $user["permis_img"] && $user["birth_date"]){
          echo "<style>
                  #warn_profil{
                    display:none
                  }
                </style>";

        } else {
          echo "<style>#warn_profil{display:block;color:orange}</style>";
        }
      ?>


      <div class="container mt-4">
        <div class="d-flex justify-content-center">
          <div class="p-2" id="profil-name" style="display: flex; flex-wrap: wrap; justify-content:center;">
            <figure>
              <img src="uploads/photos_profils/<?= $user['pp']  ?>" style="width: 100px; border: 2px solid black; margin:auto; margin-bottom: 10px;" class="rounded-circle">
              <svg style="position: absolute;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <input type="file">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
              </svg>
            </figure>
            <h2 id="test" style="tetext-align: center;"><?=$user["firstname"] ."  ".$user["lastname"]?></h2>
            <script>
              let long = document.getElementById("test").offsetWidth;
              long +=20;
              let tata = document.getElementById("profil-name");
              let tete = long.toString()+'px';
              tata.style.width = tete;
            </script>
          </div>
        </div>
        <br>
        <!-- NAV TABS -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link"  href="profil.php">Mon profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="profil_modif.php" style="display:flex; ">Modifier mes informations   <i id="warn_profil" style="margin-left:10px;" class="bi bi-exclamation-octagon-fill"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="profil_gout.php">Mes goûts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active"  href="profil_reservation.php">Mes reservations</a>
          </li>
        </ul>
        <div class="tab-content">
          <?php

            $sort = 'reservation';
            include('includes/sort.php');

            $y = 0;
            if($req_max["_max"] && $req_min["_min"]){
              for($i = $req_max["_max"]; $i >= $req_min["_min"]; $i--){
                $s = 'SELECT moto.model, moto.marque,moto.banniere,reservation.date_from, reservation.date_to, reservation.id
                      FROM reservation, moto
                      WHERE reservation.id_user = '.$_SESSION["id"].' AND reservation.id_moto = moto.id AND reservation.id = '.$i;
                $req_select = $db->query($s);
                $select = $req_select->fetch(PDO::FETCH_ASSOC);
                if($select){
                  $y++;
                  echo '<div width="100%" id="reservation" class="d-flex mt-3 border">
                          <img src="uploads/motos/'.$select["banniere"].'">
                          <div id="infoReservation">
                            <div id="title" class="d-flex">
                              <a id="h3" href="moto_page.php?id='.$select['id'].'"><h3 class="text-center">'.$select["marque"].' '.$select["model"].'</h3></a>
                              <a id="delete" href="modif_reservation.php?action=delete&id='.$select["id"].'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                              </a>
                            </div>
                            <form method="post" action="modif_reservation.php?action=modif&id='.$select["id"].'" class="d-flex flex-wrap">
                              <div class="mt-3 col-12">
                                <div class="form-group border-span">
                                  <input class="form-control" type="date" name="date_from" value="'. date_format(date_create($select["date_from"]),("Y-m-d")) .'">
                                  <span>Date de début</span>
                                </div>
                              </div>
                              <div class="mt-2 col-12">
                                <div class="form-group border-span">
                                  <input class="form-control" type="date" name="date_to" value="'. date_format(date_create($select["date_to"]),("Y-m-d")) .'">
                                  <span>Date de fin</span>
                                </div>
                              </div>
                              <input type="submit" id="button" class="btn btn-primary" value="Modifier">
                            </form>
                          </div>
                        </div>';
                }
              }
            }
            if($y == 0){
              echo '<h2 class="text-center mt-4">Aucune réservation enregistrer</h2>
                    <p class="text-center">Le catalogue de moto <a href="moto.php">ici <i class="ml-1 bi bi-box-arrow-up-right"></i></a></p>';
            }
          ?>
        </div>
      </div>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>
