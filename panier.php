<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <?php include('includes/head.php') ?>
    <title>Panier</title>
    <script src="scripts/panier.js"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <main>
      <div class="container d-flex justify-content-evenly">
        <div class="mt-4 col-md-7 col-lg-5" id="module">
          <h1 class="text-center">Module de paiement</h1>
        </div>
        <div class="mt-4 col-md-7 col-lg-5" id="module">
          <h1 class="text-center">Panier</h1>


          <?php
            if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
              header('location: index.php');
              exit;
            }

            include('includes/db_connexion.php');

            $sort = "equipement";
            include('includes/sort.php');

            if($req_min['_min'] != NULL && $req_max['_max'] != NULL){
              $total = 0;
      				for ($i = $req_min['_min']; $i <= $req_max['_max']; $i++) {
      					$req_test = $db->query('SELECT * FROM panier WHERE id_equip ='.$i); //requête test
      					$test = $req_test->fetch(); //prend la prmière ligne de la requête
      					if($test){ //vérifie que la ligne existe bien dans la table
                  if($test["id_user"] == $_SESSION["id"]){
                    $req_equip = $db->query('SELECT * FROM equipement WHERE id ='.$i); //requête test
          					$equip = $req_equip->fetch(); //prend la prmière ligne de la requête
                    echo '<div class="col-11 mx-auto  mb-1">
                            <div class="d-flex border rounded-3 " id="prod">
                              <img class="rounded-2" id="img-prod" src="uploads/equipements/'.$equip["image1"].'">
                              <div class="col-8 d-flex p-2">
                                <a id="link" class="align-self-center ml-1" href="equipement_page.php?id='.$equip['id'].'"><h4>'.$equip["marque"].' '.$equip["model"].'</h4></a>
                                <div class="col-12 d-flex justify-content-end">
                                  <h1 id="prix" class="d-flex justify-content-end">'.$equip['prix'].'€</h1>

                                  <div class="d-flex align-content-between flex-wrap">
                                    <div id="deleteProd">
                                      <a id="link" href="modif_panier.php?id='.$equip["id"].'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                      </a>
                                    </div>
                                    <form id="panier" action="modif_panier.php?id='.$equip["id"].'" method="post" class="d-flex align-self-end">
                                      <input id="quantity" name="quantity" type="text" class="form-control" value='.$test["quantity"].'>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>';
                      $total += $equip["prix"]*$test["quantity"];
                  }
                }
              }
            }
          ?>
          <h4 class="text-center mt-4">total: <?=$total ?>€</h4>
        </div>
      </div>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>
