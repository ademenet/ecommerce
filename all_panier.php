<?php
session_start();

require_once('./includes/header.php');

?>
<html>
	<link rel="stylesheet" href="./css/master.css" media="screen" title="no title" charset="utf-8">

	<div class="all_panier">
	<?php
		if (1 ||$_SESSION['userinfo']['admin'] == 1)
		{
			$query = "SELECT panier FROM user WHERE panier IS NOT NULL";
			$base = mysqli_connect('localhost', 'root', '', 'myDB');
			$ret = mysqli_query($base, $query);
			echo "<tr>";
			$donne = mysqli_fetch_array($ret);
			$resultat = unserialize($donne['panier']);
			foreach($resultat as $panier)
			{
				foreach ($panier as $elem)
				{
					echo "<td class = \"tab_panier\">";
					echo "<h3>".$elem['name']."</h3>";
					echo "<p>Quantite : ".$elem['quantity']."</p>";
					echo "</td>";
				}
			}
			echo "</tr>";
		}
	?>
		<h1></h1>
	</div>
</html>
