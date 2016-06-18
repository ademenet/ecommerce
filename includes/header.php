<?php session_start();

if (isset($_GET['action'])) {
	if ($_GET['action'] === 'logout') {
		$_SESSION['user'] = "";
		$_SESSION['admin'] = "";
		header('Location: index.php');
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/master.css">
		<link href='https://fonts.googleapis.com/css?family=Monofett' rel='stylesheet' type='text/css'>
		<title>&#10084 games</title>
	</head>
	<header>
		<nav>
			<div class="logo">
				<a href="index.php">&#10084 games</a>
			</div>
			<ul class="menu">
				<li><a href="index.php">Accueil</a></li>
				<li><a href="boutique.php">Boutique</a></li>
				<li><a href="panier.php">Panier</a></li>
				<?php if ($_SESSION['user'] == 1) { ?>
				<li><a href="compte.php">Mon compte</a></li>
				<li><a href="?action=logout">Log out</a></li>
				<?php } elseif ($_SESSION['admin'] == 1) { ?>
					<li><a href="admin.php">Admin</a></li>
					<li><a href="?action=logout">Log out</a></li>
				<?php }
				else { ?>
				<li><a href="inscription.php">Inscription</a></li>
				<li><a href="login.php"; ?>Connexion</a></li>
				<?php } ?>
			</ulclass>
		</nav>
	</header>
	<div class="page-wrap">
