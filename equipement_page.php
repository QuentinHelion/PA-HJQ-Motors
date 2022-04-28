<!DOCTYPE html>
<html>
  <head>
    <?php include('includes/head.php') ?>
    <title>Page d'équipement</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <main>
      <?php
        if(!isset($_GET['id']) || empty($_GET['id'])){
          header('location: equip.php');
          exit;
        }

        include("includes/db_connexion.php");
        $q = 'SELECT * FROM equipement WHERE id = ?';
        $req = $db->prepare($q);
        $req->execute([$_GET["id"]]);
        $equip = $req->fetch();
      ?>

      <div class="container pt-4" id="equipPage">
        <h1 id="equipPage" class="text-center text-uppercase"><?=$equip["marque"].' '.$equip["model"]?></h1>

        <div class="row">
          <div>
            <img style="float:left;width:35%;" src="uploads/equipements/<?=$equip['image1']?>">
            <p id="equipPage" class="text-center lead"><?=$equip['description']?></p>
          </div>
        </div>

        <div id="buy" class="text-center">
          <h4><?=$equip['prix']?>€</h4>
          <button class="btn btn-primary">Ajouter au panier <i class="bi bi-cart2"></i></button>
        </div>

        <div id="list-same">
          <hr id="equip">
          <h3 class="text-center">De la même marque</h3>
          <br>
          <div id="list-same-product" class="container horizontal-scrollable">
            <?php

              $sort = 'equipement';
              include("includes/sort.php");

              $v = 'SELECT COUNT(*) FROM equipement WHERE marque = (:marque) AND model != (:model) ';
              $req_verif = $db->prepare($v);
              $req_verif->execute([
                'marque' => $equip["marque"],
                'model' => $equip["model"]
              ]);
              $verif = $req_verif->fetch();

              $x = $verif[0] < 10 ? $verif[0] : 10;


              if(isset($req_min['_min'])){
                $i = $req_min['_min'];
                for ($y = 0; $y < $x; $i++) {
                  $r = 'SELECT * FROM equipement WHERE id = (:id) AND marque = (:marque) AND model != (:model)';
                  $requete= $db->prepare($r); //requête test
                  $requete->execute([
                    "id" => $i,
                    "marque" => $equip["marque"],
                    'model' => $equip["model"]
                  ]);
                  $req = $requete->fetch(); //prend la prmière ligne de la requête
                  if($req){ //vérifie que la ligne existe bien dans la table
                    $y++;
                    // Duplique x* fois la template pour de produit avec les infos de la bdd (* x étant le nombre d'éléments dans la base de données)
                    echo '<div class="col-md-2 col-sm-4 col-sx-6">
                            <div class="product-grid" id="equipement">
                              <div class="product-image">
                                <a href="equipement_page.php?id='.$req["id"].'">
                                  <img class="pic-1" src="uploads/equipements/'.$req["image1"].'">
                                  <img class="pic-2" src="uploads/equipements/'.$req["image2"].'">
                                </a>
                              </div>
                              <div class="product-content">
                                <h3 class="title"><a href="equipment_page.php?id='.$req["id"].'">'.$req["marque"].'  '.$req["model"].'</a></h3>
                                <div class="price">
                                    '.$req["prix"].'€
                                </div>
                                <a class="add-to-cart">Ajoutez au panier</a>
                              </div>
                            </div>
                          </div>';
                  }
                }
              }
            ?>
          </div>
        </div>
      </div>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>
