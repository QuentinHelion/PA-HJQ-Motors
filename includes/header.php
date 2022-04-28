<style>
  /*============HEADER============*/
  header{
    margin-left: 6%;
    margin-right: 6.3%;
  }
  div#header.carousel-item.active{
  	height: 35vh !important;
  	overflow: hidden !important;
  }
  img#image-carousel-header{
    overflow: hidden !important;
  	transition: all 1s !important;
  }
</style>

<header>
  <div class="container-fluid">
    <div class="row">
      <div class="image">
        <!-- ========CAROUSSEL======= -->
        <div class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active" id="header">
              <img src="images/photo5.jpg" id="image-carousel-header" class="d-block col-12">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" onclick="prev()">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next" type="button" onclick="next()">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </button>
          <script src="scripts/imagedefile-header.js"></script>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="index.php" role="tab" aria-controls="nav-home" aria-selected="true">Accueil</a>
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="moto.php" role="tab" aria-controls="nav-home" aria-selected="true">Motos</a>
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="equip.php" role="tab" aria-controls="nav-home" aria-selected="true">Equipements</a>
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="event_list.php" role="tab" aria-controls="nav-home" aria-selected="true">Evenements</a>
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="annonce.php" role="tab" aria-controls="nav-home" aria-selected="true">Annonces</a>

            <?php
              if(isset($_SESSION['id'])){
                echo '
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="chat.php" role="tab" aria-controls="nav-profile" aria-selected="false">Tchat public</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="EnvoiPV.php" role="tab" aria-controls="nav-profile" aria-selected="false">Messages privés</a>
                  <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="panier.php" role="tab" aria-controls="nav-about" aria-selected="false">Panier</a>
                  <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="profil.php" role="tab" aria-controls="nav-about" aria-selected="false">Profil</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="deconnexion.php" role="tab" aria-controls="nav-contact" aria-selected="false">Déconnexion</a>
                ';

                include("includes/db_connexion.php");
                // verifi utilisateur connecter est admin pour donner accès au backoffice
                $q = 'SELECT admin FROM users WHERE email = :email';
                $req = $db->prepare($q);
                $req->execute([
                  'email' => $_SESSION['email']
                ]);
                $reponse = $req ->fetch();
                if($reponse["admin"]){ // si oui donne accès au back office
                  echo '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" role="tab" aria-controls="nav-profile" aria-selected="false" href="backoffice/backoffice-index.php">Backoffice</a>';
                }
              } else {
                echo '
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="inscription.php" role="tab" aria-controls="nav-contact" aria-selected="false">Connectez-vous</a>
                ';
              }
             ?>
         </div>
       </nav>
      </div>
    </div>
  </div>
</header>
