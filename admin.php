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
		if ($_GET['action'] == 'add') {
			if (isset($_POST['submit'])) {
				if ($_POST['title'] && $_POST['desc'] && $_POST['price']) {
					add_product($_POST['title'], $_POST['price'], $_POST['desc'],0,0,0,1,"../zbri","foot", 42);
				} else {
					echo "PAS OK\n";
				}
			}
 ?>

<form action="" method="POST">
	<p>Nom du produit : <input type="text" name="title" value=""></p><br />
	<p>Description : <input type="text" name="desc" value=""></p><br />
	<p>Prix : <input type="text" name="price" value=""></p>
	<input type="submit" name="Ajouter" value="OK">
</form>

<?php
		}
		elseif ($_GET['action'] == modify) {

		}
		elseif ($_GET['action'] == delete) {
			if ($_POST['delete'] == "OK" && isset($_POST['deleted_game']))
			{
				rm_product($_POST['deleted_game']);
			}

?>
	<form action="" method="post">
		<p>Nom du produit a supprimer : <input type="text" name="deleted_game" value="Barbie land" /></p>
		<input type="submit" name="delete" value="OK" />
	</form>
<?php
		}
		elseif ($_GET['action'] == addusr) {
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
		<a href="?action=add">Ajouter un produit</a>
		<a href="?action=modify">Modifier un produit</a>
		<a href="?action=delete">Supprimer un produit</a>
		<?php require_once('./admin-users.php') ?>
	</div>
</div>

<?php require_once('./includes/footer.php'); ?>
