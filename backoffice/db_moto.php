<!DOCTYPE html>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/backoffice-style.css">
		<title>Liste motos</title>
	</head>
	<body>
		<?php include('../includes/backoffice-header.php'); ?>
		<main>
			<?php include('../includes/motoMessage.php'); ?>

			<div class="text-center">
				<a href="add_moto.php"><button class="mb-4 mt-2 btn btn-primary">Ajouter une moto</button></a>
			</div>

			<form action="../includes/delete.php?table=moto" method="post">
				<div class="mb-3" id="suppr">
					<div class="input-group">
						<div class="form-floating">
							<input class="form-control" id="delete" type="number" name="delete" placeholder="ex: 12">
							<!-- <input type="text" value="moto" name="table" style="display: none"> -->
							<label for="floatingSelectGrid">Entrer l'id de la moto à supprimer</label>
						</div>
						<input class="btn btn-danger input-group-text" type="submit" value="Supprimer">
					</div>
				</div>
			</form>

			<form action="modif-element.php?element=moto" method="post">
				<div class="mb-3" id="modif">
					<div class="input-group">
						<div class="form-floating">
							<input class="form-control" id="delete" type="number" name="modif" placeholder="ex: 12">
							<label for="floatingSelectGrid">Entrer l'id de la moto modifier</label>
						</div>
						<input class="btn btn-primary input-group-text" type="submit" value="Modifier">
					</div>
				</div>
			</form>


			<div class="d-flex justify-content-center">
				<div class="d-flex col-4">
					<input type="text" id="search" class="form-control" placeholder="Recherche">
					<button class="btn btn-primary" onclick="listSearch('moto')">Chercher</button>
				</div>
			</div>

			<div id="database"></div>

			<script src="../scripts/ajax_db.js"></script>
			<script>listSearch('moto')</script>

		</main>
	<body>
</html>
