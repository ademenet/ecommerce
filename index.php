<?php
// J'inclus le header (menu) dans chaque page une seule fois.
require_once('includes/header.php');
?>

<div class="highlight">
	<h1>Bienvenue dans notre boutique !</h1>
	<h3>Une sélection des jeux du mois :</h3>
	<?php
		$base = mysqli_connect('localhost', 'root', '', 'myDB');
		$query = "SELECT * FROM jeux WHERE ID < 6";
		$ret = mysqli_query($base, $query);
		while ($donne = mysqli_fetch_array($ret))
		{
			echo "<div class = \"object\">";
			echo "<h3 class = \"game_name\">".$donne['nom']."</h3>";
			echo "<img src=\"".$donne['img']."\" class = \"img_vignette\">";
			echo "<p class = \"prix\">".$donne['prix']." £</p>";
			echo "<a href=\"boutique.php\">Visiter la boutique</a>";
			echo "</form>";
			echo "</div>";
		}
	?>
</div>

<?php
require_once('includes/footer.php');
 ?>
