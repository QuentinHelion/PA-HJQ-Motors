<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.php'); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>HJQ-Motors</title>
		<link rel="stylesheet" href="css/style.css">
		<script src="scripts/moto-sort.js" charset="utf-8"></script>
    <script src="scripts/catalog.js" charset="utf-8"></script>
	</head>
	<body id="culot">
		<?php include('includes/header.php'); ?>
		<main>
	   <div class="container">
			 <div class="row">
         <div class="col-xs-12">
           <nav>
             <div class="nav nav-tabs nav-fill" id="nav-tab">
               <a class="nav-item nav-link" id="sortPriceBar" onclick="deployBar('child_sortPriceBar',0)">Filtrer par prix</a>
               <!-- <a class="nav-item nav-link" id="sortTypeBar" onclick="deployBar('child_sortTypeBar',1)">Filtrer par type</a> -->
               <a class="nav-item nav-link" id="sortMarkBar" onclick="deployBar('child_sortMarkBar',2)">Filtrer par marque</a>
               <a class="nav-item nav-link" id="sortAlphabeticBar" onclick="deployBar('child_sortAlphabeticBar',3)">Filtrer par ordre alphabétique</a>
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
             <div id="child_sortMarkBar" style="display:none">
               <div class="nav nav-tabs nav-fill">
                 <a class="nav-item nav-link" onclick="sortMark('BMW')">BMW</a>
                 <a class="nav-item nav-link" onclick="sortMark('KTM')">KTM</a>
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
			 <br>
		   <div class="row">
				 <?php
	          include("includes/db_connexion.php");

						if(isset($_SESSION["id"])){
							$req_verif = $db->prepare('SELECT birth_date,admin FROM users WHERE id = ?');
							$req_verif->execute([$_SESSION["id"]]);
							$verif = $req_verif->fetch();

							if($verif['birth_date']){
								$birth = date_create($verif["birth_date"]);
								$birthFormat = date_format($birth, "Y-m-d");
								$age = date('Y') - date_format($birth, "Y");;
								if (date('md') < date('md', strtotime($birthFormat))) {
										$age -= 1;
								}
							} else {
								$age = 99;
							}

							$age = $verif["admin"] ? 99 : $age;

							$s = 'SELECT * FROM moto WHERE age_min <= '.$age;
		          $req_select = $db->query($s);
		          $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

		          foreach ($select as $req) {
								echo '<div class="col-md-4 col-sm-6 col-sx-12" id="'.$req["puissance"].'-'.$req["marque"].'-'.$req["model"].'-'.$req["prix"].'-'.$req["prix"].'">
												<div class="product-grid" id="moto">
													<div class="product-image">
														<a href="moto_page.php?id='.$req["id"].'">
															<img class="pic-1" src="uploads/motos/'.$req["image1"].'">
															<img class="pic-2" src="uploads/motos/'.$req["marque"].'-logo.png">
														</a>
													</div>
													<div class="product-content">
														<h3 class="title"><a href="moto_page.php?id='.$req["id"].'">'.$req["marque"].'  '.$req["model"].'</a></h3>
														<div>
															<span>Disponible</span>
															<!--<span>Résérver</span>-->
														</div>
														<!-- <span>999 CV</span> -->
														<a class="add-to-cart">'.$req["prix"].'€/jour</a>
													</div>
												</div>
											</div>';
							}
						} else {
							$s = 'SELECT * FROM moto';
							$req_select = $db->query($s);
							$select = $req_select->fetchAll(PDO::FETCH_ASSOC);

							foreach ($select as $req) {
								echo '<div class="col-md-4 col-sm-6 col-sx-12" id="'.$req["puissance"].'-'.$req["marque"].'-'.$req["model"].'-'.$req["prix"].'-'.$req["prix"].'">
												<div class="product-grid" id="moto">
													<div class="product-image">
														<a href="moto_page.php?id='.$req["id"].'">
															<img class="pic-1" src="uploads/motos/'.$req["image1"].'">
															<img class="pic-2" src="uploads/motos/'.$req["marque"].'-logo.png">
														</a>
													</div>
													<div class="product-content">
														<h3 class="title"><a href="moto_page.php?id='.$req["id"].'">'.$req["marque"].'  '.$req["model"].'</a></h3>
														<div>
															<span>Disponible</span>
															<!--<span>Résérver</span>-->
														</div>
														<!-- <span>999 CV</span> -->
														<a class="add-to-cart">'.$req["prix"].'€/jour</a>
													</div>
												</div>
											</div>';
							}
						}
	      	?>
				</div>
	  	</div>
		</main>
		<?php include('includes/footer.php') ?>
	</body>
</html>
