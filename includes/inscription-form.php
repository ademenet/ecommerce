<!-- Formulaire de modification des users -->
<?php
	if ($_GET['admact'] == 'modusr') {
		if ($_POST['submit'] == 'Valider') {
			if ($_POST['usrlog'] && $_POST['usrprenom'] && $_POST['usrnom'] && $_POST['usraddress'] && $_POST['usrmail'] && $_POST['usrpwd']) {
				if (!filter_var($_POST['usrmail'], FILTER_VALIDATE_EMAIL)) {
					alert("Le format de votre mail n'est pas valide");
				} else {
					if ($_POST['usrlog'] === $_SESSION['adminmodifyuser']['login'] || check_user(secu($_POST['usrlog']))) {
						if (mod_user(secu(secu($_SESSION['adminmodifyuser']['login']), $_POST['usrlog']), secu($_POST['usrpwd']), secu($_POST['usrprenom']), secu($_POST['usrnom']), secu($_POST['usrtel']), secu($_POST['usrmail']), secu($_POST['usraddress']), secu($_POST['usradmin'])) === FALSE) {
							alert("Oups, un problème s'est produit. Veuillez recommencer !");
						} else {
							valid("Vous venez de modifier ".$_POST['usrlog']);
							echo "<script>setTimeout(\"document.location.href = 'admin.php';\",2000);</script>";
						}
					} else {
						alert("Votre nom d'utilisateur n'est pas disponible");
					}
				}
			} else {
				alert("Veuillez remplir tous les champs obligatoires (*)");
			}
		}
?>
<div class="login-form">
	<h1>Modification</h1>
	<form action="" method="POST">
		<label>login (*) :<input type="text" name="usrlog" value="<?php echo $_SESSION['adminmodifyuser']['login']; ?>"></label>
		<label>prénom (*) :<input type="text" name="usrprenom" value="<?php echo $_SESSION['adminmodifyuser']['prenom']; ?>"></label>
		<label>nom (*) :<input type="text" name="usrnom" value="<?php echo $_SESSION['adminmodifyuser']['nom']; ?>"></label>
		<label>adresse (*) :<input type="text" name="usraddress" value="<?php echo $_SESSION['adminmodifyuser']['adresse']; ?>"></label>
		<label>téléphone :<input type="text" name="usrtel" value="<?php echo $_SESSION['adminmodifyuser']['telephone']; ?>"></label>
		<label>mail (*) :<input type="text" name="usrmail" value="<?php echo $_SESSION['adminmodifyuser']['mail']; ?>"></label>
		<label>mot de passe (*) :<input type="password" name="usrpwd" value=""></label>
		<label><input type="radio" name="usradmin" value="user" checked> Simple user</br></label>
		<label><input type="radio" name="usradmin" value="admin"> Super admin</br></label>
		<input type="submit" name="submit" value="Valider">
	</form>
	</br><p>Attention, veuillez retaper le mot de passe</p>
</div>


<!-- Affiche ce formulaire si ce n'est pas l'admin qui modifie un user -->
<?php } elseif ($_GET['action'] == 'moduser') {
	if ($_POST['submit'] == 'Valider') {
		if ($_POST['usrlog'] && $_POST['usrprenom'] && $_POST['usrnom'] && $_POST['usraddress'] && $_POST['usrmail'] && $_POST['usrpwd']) {
			if (!filter_var($_POST['usrmail'], FILTER_VALIDATE_EMAIL)) {
				alert("Le format de votre mail n'est pas valide");
			} else {
				if ($_POST['usrlog'] === $_SESSION['userinfo']['login'] || check_user(secu($_POST['usrlog'])))
				{
					if ($_SESSION['userinfo']['admin'] == 1) {
						$adm = 'admin';
					} elseif ($_SESSION['userinfo']['admin'] == 0) {
						$adm = 'user';
					}
					if (mod_user(secu($_SESSION['userinfo']['login']), secu($_POST['usrlog']), secu($_POST['usrpwd']), secu($_POST['usrprenom']), secu($_POST['usrnom']), secu($_POST['usrtel']), secu($_POST['usrmail']), secu($_POST['usraddress']), 'user') === FALSE) {
						alert("Oups, un problème s'est produit. Veuillez recommencer !");
					} else {
						valid($_SESSION['userinfo']['login']." : vous venez de modifier vos informations");
						echo "<script>setTimeout(\"document.location.href = 'account.php';\",2000);</script>";
					}
				}
				else {
					alert("Votre nom d'utilisateur n'est pas disponible");
				}
			}
		} else {
			alert("Veuillez remplir tous les champs obligatoires (*)");
		}
	}
?>
<div class="login-form">
	<h1>Modification</h1>
	<form action="" method="POST">
		<label>login (*) :<input type="text" name="usrlog" value="<?php echo $_SESSION['userinfo']['login']; ?>"></label>
		<label>prénom (*) :<input type="text" name="usrprenom" value="<?php echo $_SESSION['userinfo']['prenom']; ?>"></label>
		<label>nom (*) :<input type="text" name="usrnom" value="<?php echo $_SESSION['userinfo']['nom']; ?>"></label>
		<label>adresse (*) :<input type="text" name="usraddress" value="<?php echo $_SESSION['userinfo']['adresse']; ?>"></label>
		<label>téléphone :<input type="text" name="usrtel" value="<?php echo $_SESSION['userinfo']['telephone']; ?>"></label>
		<label>mail (*) :<input type="text" name="usrmail" value="<?php echo $_SESSION['userinfo']['mail']; ?>"></label>
		<label>mot de passe (*) :<input type="password" name="usrpwd" value=""></label>
		<input type="submit" name="submit" value="Valider">
	</form>
	</br><p>Attention, veuillez retaper le mot de passe</p>
</div>

<?php } else { ?>
<div class="login-form">
	<h1>Inscription</h1>
	<form action="" method="POST">
		<label>login (*) :<input type="text" name="usrlog" value=""></label>
		<label>prénom (*) :<input type="text" name="usrprenom" value=""></label>
		<label>nom (*) :<input type="text" name="usrnom" value=""></label>
		<label>adresse (*) :<input type="text" name="usraddress" value=""></label>
		<label>téléphone :<input type="text" name="usrtel" value=""></label>
		<label>mail (*) :<input type="text" name="usrmail" value=""></label>
		<label>mot de passe (*) :<input type="password" name="usrpwd" value=""></label>
		<input type="submit" name="submit" value="Valider">
	</form>
</div>
<?php } ?>
