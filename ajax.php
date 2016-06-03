<?php 
session_start();
require 'mysql.class.php';
if(isset($_POST['ajax'])){
	$config = @parse_ini_file('config.db.ini');
		// connexion vers la base
	$db = new MySQL();
	if (! $db->Open($config['database'], $config['host'] , $config['user'], $config['password'])) {
    	$db->Kill();
	}
	if($_POST['ajax'] == "setToken"){
		$_SESSION['access_token'] = $_POST['access_token'];
		$_SESSION['user_id'] = $_POST['user_id'];
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['email'] = $_POST['email'];
		echo true;
		exit;
	}
	if($_POST['ajax'] == "envoie"){ 
			$sql = "select * from users where cin='".$_POST['cin']."'";
			$db->Query($sql);
			if($db->RowCount()==""){
				$date_inscrit = date("Y-m-d");
				$sql = "insert into users (nom,cin,user_id,date_inscrit,tel) values('".$_POST['nom']."','".$_POST['cin']."','".$_POST['user_id']."','".$date_inscrit."','".$_POST['tel']."')";
				//echo $sql;
				$db->TransactionBegin();
				if ($db->Query($sql)) {
				$db->TransactionEnd();
				$id =  $db->GetLastInsertID();
					$nomimage = uploadImage();
					if($nomimage != "error"){
						$sql = "insert into images (url,id_user,date_upload) values('".$nomimage."','".$id."','".$date_inscrit."')";
						$db->Query($sql);
					header('Location: partage.php');
					}else{
						$db->TransactionRollback();
						header('Location: game.php?error=image');	
					}
						
				} else {
					$db->TransactionRollback();
					header('Location: game.php?error=inconnu');	
				}
			}else{
				header('Location: game.php?error=cin');
			}
	}

	if($_POST['ajax'] == "setVote"){
		$req = "select * from image_vote where id_image = ".$_POST['id_image']." and id_user_fb = '".$_POST['user_id']."'";
		$res = $db->QueryArray($req);
		if(!empty($res)){
			$req = "delete from image_vote where id_image = ".$_POST['id_image']." and id_user_fb = '".$_POST['user_id']."'";			
		}else{
			$req = "insert into image_vote(id_image,id_user_fb) values(".$_POST['id_image'].",'".$_POST['user_id']."')";
		}
		$db->Query($req);
		$req = "select count(*) as num from image_vote where id_image = ".$_POST['id_image'];
		$nb = $db->QuerySingleValue($req);
		echo $nb;
		exit;
	}

	if($_POST['ajax'] == 'jouer'){
		$numJour = date('j');
		$sql = "insert into gameuser (idUser,numJour,etatGame,idPrixGame) values('".$_SESSION['idUser']."','".$numJour."','".$_POST['etat']."','".$_POST['idprix']."')";
		$db->TransactionBegin();
		if ($db->Query($sql)) {
			$db->TransactionEnd();
			$id =  $db->GetLastInsertID();			
			if($_POST['etat']=="gagner"){
				$req= "select * from prixgame where id=".$_POST['idprix'];
				$price = $db->QuerySingleRowArray($req);
				include 'gagner.php';
				$subject = "concours de l'avent";
				envoiMail($_SESSION["email"], $subject, $body);
			}
			echo 'true';
		} else {
			$db->TransactionRollback();
			echo 'false';	
		}
	}


	if($_POST['ajax'] == 'dejaInscrit'){ // verification si l'email existe ou non
		$sql = "select * from users where email='".$_POST['email']."'";
		$db->Query($sql);
		if($db->RowCount()!=""){
			$row = $db->Row();
			$_SESSION['idUser'] = $row->id;
			$_SESSION["nom"] = $row->nom;
			$_SESSION["prenom"] = $row->prenom;
			$_SESSION["email"] = $row->email;
			if($_POST['souvien']==1) setcookie('AventGame', $row->email, time() + 365*24*3600);
			echo 'true';
		}else{
			echo 'notFound';
		}exit;
	}

	if($_POST['ajax'] == "updateinscrit"){
		$update["nom"]  = MySQL::SQLValue($_POST['nom']);
		$update["prenom"]  = MySQL::SQLValue($_POST['prenom']);
		$update["email"]  = MySQL::SQLValue($_POST['email']);
		$update["ville"]  = MySQL::SQLValue($_POST['ville']);
		$update["adresse"]  = MySQL::SQLValue($_POST['adresse']);
		$update["cp"]  = MySQL::SQLValue($_POST['cp']);
		$update["chanceSort"]  = MySQL::SQLValue(1, "integer");
		$where["id"] = MySQL::SQLValue($_SESSION['idUser'], "integer");
		$result = $db->UpdateRows("users", $update, $where);
		if($result) echo 'true';
		else echo 'false';
	}
}
function uploadImage(){
	$tabExt = array('jpg','gif','png','jpeg'); 
	if( !empty($_FILES['myphoto']['name']) )
  {
  	$extension  = pathinfo($_FILES['myphoto']['name'], PATHINFO_EXTENSION);
  	if(in_array(strtolower($extension),$tabExt))
    {
    	 $nomImage = md5(uniqid()) .'.'. $extension;
		if(move_uploaded_file($_FILES['myphoto']['tmp_name'], 'files/'.$nomImage))
		{
			return $nomImage;
		}
		else
		{
			die('move');
			return 'error';

		}
    }else{
    	die('extension');
    	return 'error';
    }
  }else{
  	die('empty');
    return 'error';
  }
}


?>