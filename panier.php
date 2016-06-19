<?php
require_once('./includes/header.php');
session_start();
if ($_GET['submit'] == "Supprimer")
{
	$_SESSION['panier'] = array();
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$string = serialize($_SESSION['panier']);
	$query = "UPDATE user SET panier ='".$string."' WHERE login = '".$_SESSION['userinfo']['login']."'";
	$ret = mysqli_query($base, $query);
}
else if ($_GET['submit'] == "Valider")
{
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$string = serialize($_SESSION['panier']);
	$query = "UPDATE user SET panier ='".$string."' WHERE login = '".$_SESSION['userinfo']['login']."'";
	$ret = mysqli_query($base, $query);
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Panier</title>
	</head>
	<body>
		<div class = "panier">
			<?php
			$base = mysqli_connect('localhost', 'root', '', 'myDB');
			$prix_total = 0;
				foreach($_SESSION['panier'] as $article)
				{
					$query = "SELECT * FROM jeux WHERE nom = \"".$article['name']."\"";
					$ret = mysqli_query($base, $query);
					$donne = mysqli_fetch_array($ret);
					$prix_total += $donne['prix'] * $article['quantity'];
					echo "<div>";
					echo "<h3>".$donne['nom']."</h3>";
					echo "<p> description :".$donne['description']."</p>";
					echo "<p>".$donne['prix']."</p>";
					echo "<p> Quantite : ".$article['quantity']."</p>";
					echo "<br />";
					echo "</div>";
				}
			?>
		</div>
	<div>
	<p>Votre panier vaut actuellement : <?php  echo "$prix_total";?></p>
		<form action="" method="get" accept-charset="utf-8">
			<input type="submit" name="submit" id="" value="Valider" />
			<input type="submit" name="submit" id="" value="Supprimer"/>
		</form>
	</div>
	</body>
</html>
