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
if (isset($_GET['mod']))
{
	if ($_POST['submit'] == "Supprimer")
	{
		foreach($_SESSION['panier'] as $article)
		{
			if ($article['nom'] == $_GET['mod'])
			{
				array_splice($_SESSION['panier'], 1);
			}
			$count++;
		}
	}
	else
	{
	
	}
}
?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/panier.css" title="" type="" />
	<title></title>
	
</head>
<body>
	<div class = "panier">
		<?php
		$base = mysqli_connect('localhost', 'root', '', 'myDB');
		$prix_total = 0;
		if (isset($_SESSION['panier'])) {
			foreach($_SESSION['panier'] as $article)
			{
				$query = "SELECT * FROM jeux WHERE nom = \"".$article['name']."\"";
				$ret = mysqli_query($base, $query);
				$donne = mysqli_fetch_array($ret);
				$prix_total += $donne['prix'] * $article['quantity'];
				echo "<div class = \"panier_box\">";
				echo "<h3 class = \"game_name\">".$donne['nom']."</h3>";
				echo "<p> description :".$donne['description']."</p>";
				echo "<p>".$donne['prix']." euros</p>";
				echo "<p> Quantite : ".$article['quantity']."</p>";
				echo "<form action=\"?mod=".$donne['nom']."\" method=\"post\" accept-charset=\"utf-8\">";
				echo "<input type=\"submit\" value=\"Supprimer\" />";
				echo "</form>";
				echo "<br />";
				echo "</div>";
			}
		?>
		<div>
			<p>Votre panier vaut actuellement : <?php  echo "$prix_total";?></p>
			<form action="" method="get" accept-charset="utf-8">
				<input type="submit" name="submit" id="" value="Valider" />
				<input type="submit" name="submit" id="" value="Supprimer"/>
			</form>
		</div>
		<?php } else { ?>
			<p>Votre panier est vide.</p>
		<?php } ?>
	</div>
</body>
<?php require_once('./includes/footer.php'); ?>
