<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <head>
      <?php include('includes/head.php') ?>
      <link rel="stylesheet" href="css\style.css">
      <title>Inscription</title>
    </head>
    <body id="inscription">
      <div class="container" id="fondI">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div>
              <h1 id="FOND">CONNEXION</h1>
              <p>
                email :
              </p>
              <form action="verif-connexion.php" method="post" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="email" name="email"  id="email"  placeholder="esgi@myges.fr" aria-label="Connexion" value="<?= isset($_COOKIE["email"]) && !empty($_COOKIE["email"]) ? $_COOKIE["email"] : "" ?>">
                <p>
                  Mot de passe :
                </p>
                <input class="form-control mr-sm-2" type="password" name="password" placeholder="**********" aria-label="Connexion">
                <br>
                <label class="checkbox">
                       <input type="checkbox" name="remember" value="checking"> Se souvenir de moi
                       <br>
                         <a href="mot_de_passe_oublier.php"> Mot de passe oublier ?</a>
                </label>
                <br><br>
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">CONNEXION</button>
              </form>
              <br>
            </div>
          </div>






          <div class="col-md-6 col-sm-6 col-xs-12">
            <h1>INSCRIPTION</h1>
            <p>
              email :
            </p>
            <form action="verif-inscription.php" method="post" enctype="multipart/form-data" class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" name="email" type="email" id="email"   placeholder="esgi@gmail.fr">
              <p>
                Mot de passe :
              </p>
              <input class="form-control mr-sm-2"  name="password" type="password" placeholder="**********">
              <p>
                Adresse:
              </p>
              <input class="form-control mr-sm-2" name="adresse" type="text" placeholder="242 Rue du Faubourg Saint-Antoine" >
              <p>
                numéro de téléphone :
              </p>
              <input class="form-control mr-sm-2" name="tel"  type="tel"  id="phone" placeholder="01 56 06 90 41" >
              <p>
                Permis de conduire:
              </p>
              <input class="form-control mr-sm-2"  name="permis_img" type="file"  accept="image/jpeg, image/png" aria-label="Connexion" >
              <br>
              <input class="form-control mr-sm-2" type="text"  name="permis_class" aria-label="Connexion" placeholder="Classe du permis">
              <br>
              <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">INSCRIPTION</button>
            </form>
            <br>
          </div>
        </div>
      </div>




    </body>
  </html>
