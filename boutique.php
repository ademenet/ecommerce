<?php
require_once('./includes/header.php');
session_start();
	if(isset($_GET['add']))
	{
		if (isset($_COOKIE['panier']))
		{
			$tmp = $_COOKIE['panier'].":".$_GET['add'];
			$_COOKIE['panier'] = $tmp;
		}
		else
			$_COOKIE['panier'] = $_GET['add'];
	}
	if (isset($_GET['selection']))
	{
		if ($_GET['selection'] === "sport")
			$query = "SELECT * from jeux WHERE genre = \"sport\"";
		else if ($_GET['selection'] === "combat")
			$query = "SELECT * from jeux";
		else if ($_GET['selection'] === "arcade")
			$query = "SELECT * from jeux WHERE genre = \"arcade\"";
		else if ($_GET['selection'] === "aventure")
			$query = "SELECT * from jeux WHERE genre = \"aventure\"";
		else
			$query = "SELECT * from jeux";
	}
	else
		$query = "SELECT * from jeux";
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
			<a href="?selection=sport"><p class="arcade">Jeux de sport</p></a>
			<a href="?selection=aventure"><p class="arcade">Jeux de aventure</p></a>
			<a href="?selection=arcade"><p class="arcade">Jeux de arcade</p></a>
			<a href="?selection=combat"><p class="arcade">Jeux de combat</p></a>
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
					echo "<a type=\"button\" class = \"ajouter_panier\" href=\"?add=".$donne['nom']."&selection=".$_GET['selection']."\">Ajouter au panier</a>";
				//	echo "<input type=\"submit\" name=\"submit\" class = \"ajouter_panier\" id=\"".$donne['nom']."\"value=\"Ajouter au panier\"/>";
					echo "</form>";
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>
