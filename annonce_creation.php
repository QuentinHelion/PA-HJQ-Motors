<!DOCTYPE html>
<html>
  <head>
    <title>Déposer une annonce</title>
    <?php include('includes/head.php') ?>
    <link rel="stylesheet" href="css\style.css">
  </head>
  <body>
    <?php
      if(!isset($_SESSION["id"])){
        // si n'est pas connecter, redirige vers la page event
        header('location: annonce.php?message=Vous devez être connecter pour accéder à ce contenue.');
        exit;
      }
      include('includes/verif_user.php');
    ?>
    <?php include('includes/header.php') ?>
    <main class="mb-5">
      <br>
      <div class="container">
        <h1 class="text-center">Déposer une annonce</h1>
        <form action="verif-add_annonce.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Titre de l'annonce</label>
            <input type="text" class="form-control" name="title" placeholder="ex: Casque Alpinestar Xr32">
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="5"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Prix <i style="color:grey">(en €)</i></label>
            <input type="number" class="form-control" name="price" placeholder="ex: 320">
          </div>

          <div class="mb-3">
            <label class="form-label">Images <i style="color:grey">(minimum 1)</i></label>
            <div class="input-group">
              <input type="file" class="form-control" name="image0" id="imageInputAnnonce">
              <input type="file" class="form-control" name="image1" id="imageInputAnnonce">
              <input type="file" class="form-control" name="image2" id="imageInputAnnonce">
              <input type="file" class="form-control" name="image3" id="imageInputAnnonce">
              <input type="file" class="form-control" name="image4" id="imageInputAnnonce">
            </div>
          </div>
          <div class="mb-3 text-center">
            <button type="submit" id="creation" class="btn btn-primary">Créer</button>
          </div>
        </form>
      </div>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>
