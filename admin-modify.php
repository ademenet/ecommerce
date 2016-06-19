<?php
	if ($_GET['action'] === "modifyusr") {
		display_users_for_admin_modify_delete($_SESSION['userinfo']['login']);
	} elseif ($_GET['action'] === "delusr") {
		echo "<script>confirm(\"Êtes-vous sûr de vouloir supprimer ce compte ?\")</script>";
		del_user(secu($_GET['login']));
	}
 ?>
