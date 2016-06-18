<?php
session_start();

$_SESSION['admin'] = "";

if ($_POST['submit'] === "Connexion") {
	if (isset($_POST['admlog']) && isset($_POST['admpwd']) && !empty($_POST['admlog']) && !empty($_POST['admpwd']))
	{
		if ($_POST['admlog'] === $admlogin && $_POST['admpwd'] === $admpasswd) {
			$_SESSION['admin'] = $_POST['admlog'];
			header('Location: admin.php');
		}
		elseif ($_POST['admlog'] !== $admlogin) {
			echo "<div class=\"box-alert\">Désolé, ce n'est pas le bon login</div>";
		}
		elseif ($_POST['admpwd'] !== $admpasswd) {
			echo "<div class=\"box-alert\">Désolé, ce n'est pas le bon mot de passe</div>";
		}
	} else {
		echo "<div class=\"box-alert\">Veuillez remplir tous les champs</div>";
	}
}
 ?>

<link rel="stylesheet" href="./css/master.css" media="screen" title="no title" charset="utf-8">

<div class="login-form">
	<h1>Connexion</h1>
	<form action="" method="POST">
		<p>Veuillez entrer votre login :<input type="text" name="admlog" value=""></p>
		<p>Veuillez entrer votre mot de passe :<input type="password" name="admpwd" value=""></p>
		<input type="submit" name="submit" value="Connexion">
	</form>
</div>
