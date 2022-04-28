<!DOCTYPE html>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/backoffice-style.css">
		<title>Liste users</title>
	</head>
	<body>
		<?php include('../includes/backoffice-header.php'); ?>
		<main>
			<?php include('../includes/motoMessage.php'); ?>
			<form action="../includes/delete.php?table=users" method="post">
				<div class="mb-3" id="suppr">
					<div class="input-group">
						<div class="form-floating">
							<input class="form-control" id="delete" type="number" name="delete" placeholder="ex: 12">
							<!-- <input type="text" value="event" name="table" style="display: none"> -->
							<label for="floatingSelectGrid">Entrer l'id de la l'event à supprimer</label>
						</div>
						<input class="btn btn-danger input-group-text" type="submit" value="Supprimer">
					</div>
				</div>
			</form>


			<div class="d-flex justify-content-center">
				<div class="d-flex col-4">
					<input type="text" id="search" class="form-control" placeholder="Recherche">
					<button class="btn btn-primary" onclick="listSearch('users')">Chercher</button>
				</div>
			</div>

			<div id="database"></div>

			<script src="../scripts/ajax_db.js"></script>
			<script>listSearch('users')</script>

		</main>
	<body>
</html>
