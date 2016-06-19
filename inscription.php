<?php
session_start();

include("./includes/functions.php");
inscription_user();
 ?>

<html>
	<head>
		<link rel="stylesheet" href="./css/master.css">
		<title>Inscription</title>
	</head>
	<body>
		<?php require_once('includes/inscription-form.php'); ?>
		<p><a href="index.php"><< retour à l'accueil</a></p>
	</body>
</html>
