<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <?php include('includes/head.php') ?>
    <title>A propos</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php
      include('includes/header.php');
    ?>
    <main>
      <style>
      h1{
        font-size: 3em;
      }

      p{
        justify-content: center;
        align-items: center;
        margin-left: auto;
       margin-right: auto;
       width: 20em;
       font-size: 1.5em;
       font-weight: bold;
       text-align: center;
      }

      h3{
        text-align: center;
        margin-top: 5%;
      }

      .container{
        margin-left: 20%;
      }

      </style>
    <h1 style="text-align:center" > À propos de HJQ-MOTORS</h1><hr>
    <p >Nous sommes une équipe de trois étudiants qui ont eu pour objectifs communs de créer leur entreprise dédiée au monde de la moto. Après la fin de nos études, nous avons créé une société spécialisée dans l’achat et la réservation de moto, par la suite nous avons créer cette page web pour le client puisse avoir accès à leur compte et partager leur passion commune avec des évènements directement créer par nos utilisateurs. Depuis notre entreprise à connu une évolution et elle fait partie du top 10 des entreprises consacrées à la moto. Nous avons de nombreux partenaire comme la marque BMW , YAMAHA ou encore KTM . Venez réserver vos motos et équipements , HJQ-MOTORS n'attend que vous .</p>

      <h3> Membres de l'entreprise HJQ-MOTORS </h3><hr>
      <div class="container">
      <div class="row">
      <div class="col-4">
        <figure>
             <img src="img/quentin.png" alt="Le logo Mozilla" width="150">
             <figcaption><span> Quentin Hélion </span></figcaption>
          </figure>
      </div>
      <div class="col-4">
        <figure>
             <img src="img/jonathan.png" alt="Le logo Mozilla" width="150">
             <figcaption><span> Jonathan Mbossa </span></figcaption>
          </figure>
        </div>
        <div class="col-4">
          <figure>
               <img src="img/hicham.png" alt="Le logo Mozilla" width="150">
               <figcaption><span> Hicham Khadda </span></figcaption>
            </figure>
        </div>
        </div>
      </div>
</main>
<?php
  include('includes/footer.php');
?>
  </body>
</html>
