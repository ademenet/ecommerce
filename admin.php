<?php
require_once('./includes/header.php');
inscription_user();
 ?>

<div class="admin-panel">
	<h1>Bienvenue <?php echo $_SESSION['userinfo']['login']; ?></h1>
	<div class="">

<?php
if ($_SESSION['userinfo']['admin'] !== "") {
	if (isset($_GET['admact'])) {
		if ($_GET['admact'] == 'delusr') {
			if (!del_user(secu($_GET['login'])))
				alert("Une erreur est survenue lors de la suppression de l'user");
			else {
				valid("Vous venez de tuer " . $_GET['login'] . "...");
				echo "<script>setTimeout(\"document.location.href = 'admin.php';\",2000);</script>";
			}
		} elseif ($_GET['admact'] == 'modusr') {
			$_SESSION['adminmodifyuser'] = get_userinfos(secu($_GET['login']));
			include('./includes/inscription-form.php');
		} else {
			alert("Une erreur est survenue");
		}
	}
	if (isset($_GET['action'])) {
		if ($_GET['action'] == addusr) {
			include('./includes/inscription-form.php');
		} elseif ($_GET['action'] == modifyusr || $_GET['action'] == deleteusr) {
			display_users_for_admin_modify_delete($_SESSION['userinfo']['login']);
		} else {
			ft_error();
		}
	}
} else {
	header('Location: ../index.php');
}
 ?>
		<a href="ajouter_article.php">Ajouter un produit</a>
		<a href="rm_add.php">Modifier un produit</a>
		<a href="rm_add.php">Supprimer un produit</a>
		<?php require_once('./admin-users.php') ?>
	</div>
</div>

<?php require_once('./includes/footer.php'); ?>
