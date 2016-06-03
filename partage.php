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
		<div class="background-game partage form">
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
								<h2>Merci pour votre participation</h2>
								<section class="button-partage">
									<a href="gallerie.php" class="voir">Voir galerie</a>
									<a href="#" class="partager" id="partager">Partager Votre photo sur Facebook</a>
									<a href="#" class="inviter" id="inviter">Inviter vos amis</a>
								</section>	
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