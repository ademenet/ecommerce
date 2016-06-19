<?php require_once('includes/header.php'); ?>

<?php
if (isset($_GET['action'])) {
	if ($_GET['action'] == 'deluser') {
		echo "<script>confirm(\"Êtes-vous sûr de vouloir supprimer votre compte ?\")</script>";
		echo "<script>setTimeout(\"document.location.href = 'index.php';\",2000);</script>";
		del_user($_SESSION['userinfo']['login']);
		$_SESSION['userinfo'] = "";
	} elseif ($_GET['action'] == 'moduser') {
		include('./includes/inscription-form.php');
	}
}
 ?>

<body>
	<?php if ($_SESSION['userinfo'] != "") { ?>
	<div class="user-account">
		<h3>Administration du compte de <?php echo $_SESSION['userinfo']['login'] ?></h3>
		<table>
			<tr>
				<td>Nom</td>
				<td><?php echo $_SESSION['userinfo']['nom']; ?></td>
			</tr>
			<tr>
				<td>Prénom</td>
				<td><?php echo $_SESSION['userinfo']['prenom']; ?></td>
			</tr>
			<tr>
				<td>Mail</td>
				<td><?php echo $_SESSION['userinfo']['mail']; ?></td>
			</tr>
			<tr>
				<td>Adresse</td>
				<td><?php echo $_SESSION['userinfo']['adresse']; ?></td>
			</tr>
			<tr>
				<td>Téléphone</td>
				<td><?php echo $_SESSION['userinfo']['telephone']; ?></td>
			</tr>
		</table>
		<?php if ($_SESSION['userinfo']['admin'] != 1) {
				echo "<p><a href=\"?action=deluser\">Supprimer mon compte</a></p>";
			}
			echo "<p><a href=\"?action=moduser\">Modifier mon compte</a></p>";
		} ?>
	</div>
</body>

<?php require_once('includes/footer.php'); ?>
