<!DOCTYPE html>
<html>
  <head>
    <title>Annonces</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="scripts/annonce_sort.js" charset="utf-8"></script>
    <script src="scripts/catalog.js" charset="utf-8"></script>
    <?php include('includes/head.php') ?>
  </head>
  <body>
    <?php
      include('includes/header.php');
    ?>
    <main>
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab">
                <a class="nav-item nav-link" id="sortPriceBar" onclick="deployBar('child_sortPriceBar',0)">Filtrer par prix</a>
                <a class="nav-item nav-link" id="sortAlphabeticBar" onclick="deployBar('child_sortAlphabeticBar',3)">Filtrer par ordre alphabétique</a>
                <a class="nav-item nav-link" href="annonce_creation.php">Déposer une annonce</a>
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
      <div class="container mt-3">
        <div class="row">
          <?php
            include("includes/db_connexion.php");

            $s = 'SELECT annonce.id, annonce.price, annonce.title,annonce.add_date, annonce.price,annonce.image_0, annonce.image_1,users.firstname,users.lastname
                  FROM annonce,users
                  WHERE users.id = annonce.id_creater';
            $req_select = $db->query($s);
            $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

            foreach ($select as $annonce) {
              $pic2 = $annonce["image_1"] ? '<img class="pic-2" src="uploads/annonces/'.$annonce["image_1"].'">' : '';
              echo '<div class="col-md-3 col-sm-6" id="'.$annonce["title"].'-'.$annonce["price"].'">
                      <div class="product-grid" id="equipement">
                        <div class="product-image">
                          <a href="annonce_page.php?id='.$annonce["id"].'">
                            <img class="pic-1" src="uploads/annonces/'.$annonce["image_0"].'" >
                            '.$pic2.'
                          </a>
                        </div>
                        <div class="product-content">
                          <h3 class="title"><a href="annonce_page.php?id='.$annonce["id"].'">'.$annonce["title"].'</a></h3>
                          <div class="price">'.$annonce["firstname"].' '.$annonce["lastname"].'
                          </div>
                          <a class="add-to-cart" href="annonce_page.php?id='.$annonce["id"].'">'.$annonce['price'].'€</a>
                        </div>
                      </div>
                      <br>
                    </div><br>';
            }

          ?>
        </div>
      </div>
    </main>
  </body>
  <?php include("includes/footer.php"); ?>
</html>
