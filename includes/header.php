<?php
session_start();
include('includes/functions.php');
if (isset($_GET['action'])) {
	if ($_GET['action'] === 'logout') {
		$_SESSION['userinfo'] = "";
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
		<title>we&#10084games</title>
	</head>
	<body>
		<header>
			<nav>
				<div class="logo">
					<a href="index.php">we&#10084games</a>
				</div>
				<ul class="menu">
						<li><a href="index.php">Accueil</a></li>
						<li><a href="panier.php">Panier</a></li>
					<?php if ($_SESSION['userinfo'] !== "") { ?>
						<li><a href="account.php">Mon compte</a></li>
						<?php if ($_SESSION['userinfo']['admin'] == 1) { ?>
						<li><a href="admin.php">Admin</a></li>
						<?php } ?>
						<li><a href="?action=logout">Log out</a></li>
					<?php } else { ?>
						<li><a href="inscription.php">Inscription</a></li>
						<li><a href="login.php"; ?>Connexion</a></li>
					<?php } ?>
						<li style="float:right;"><a href="panier.php">Nombre article : <?php echo get_nb_article() ?> Prix : <?php echo  get_price()?> £</a></li>
				</ul>
			</nav>
		</header>
		<div class="page-wrap">
