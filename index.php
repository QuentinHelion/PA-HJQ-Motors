<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<?php include('includes/head.php') ?>
		<link rel="stylesheet" type="text/css" href="css\style_index.css">
		<title>HJQ-Motors</title>
	</head>
	<body>
		<?php
			include('includes/header.php');
		?>
		<main>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-sx-12">
						<h1>BIENVENUE CHEZ HJQ-MOTORS</h1>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h2 id="gang"> ACTUALITES<h2>
					</div>
				</div>
				<div class="row">
					<div class="container">
						<div class="parallax5">
						  <div class="ho">
								<h4>COVID-19 : Informations sur les dispositions de HJQ-MOTORS.</h4>
								<div class="infoPlus">
									<p>Plus d'informations ▼</p>
									<div class="cache">
										<p>
											La santé et la sécurité des clients et des équipes sont au cœur de nos préoccupations. Ces temps difficiles nous ont montré que pour la sécurité de tous, nous devons faire preuve de plus de responsabilité (que jamais auparavant).C'est pourquoi, à partir d'aujourd'hui, nous prenons des mesures de sécurité spéciales pour résoudre cette situation et jouer notre rôle.C'est pourquoi nous fermons temporairement tous les concessionnaires HJQ-MOTORS en France indéfiniment.Par ailleurs, l'équipe HJQ-MOTORS reste à votre écoute pour recueillir vos demandes d’information et questions par mail.
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="parallax6">
							<div class="ho">
								<h4>NOUVEAUTE : Concept de moto électrique conçu par BMW.</h4>
								<div class="infoPlus">
									<p>Plus d'informations ▼</p>
									<div class="cache">
											<p>
												La marque BMW nous surprend avec l'une de ces nouvelles moto électrique qui dépasse l’entendement . Il cite ceci : " Nous n'avons jamais connu de temps d'arrêt et gardons toujours une large longueur d'avance. Notre vision: créer le plus grand sentiment de liberté possible à chaque tour et la symbiose parfaite entre l'homme et la machine. Et le mieux dans tout cela: nous pouvons d'ores et déjà vous présenter ce véhicule futuriste, la VISION NEXT 100 de BMW. Notre objectif est de construire chaque moto BMW de manière à ce qu'elle vous procure la plus grande expérience de conduite moto.
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="container-fluid">
							<div class="parallax7">
								<div class="ho">
									<h4>MOTOSPORT : La Course ne s'arrête jamais avec la BMW S 1000 RR.</h4>
									<div class="infoPlus">
										<p>Plus d'informations ▼</p>
										<div class="cache">
											<p>
												Que ce soit en Asie, en Amérique, en Europe, en Afrique ou en Australie, la BMW S 1000 RR collectionne les victoires et les titres sur les pistes de course du monde entier depuis plusieurs années. Partout dans le monde, d’innombrables pilotes et équipes BMW comptent sur la performance de la RR et sur l'expertise des spécialistes de BMW Motorrad durant les championnats nationaux et internationaux. Le résultat : la communauté mondiale BMW Motorrad Motorsport ne cesse de s'agrandir.
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php
					 		include('includes/db_connexion.php'); //connexion db

							$s = 'SELECT id, title, description, date_event, image_0 FROM event'; //requête sql
							$req_select = $db->query($s);
							$select = $req_select->fetchAll(PDO::FETCH_ASSOC); //recupe toutes les lignes renvoyé pas la requête
							$y = 0;

							if($select){
								echo '<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<h2 id="zang">EVENEMENTS<h2>
												</div>
												<h2 id="evenement"> Itinéraires de Balade en moto : Voyager avec les iténéraires de HJQ-MOTORS.</h2>
											</div>';
							}

							foreach ($select as $event) {
								if($y <= 4){
									$pathImg = "'uploads/event/".$event["image_0"]."'"; //localisation de l'image
									echo  '<div class="container-fluid">
								         	<div class="parallax" style="background-image: url('.$pathImg.')">
														<a href="event_page.php?id='.$event["id"].'"><h2 class="text-center pt-2" id="event">'.$event["title"].'</h2></a>
														<a href="event_page.php?id='.$event["id"].'"><h4 class="text-center p-3" id="event">'.$event["description"].'</h4></a>
													</div>
								         </div>';
									$y++;
								}
							}
						?>
				</div>
		</main>
		<?php include('includes/footer.php') ?>
	</body>
</html>
