<?php
session_start();

include("./includes/functions.php");

if ($_POST['submit'] === "Valider") {
	if ($_POST['usrlog'] && $_POST['usrprenom'] && $_POST['usrnom'] && $_POST['usraddress'] && $_POST['usrmail'] && $_POST['usrpwd'])
	{
		if (!filter_var($_POST['usrmail'], FILTER_VALIDATE_EMAIL)) {
			alert("Le format de votre mail n'est pas valide");
		} else {
			if (check_user(secu($_POST['usrlog']))) {
				add_user(secu($_POST['usrlog']), secu($_POST['usrpwd']), secu($_POST['usrprenom']), secu($_POST['usrnom']), secu($_POST['usrtel']), secu($_POST['usrmail']), secu($_POST['usraddress']));
				$_SESSION['userinfo'] = get_userinfos(secu($_POST['usrlog']));
				valid("Bienvenue ".$_SESSION['userinfo']['login']." sur &#10084 games");
				echo "<script>setTimeout(\"document.location.href = 'index.php';\",2000);</script>";
			} else {
				alert("Votre nom d'utilisateur n'est pas disponible");
			}
		}
	} else {
		alert("Veuillez remplir tous les champs obligatoires (*)");
	}
}
 ?>

<html>
	<head>
		<link rel="stylesheet" href="./css/master.css">
		<title>Inscription</title>
	</head>
	<body>
		<div class="login-form">
			<h1>Inscription</h1>
			<?php require_once('includes/inscription-form.php'); ?>
		</div>
		<p>
			<a href="index.php"><< retour à l'accueil</a>
		</p>
	</body>
</html>
