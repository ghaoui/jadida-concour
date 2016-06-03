<?php 
session_start();
	if(!isset($_SESSION['user_id'])){
		header('Location: index.php');    
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Jadida</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/font-awesome.min.css">	
	<link rel="stylesheet" href="css/style.css">	
	</head>
	<body>
		<div class="background-game form">
			<img src="images/bg-form.png" alt="" class="center-block img-responsive">
			<div class="content">
				<div class="container menu">
					<div class="row">
						<div class="col-lg-2"><a href="index.php" >Accueil</a></div>
						<div class="col-lg-2"><a href="game.php" class="active">Jeu</a></div>
						<div class="col-lg-5"></div>
						<div class="col-lg-1"><a href="gallerie.php">Gelerie</a></div>
						<div class="col-lg-1"></div>
						<div class="col-lg-1"><a href="reglement.pdf">Réglement</a></div>
					</div>
				</div>
			</div>
			<div class="form-content">
				<div class="container">
					<div class="row">
						<div class="col-lg-offset-1 col-lg-10">
							<div class="content-form-white">
							<form action="ajax.php" method="POST" enctype="multipart/form-data">
								<h2>Pour commencer<br> merci de remplir cd formulaire</h2>
								<section class="left-section">
									<div class="form-group">
									    <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name'];?>">
									</div>
									<div class="form-group">
									    <input type="text" name="cin" class="form-control" id="cin" placeholder="CIN" >
									</div>
								</section>
								<section class="right-section">
									<div class="form-group">
									    <input type="text" name="ville" class="form-control" id="ville" placeholder="Gouvernorat">
									</div>
									<div class="form-group">
									    <input type="text" name="tel" class="form-control" id="tel" placeholder="N°tel" >
									</div>
								</section>
								<section class="bottom-section-left">
									<div class="form-group">
										<div class="file">
											<input type="file" id="myphoto" name="myphoto">
										</div>									    
									</div>
								</section>
								<section class="bottom-section-right">
									<div class="form-group text-file">
									   Télécharger la photo de votre dbara ici avec un produit Jadida et gagner un voyage pour 2 personnes à istambul.
									</div>
								</section>
								<section class="gp-button">
									<button class="annuler">Annuler</button>
									<button type="submit" class="valider">Valider</button>
								</section>
								<input type="hidden" name="ajax" value="envoie">
								<input type="hidden" name="user_id" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['user_id'];?>">
							</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bottom">
				<div class="container-fluid">
					<ul id="social">
						<li class="facebook"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="twitter"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</li>
				</div>
			</div>
		</div>


		<script language="JavaScript" src="js/jquery-1.12.3.min.js"></script>
		<script language="JavaScript" src="js/jquery.share.js"></script>
		<script language="JavaScript" src="js/fb.js"></script>
		<script language="JavaScript" src="js/script.js"></script>
	</body>
</html>