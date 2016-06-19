<?php
require_once('./includes/header.php');
session_start();
if ($_GET['submit'] == "Supprimer" && isset($_SESSION['userinfo']['login']))
{
	$_SESSION['panier'] = array();
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$string = serialize($_SESSION['panier']);
	$query = "UPDATE user SET panier ='".$string."' WHERE login = '".$_SESSION['userinfo']['login']."'";
	$ret = mysqli_query($base, $query);
}
else if ($_GET['submit'] == "Supprimer" && !isset($_SESSION['userinfo']['login']))
{
	$_SESSION['panier'] = array();
}
else if ($_GET['submit'] == "Valider" && isset($_SESSION['userinfo']['login']))
{
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$string = serialize($_SESSION['panier']);
	$query = "UPDATE user SET panier ='".$string."' WHERE login = '".$_SESSION['userinfo']['login']."'";
	$ret = mysqli_query($base, $query);
}
else if ($_GET['submit'] == "Valider" || $_GET['submit'] == "Supprimer")
{
	alert("Vous devez vous connecter");
}
if (isset($_GET['mod']))
{
	if ($_POST['submit'] == "Supprimer")
	{
		$count = 0;
		foreach($_SESSION['panier'] as &$article)
		{
			if ($article['name'] == $_GET['mod'])
			{
				break;
			}
			$count++;
		}
		array_splice($_SESSION['panier'], $count, 1);
	}
	else if ($_POST['submit'] == "Modifier" && is_numeric($_POST['new_qt']))
	{
		$count = 0;
		foreach($_SESSION['panier'] as &$article)
		{
			if ($article['name'] == $_GET['mod'])
				$article['quantity'] = intval($_POST['new_qt']);
		}
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
				echo "<form action=\"?mod=".$donne['nom']."\" method=\"POST\" accept-charset=\"utf-8\">";
				echo "<p class=\"modifier_qt\">Modifie la quantite : <input type=\"text\" name=\"new_qt\" value=\"".$article['quantity']."\" /></p>";
				echo "<input type=\"submit\"name = \"submit\"value=\"Supprimer\" />";
				echo "<input type=\"submit\"name = \"submit\"value=\"Modifier\" />";
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
