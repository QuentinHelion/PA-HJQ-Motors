<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Gestion de l'annonce</title>
    <?php include('includes/head.php') ?>
    <link rel="stylesheet" href="css\style.css">
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <main>
      <?php
        if(!isset($_SESSION["id"]) || empty($_GET['id'])){
          header("location: annonce.php");
          exit;
        }

        include("includes/db_connexion.php");

        $s = 'SELECT admin FROM users WHERE id = ?';
        $req_select = $db->prepare($s);
        $req_select->execute([
          $_SESSION['id']
        ]);
        $admin = $req_select->fetch();
        $admin = $admin["admin"];

        $s = 'SELECT annonce.id, annonce.id_creater, annonce.price, annonce.title,annonce.add_date, annonce.description,annonce.price, annonce.nb_view,users.firstname,users.lastname
              FROM annonce, users
              WHERE users.id = annonce.id_creater AND annonce.id = '.htmlspecialchars($_GET['id']);
        $req_select = $db->query($s);
        $select = $req_select->fetch(PDO::FETCH_ASSOC);

        if($_SESSION['id'] != $select['id_creater'] && $admin == 0){
          header('location: annonce.php');
          exit;
        }

      ?>

      <div class="container mt-4">
        <div id="stats" class="text-center mt-3">
          <h5>Vues: <?=$select['nb_view']?></h5>
        </div>

        <div id="modificationInfo" class="mt-5">
          <form action="modif_annonce.php?id=<?=$select["id"]?>" method="post"  enctype="multipart/form-data">
            <input type="text" class="form-control" name="title" value="<?=$select["title"]?>">

            <div class="mb-3">
              <label class="form-label">Images <i style="color:grey">(1 minimum)</i></label>
              <div class="input-group">
                <input type="file" class="form-control" name="image0" id="image">
                <input type="file" class="form-control" name="image1" id="image">
                <input type="file" class="form-control" name="image2" id="image">
                <input type="file" class="form-control" name="image3" id="image">
                <input type="file" class="form-control" name="image4" id="image">
              </div>
            </div>


            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" rows="5"><?=$select["description"]?></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Prix</label>
              <input type="text" class="form-control" name="price" value="<?=$select["price"]?>">
            </div>

            <input type="submit" class="btn btn-primary form-control mb-3" value="Modifier">
          </form>
          <?php
            if($_SESSION['id'] == $select['id_creater']){
              echo '<a class="text-center mt-4" href="annonce_delete.php?id='.$select["id"].'"><button class="btn btn-danger">Supprimer l\'annonce</button></a>';
            }
          ?>
        </div>
      </div>
    </main>
  </body>
  <?php include('includes/footer.php') ?>
</html>
