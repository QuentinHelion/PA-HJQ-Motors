<!DOCTYPE html>
<html>
  <head>
    <?php include('includes/head.php') ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Créer un évènement</title>
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <main>
      <div class="container mt-4">
        <?php
          include('includes/verif_user.php');
          if(!isset($_SESSION["email"])){
            // si n'est pas connecter, redirige vers la page event
            header('location: event_list.php?message=Vous devez être connecter pour accéder à ce contenue.');
            exit;
          }
        ?>
        <h1 class="text-center">Créer un évènement</h1>
        <form action="verif-add_event.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Titre de l'évènement</label>
            <input type="text" class="form-control" name="title" placeholder="ex: Balade dans les Alpes">
          </div>
          <div class="mb-3">
            <label class="form-label">Type d'évènement</label>
            <select class="form-select" name="type">
              <option selected>...</option>
              <option value="Rencontre">Rencontre</option>
              <option value="Montagne">Montagne</option>
              <option value="Plat">Plat</option>
              <option value="Foret">Fôret</option>
              <option value="Circuit">Circuit</option>
              <option value="Course">Course</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Date de l'évènement</label>
            <input class="form-control" type="date" name="date_event">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="5"></textarea>
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
          <div class="mb-5 text-center">
            <button type="submit" id="creation" class="btn btn-primary">Créer</button>
          </div>
        </form>
      </div>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>
