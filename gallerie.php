<?php 
session_start();
require 'mysql.class.php';
	if(!isset($_SESSION['user_id'])){
		header('Location: index.php');    
	}
	$config = @parse_ini_file('config.db.ini');
		// connexion vers la base
	$db = new MySQL();
	if (! $db->Open($config['database'], $config['host'] , $config['user'], $config['password'])) {
    	$db->Kill();
	}
	$sql = "select i.id as id, nom, url from images i,users u where u.id = i.id_user";
	$images = $db->QueryArray($sql);
	//echo '<pre>';print_r($images);echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Jadida</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/uikit.min.css">	
	<link rel="stylesheet" href="css/font-awesome.min.css">	
	<link rel="stylesheet" href="css/style.css">	
	</head>
	<body>
		<div class="background-game partage form">
			<img src="images/bg-gallerie.png" alt="" class="center-block img-responsive">
			<div class="content">
				<div class="container menu">
					<div class="row">
						<div class="col-lg-2"><a href="index.php" >Accueil</a></div>
						<div class="col-lg-2"><a href="game.php" >Jeu</a></div>
						<div class="col-lg-5"></div>
						<div class="col-lg-1"><a href="gallerie.php" class="active">Gelerie</a></div>
						<div class="col-lg-1"></div>
						<div class="col-lg-1"><a href="reglement.pdf">Réglement</a></div>
					</div>
				</div>
			</div>
			<div class="gallerie">
				<div class="container" id="content-press">
					<ul class="gallerie-content row1" id="gallerie-content">
						<?php foreach ($images as $image): ?>
						<?php 
							$req = "select count(*) as num from image_vote where id_image = ".$image['id'];
							$nb = $db->QuerySingleValue($req);
						?>
						<li>
							<div class="img-galerie">
								<a href="files/<?php echo $image['url'];?>" data-uk-lightbox="{group:'my-group'}" data-idimage="<?php echo $image['id'];?>" data-nbimage="<?php echo $nb;?>" class="prettyclick" data-nom="<?php echo $image['nom'];?>">
									<div class="crop">
										<img src="files/<?php echo $image['url'];?>" alt="" class="img-responsive">
									</div>									
								</a>
								<div class="jaime-content">
									<img src="images/jaime.png" alt="" class="img-responsive">
									<span class="name-participant"><?php echo $image['nom'];?></span>									
									<a href="#" class="jaime-button"  data-idimage="<?php echo $image['id'];?>"><i class="fa fa-heart" aria-hidden="true"></i> <span><?php echo $nb;?></span></a>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
					<div id="page_navigation"></div>
					<input type="hidden" id="current_page" value="">
					<input type="hidden" id="show_per_page" value="6">
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
		<script language="JavaScript" src="js/uikit.min.js"></script>
		<script language="JavaScript" src="js/lightbox.min.js"></script>
		<script language="JavaScript" src="js/jquery.share.js"></script>
		<script language="JavaScript" src="js/fb.js"></script>		
		<script language="JavaScript" src="js/script.js"></script>
		<script language="JavaScript" src="js/pagination.js"></script>
	</body>
</html>