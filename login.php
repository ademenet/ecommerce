<?php
session_start();

include('includes/functions.php');

$_SESSION['admin'] = "";
$_SESSION['user'] = "";

if ($_POST['submit'] === "Connexion") {
	if (isset($_POST['usrlog']) && isset($_POST['usrpwd']) && !empty($_POST['usrlog']) && !empty($_POST['usrpwd'])) {
		if (check_login($_POST['usrlog'])) {
			alert("Désolé, ce n'est pas le bon login");
		} if (check_passwd($_POST['usrpwd'])) {
			alert("Désolé, ce n'est pas le bon mot de passe");
		} else {
			if (check_admin($_POST['usrlog'])) {
				$_SESSION['admin'] = 1;
			} else {
				$_SESSION['user'] = 1;
			}
			header('Location: index.php');
		}
	}
	else {
		alert("Veuillez remplir tous les champs");
	}
}
 ?>
<html>
	<link rel="stylesheet" href="./css/master.css" media="screen" title="no title" charset="utf-8">

	<div class="login-form">
		<h1>Connexion</h1>
		<form action="" method="POST">
			<p>Veuillez entrer votre login :<input type="text" name="usrlog" value=""></p>
			<p>Veuillez entrer votre mot de passe :<input type="password" name="usrpwd" value=""></p>
			<input type="submit" name="submit" value="Connexion">
		</form>
	</div>
</html>
