<?php
require_once('./includes/header.php');

$query = "SELECT * FROM jeux";
	if (isset($_POST['submit']))
	{
		if(!isset($_POST['nom']))
			echo "<div class=\"box-alert\">Vous devez selectionner un nom</div>";
		else if(!isset($_POST['prix']) || !is_numeric($_POST['prix']))
			echo "<div class=\"box-alert\">Vous devez selectionner le prix</div>";
		else if(!isset($_POST['platform']))
			echo "<div class=\"box-alert\">Vous devez selectionner la/les platforme(s)</div>";
		else if(!isset($_POST['genre']))
			echo "<div class=\"box-alert\">Vous devez selectionner le genre</div>";
		else if(!isset($_POST['stock']) || !is_numeric($_POST['stock']))
			echo "<div class=\"box-alert\">Vous devez selectionner le stock disponible</div>";
		else
		{
			add_product($_POST['nom'], $_POST['prix'], $_POST['description'], verifie_cons("ps4"), verifie_cons("xbox"), verifie_cons("gamecube"), verifie_cons("ds"), $_POST['img'], $_POST['genre'], $_POST['stock']);
		echo "<div class=\"box-valid\">Le jeux ".$_POST['nom']."a été ajouter avec succes</div>";
		echo "<script>setTimeout(\"document.location.href = 'index.php';\",10000);</script>";
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head >
		<title>Boutique</title>
		<link rel="stylesheet" href="css/boutique.css" />
	</head>
	<body>
		<div class = "menu_boutique">
			<p>Categorie</p>
			<a href="?selection=supprimer"><p class="arcade">Supprimer un article</p></a>
			<a href="ajouter_article.php"><p class="arcade">Ajouter un article</p></a>
			<a href="?selection=modifier"><p class="arcade">modifier un article</p></a>
		</div>
		<div class="login-form">
		<h3>Completer les information du jeux a ajouter</h3>
		<form action="" method="POST">
			<label >Nom du jeux :<input type="text" name="nom"/></label>
			<label >Stock de jeux :<input type="text" name="stock"/></label>
			<label >prix :<input type="text" name="prix"/></label>
			<label >Plaforme compatible :<input type="text" name="platform" value ="ps4:xbox:etc..."/></label>
			<label >description :<input type="text" name="description" class="description"/></label>
			<label >Genre du jeux :<input type="text" name="genre"/></label>
			<label >path de la vignette :<input type="text" name="img"/></label>
			<input type="submit" name="submit" id="" value="Ajouter" />
		</form>
		</div>
	</body>
</html>


