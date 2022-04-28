<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <?php include('includes/head.php') ?>
    <title>Catalogue équipement</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="scripts/equipment-sort.js" charset="utf-8"></script>
    <script src="scripts/catalog.js" charset="utf-8"></script>
  </head>
  <body id="culot">
    <?php include('includes/header.php') ?>
    <main>
      <!-- Barre de filtre -->
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab">
                <a class="nav-item nav-link" id="sortPriceBar" onclick="deployBar('child_sortPriceBar',0)">Filtrer par prix</a>
                <a class="nav-item nav-link" id="sortTypeBar" onclick="deployBar('child_sortTypeBar',1)">Filtrer par type</a>
                <a class="nav-item nav-link" id="sortAlphabeticBar" onclick="deployBar('child_sortAlphabeticBar',3)">Filtrer par ordre alphabétique</a>
                <input class="nav-item nav-link" type="text" id="sortSearch" placeholder="Rechercher">
                <a class="nav-item nav-link" onclick="sortSearchBar()"> Rechercher </a>
              </div>
              <div id="child_sortPriceBar" style="display:none">
                <div class="nav nav-tabs nav-fill">
                  <a class="nav-item nav-link" onclick="sortPriceAscend()">Prix croissant</a>
                  <a class="nav-item nav-link" onclick="sortPriceDescend()">Prix décroissant</a>
                </div>
                <div class="nav nav-tabs nav-fill">
                    <input class="nav-item nav-link" type="number" id="sortMin" placeholder="Prix minimum">
                    <input class="nav-item nav-link" type="number" id="sortMax" placeholder="Prix maximum">
                    <a class="nav-item nav-link" onclick="sortPriceBetween()"> Valider </a>
                </div>
              </div>
              <div id="child_sortTypeBar" style="display:none">
                <div class="nav nav-tabs nav-fill">
                  <a class="nav-item nav-link" onclick="sortType('casque')">Casques</a>
                  <a class="nav-item nav-link" onclick="sortType('veste')">Vestes</a>
                  <a class="nav-item nav-link" onclick="sortType('gants')">Gants</a>
                  <a class="nav-item nav-link" onclick="sortType('pantalon')">Pantalons</a>
                  <a class="nav-item nav-link" onclick="sortType('bottes')">Bottes</a>
                </div>
              </div>
              <div id="child_sortAlphabeticBar" style="display:none">
                <div class="nav nav-tabs nav-fill">
                  <a class="nav-item nav-link" onclick="sortAlphabetic()">A-Z</a>
                  <a class="nav-item nav-link" onclick="sortUnalphabetic()">Z-A</a>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
      <br>
      <div class="container">
        <div class="row">
          <?php
            include("includes/db_connexion.php");
            $s = 'SELECT * FROM equipement';
            $req_select = $db->query($s);
            $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

            foreach ($select as $req) {
              echo '<div class="col-md-3 col-sm-6" id="'.$req["type"].'-'.$req["marque"].'-'.$req["model"].'-'.$req["prix"].'">
                      <div class="product-grid" id="equipement">
                        <div class="product-image">
                          <a href="equipement_page.php?id='.$req["id"].'">
                            <img class="pic-1" src="uploads/equipements/'.$req["image1"].'" >
                            <img class="pic-2" src="uploads/equipements/'.$req["image2"].'" >
                          </a>
                        </div>
                        <div class="product-content">
                          <h3 class="title"><a href="equipement_page.php?id='.$req["id"].'">'.$req["marque"].'   '.$req["model"].' </a></h3>
                          <div class="price">'.$req["prix"].'€
                          </div>
                          <a class="add-to-cart" href="verif-add_panier.php?equip='.$req["id"].'&quantity=1">Ajoutez au panier</a>
                        </div>
                      </div>
                      <br>
                    </div><br>';
            }
          ?>
        </div>
      </div>
    </main>
    <?php include("includes/footer.php"); ?>
  </body>
</html>
