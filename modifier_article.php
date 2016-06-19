<?php
require_once('./includes/header.php');

$query = "SELECT * FROM jeux";
print_r($_GET);
	if (isset($_GET['selection']))
	{
		$base = mysqli_connect('localhost', 'root', '', 'myDB');
		$query = "SELECT * from jeux WHERE nom =\"".$_GET['selection']."\"";
		print($query);
		$ret = mysqli_query($base, $query);
		$donne = mysqli_fetch_array($ret);
		$nom = $donne['nom'];
		$stock = $donne['stock'];
		$prix = $donne['prix'];
		$description = $donne['description'];
		$genre = $donne['genre'];
		$img = $donne['img'];
	
	}
	if (isset($_POST['submit']))
	{
		if(!isset($_POST['nom']))
			echo "<div class=\"box-alert\">Vous devez selectionner un nom</div>";
		else if(!isset($_POST['prix']))
			echo "<div class=\"box-alert\">Vous devez selectionner le prix</div>";
		else if(!isset($_POST['platform']))
			echo "<div class=\"box-alert\">Vous devez selectionner la/les platforme(s)</div>";
		else if(!isset($_POST['genre']))
			echo "<div class=\"box-alert\">Vous devez selectionner le genre</div>";
		else if(!isset($_POST['stock']) || !is_numeric($_POST['stock']))
			echo "<div class=\"box-alert\">Vous devez selectionner le stock disponible</div>";
		else
		{
			rm_product($donne['nom']);
			add_product($_POST['nom'], $_POST['prix'], $_POST['description'], verifie_cons("ps4"), verifie_cons("xbox"), verifie_cons("gamecube"), verifie_cons("ds"), $_POST['img'], $_POST['genre'], $_POST['stock']);
		echo "<div class=\"box-valid\">Le jeux ".$_POST['nom']."a été ajouter avec succes</div>";
		echo "<script>setTimeout(\"document.location.href = 'index.php';\",10000);</script>";
		}
	}
?>
<!DOCTYPE HTML>
	<body>
		<div class = "menu_boutique">
			<p>Categorie</p>
			<a href="?selection=supprimer"><p class="arcade">Supprimer un article</p></a>
			<a href="ajouter_article.php"><p class="arcade">Ajouter un article</p></a>
			<a href="?selection=modifier"><p class="arcade">modifier un article</p></a>
		</div>
		<h3>Modifier <?php echo $donne['nom'];?></h3>
		<div class="login-form">
		<h3>Completer les information du jeux a ajouter</h3>
		<form action="" method="POST">
		<label >Nom du jeux :<input type="text" name="nom" value="<?php echo "$nom";?>"/></label>
			<label >Stock de jeux :<input type="text" name="stock"  value="<?php echo "$stock";?>"/></label>
			<label >prix :<input type="text" name="prix" value="<?php echo "$prix";?>"/></label>
			<label >Plaforme compatible :<input type="text" name="platform" value="<?php echo"$nom";?>"/></label>
			<label >description :<input type="text" name="description" class="description" value="<?php echo "$description";?>"/></label>
			<label >Genre du jeux :<input type="text" name="genre" value="<?php echo "$genre";?>"/></label>
			<label >path de la vignette :<input type="text" name="img" value="<?php echo "$img"?>"/></label>
			<input type="submit" name="submit" id="" value="Ajouter" />
		</form>
		</div>
	</body>
</html>


