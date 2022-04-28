<!DOCTYPE html>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/backoffice-style.css">
		<title>Liste reservation</title>
	</head>
	<body>
		<?php include('../includes/backoffice-header.php'); ?>
		<main>
			<?php include('../includes/motoMessage.php'); ?>

			<form action="../includes/delete.php?table=reservation" method="post">
				<div class="mb-3" id="suppr">
					<div class="input-group">
						<div class="form-floating">
							<input class="form-control" id="delete" type="number" name="delete" placeholder="ex: 12">
							<label for="floatingSelectGrid">Entrer l'id de la reservation à supprimer</label>
						</div>
						<input class="btn btn-danger input-group-text" type="submit" value="Supprimer">
					</div>
				</div>
			</form>

      <style>
        div.form-floating > input{
          height: 5.5vh !important;
        }
      </style>
      <div class="container mb-4">
        <h4 class="text-center">Modifier une reservation</h4>
        <div class="d-flex justify-content-center">
          <form method="post" action="verif-modif_reservation.php">
            <div class="d-flex">
              <div class="form-floating">
                <input type="number" name="id" class="form-control col-3">
                <label>Numéro de reservation</label>
              </div>
              <div class="form-floating">
                <input class="form-control" type="date" name="date_from" placeholder=".">
                <label>Date de début</label>
              </div>
              <div class="form-floating">
                <input class="form-control" type="date" name="date_to"  placeholder=".">
                <label>Date de fin</label>
              </div>
              <input type="submit" id="button" class="btn btn-primary" value="Modifier">
            </div>
          </form>
        </div>
      </div>

			<div class="d-flex justify-content-center">
				<div class="d-flex col-4">
					<input type="text" id="search" class="form-control" placeholder="Recherche">
					<button class="btn btn-primary" onclick="listSearch('reservation')">Chercher</button>
				</div>
			</div>

			<div id="database"></div>

			<script src="../scripts/ajax_db.js"></script>
			<script>listSearch('reservation')</script>

		</main>
	<body>
</html>
