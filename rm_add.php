<?php
if ($_POST['submit'] == "Suprimer" && isset($_GET['rm']))
{
	rm_product($_GET['rm']);
}
else if ($_POST['submit'] == "modifier" && isset($_GET['rm']))
{
	header("Location: modifier_article.php?selection=".$_GET['rm']);
}
else if (isset($_GET['rm_genre']))
{
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$ret = mysqli_query($base, "SELECT * FROM global");
	$donne = mysqli_fetch_array($ret);
	$donne = explode(":", $donne['conf']);
	foreach($donne as $genre)
	{
		if ($genre != $_GET['rm_genre'])
		{
			if (isset($new))
				$new .= ":".$genre;
			else
				$new = $genre;
		}
	}
	$query2 = "UPDATE global SET conf = '".$new."'";
	print ($new);
	$ret = mysqli_query($base, $query2);
}
else if (isset($_GET['ajouter']))
{
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$ret = mysqli_query($base, "SELECT * FROM global");
	$donne = mysqli_fetch_array($ret);
	$new = $donne['conf'].":".$_GET['ajouter'];
	$query2 = "UPDATE global SET conf = '".$new."'";
	$ret = mysqli_query($base, $query2);
}
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
			<a href="ajouter_article.php"><p class="arcade">Ajouter un article</p></a>
			<a href="modifier_article.php"><p class="arcade">modifier un article</p></a>
			<div>
				<form action="" method="get" accept-charset="utf-8">
					SUPRIMER CATEGORIE
					<select name="rm_genre" >
					<?php 
						$base = mysqli_connect('localhost', 'root', '', 'myDB');
						$ret = mysqli_query($base, "SELECT * FROM global");
						$donne = mysqli_fetch_array($ret);
						print($donne['conf']);
						$donne = explode(":", $donne['conf']);
						foreach($donne as $genre)
						{
							echo "<OPTION>".$genre;
						}
					?>
					</select>
					<input type="submit" name="" id="" value="Suprimer" />
				</form>
			</div>
		<div>
			<form action="" method="get" accept-charset="utf-8">
				<p>Ajouter categorie <input type="text" name="ajouter" value="" /></p>
					<input type="submit" name="" id="" value="ajouter" />
			</form>
		</div>
		</div>
		<div class ="global_box" >
			<h1 id ="cc">FDP</h1>
			<?php
				$base = mysqli_connect('localhost', 'root', '', 'myDB');
				$ret = mysqli_query($base, $query);
				echo "<script type=\"text/javascript\" charset=\"utf-8\">";
				echo "var div = document.getElementById(\"cc\")[0];";
				echo "\n div.addEventListener('click', function (event) {document.write(\"<?php header('?rm=5'); ?> <h1>coucou</h1>?>\");})";
				echo "</script>";
				while ($donne = mysqli_fetch_array($ret))
				{
					echo "<div class = \"object\">";
					echo "<h3 class = \"game_name\">".$donne['nom']."</h3>";
					echo "<img src=\"".$donne['img']."\" class = \"img_vignette\">";
					echo "<p class = \"prix\">".$donne['prix']." £</p>";
					echo "<form action=\"?rm=".$donne['nom']."\" method=\"post\">";
					echo "<input type=\"submit\" name=\"submit\" class = \"ajouter_panier\" value=\"Supprimer\"/>";
					echo "<input type=\"submit\" name=\"submit\" class = \"ajouter_panier\" value=\"modifier\"/>";
					echo "</form>";
					echo "</div>";
				}
			?>
		</div>
		
	</body>
</html>


