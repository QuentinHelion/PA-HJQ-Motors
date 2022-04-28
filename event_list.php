<!DOCTYPE html>
<html>
  <head>
    <?php include('includes/head.php') ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Evenements</title>
  </head>
  <body id="event">
    <?php include('includes/header.php') ?>
    <main>
      <div class="container">
        <div class="row mb-5">
        <?php
          if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
            echo '
                    <div class="col-12">
                      <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="event_creation.php" role="tab" aria-controls="nav-home" aria-selected="true">Créer un évènement</a>
                        </div>
                      </nav>
                    </div>
                  ';
          };
          ?>
        </div>
          <?php

          include("includes/db_connexion.php");
          include('includes/event_table.php');


          if(isset($_SESSION['id'])){
            $requete = $db->query('SELECT * FROM gouts WHERE id_user = '.$_SESSION["id"]);
            $gout = $requete->fetch();
          }
          if(isset($_SESSION['id']) && (isset($gout["gout1"]) || isset($gout["gout2"]) || isset($gout["gout3"]))){
            if($gout["gout1"] || $gout["gout2"] || $gout["gout3"]){
              for($i = 1; $i <= 3; $i++){
                if($gout["gout".$i]){
                  foreach ($eventSort as $key => $value) {
                    if($eventSort[$key]['type'] == $gout["gout".$i]){
                      $t = 'SELECT * FROM event WHERE id = ?';
                      $requete = $db->prepare($t); //requête test
                      $requete->execute([$eventSort[$key]['id']]);
                      $req = $requete->fetch(); //prend la prmière ligne de la requête

                      $o = 'SELECT firstname,lastname FROM users WHERE id = ?';
                      $req_creater = $db->prepare($o); //requête test
                      $req_creater->execute([$req["id_creater"]]);
                      $creater = $req_creater->fetch(); //prend la prmière ligne de la requête

                      if($test){ //vérifie que la ligne existe bien dans la table
                        $date = date_create($req["date_event"]);
                        echo '<div class="list-group">
                                <a href="event_page.php?id='.$req["id"].'" class="list-group-item list-group-item-action">
                                  <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-2">'.$req["title"].'</h5>
                                    <small>le '.date_format($date,"d/m/Y").'</small>
                                  </div>
                                  <p class="mb-3 col-xs-12 col-lg-10" maxlength="10">
                                      '.$req["description"].'
                                  </p>
                                  <!-- <p style="text-align: right; margin-bottom: 0; width: 200px; right: 0;">Montagne</p> -->
                                  <div style="display:flex; justify-content: space-between; align-items: flex-end">
                                    <small><img src="uploads/photos_profils/default_user.png" style="width: 50px; border: 1.5px solid black;" class="rounded-circle"> '.$creater["firstname"].'  '.$creater["lastname"].'</small>
                                    <!-- <small >Montagne</small> -->
                                    <p style="margin-bottom: 0; ">'.$req["type"].'</p>
                                  </div>
                                </a>
                              </div>
                              <br>';
                      }
                    }
                  }
                }
              }
            }
          }
              //
              // foreach ($eventSort as $key => $value) {
              //     if($eventSort[$key]['type'] != $gout["gout1"] && $eventSort[$key]['type'] != $gout["gout2"] && $eventSort[$key]['type'] != $gout["gout3"]){
              //       $t = 'SELECT * FROM event WHERE id = ?';
              //       $requete = $db->prepare($t); //requête test
              //       $requete->execute([$eventSort[$key]['id']]);
              //       $req = $requete->fetch(); //prend la prmière ligne de la requête
              //
              //       $o = 'SELECT firstname,lastname FROM users WHERE id = ?';
              //       $req_creater = $db->prepare($o); //requête test
              //       $req_creater->execute([$req["id_creater"]]);
              //       $creater = $req_creater->fetch(); //prend la prmière ligne de la requête
              //
              //       if($test && $creater){ //vérifie que la ligne existe bien dans la table
              //         $date = date_create($req["date_event"]);
              //         echo '<div class="list-group">
              //                 <a href="event_page.php?id='.$req["id"].'" class="list-group-item list-group-item-action">
              //                   <div class="d-flex w-100 justify-content-between">
              //                     <h5 class="mb-2">'.$req["title"].'</h5>
              //                     <small>le '.date_format($date,"d/m/Y").'</small>
              //                   </div>
              //                   <p class="mb-3 col-xs-12 col-lg-10" maxlength="10">
              //                       '.$req["description"].'
              //                   </p>
              //                   <!-- <p style="text-align: right; margin-bottom: 0; width: 200px; right: 0;">Montagne</p> -->
              //                   <div style="display:flex; justify-content: space-between; align-items: flex-end">
              //                     <small><img src="uploads/photos_profils/default_user.png" style="width: 50px; border: 1.5px solid black;" class="rounded-circle"> '.$creater["firstname"].'  '.$creater["lastname"].'</small>
              //                     <!-- <small >Montagne</small> -->
              //                     <p style="margin-bottom: 0; ">'.$req["type"].'</p>
              //                   </div>
              //                 </a>
              //               </div>
              //               <br>';
              //       }
              //     }
              //   }

           else {
              $s = 'SELECT event.id, event.title, event.date_event, event.description, event.type, users.pp, users.lastname, users.firstname
                    FROM event, users
                    WHERE event.id_creater = users.id';
              $req_select = $db->query($s);
              $select = $req_select->fetchAll(PDO::FETCH_ASSOC);
              foreach ($select as $req) {
                $date = date_create($req["date_event"]);
                echo '<div class="list-group">
                        <a href="event_page.php?id='.$req["id"].'" class="list-group-item list-group-item-action">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2">'.$req["title"].'</h5>
                            <small>le '.date_format($date,"d/m/Y").'</small>
                          </div>
                          <p class="mb-3 col-xs-12 col-lg-10" maxlength="10">
                              '.$req["description"].'
                          </p>
                          <!-- <p style="text-align: right; margin-bottom: 0; width: 200px; right: 0;">Montagne</p> -->
                          <div style="display:flex; justify-content: space-between; align-items: flex-end">
                            <small><img src="uploads/photos_profils/default_user.png" style="width: 50px; border: 1.5px solid black;" class="rounded-circle"> '.$creater["firstname"].'  '.$creater["lastname"].'</small>
                            <!-- <small >Montagne</small> -->
                            <p style="margin-bottom: 0; ">'.$req["type"].'</p>
                          </div>
                        </a>
                      </div>
                      <br>';
                }
    					}
        ?>

      </div>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>
