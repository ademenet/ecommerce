<?php
require_once('./includes/header.php');
$query = "SELECT * FROM jeux";
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
			<a href="?selection=ajouter"><p class="arcade">Ajouter un article</p></a>
			<a href="?selection=modifier"><p class="arcade">modifier un article</p></a>
		</div>
		<div class ="global_box" >
			<h1>FDP</h1>
			<?php
				$base = mysqli_connect('localhost', 'root', '', 'myDB');
				$ret = mysqli_query($base, $query);
				while ($donne = mysqli_fetch_array($ret))
				{
					echo "<div class = \"object\">";
					echo "<h3 class = \"game_name\">".$donne['nom']."</h3>";
					echo "<img src=\"".$donne['img']."\" class = \"img_vignette\">";
					echo "<p class = \"prix\">".$donne['prix']." £</p>";
					echo "<form action=\"\" method=\"get\">";
				//	echo "<input type=\"submit\" name=\"submit\" class = \"ajouter_panier\" id=\"".$donne['nom']."\"value=\"Ajouter au panier\"/>";
					echo "</form>";
					echo "</div>";
				}
			?>
		</div>
		
	</body>
</html>


