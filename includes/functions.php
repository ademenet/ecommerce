<?php
function get_nb_article(){
	if (!isset($_SESSION['panier']))
		return 0;
	$count = 0;
	foreach($_SESSION['panier'] as $article)
	{
		$count += $article['quantity'];
	}
	return $count;
}
function get_price()
{
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$prix_total = 0;
		if (isset($_SESSION['panier'])) {
			foreach($_SESSION['panier'] as $article)
			{
				$query = "SELECT * FROM jeux WHERE nom = \"".$article['name']."\"";
				$ret = mysqli_query($base, $query);
				$donne = mysqli_fetch_array($ret);
				$prix_total += $donne['prix'] * $article['quantity'];
			}
		}
	return $prix_total;
}
function secu($string) {
	if(ctype_digit($string)) {
		$string = intval($string);
	}
	else {
		$base = mysqli_connect('localhost', 'root', '', 'myDB');
		$string = mysqli_real_escape_string($base, $string);
		$string = addcslashes($string, '%_');
	}
	return $string;
}

function ft_error($err='') {
	$mess = ($err != '') ? $err : "Une erreur inédite s'est produite.";
	exit ('<p>'.$mess.'</p><p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p>');
}

function alert($msg) {
	if ($msg) {
		echo "<div class=\"box-alert\">". $msg ."</div>";
	}
}

function valid($msg) {
	if ($msg) {
		echo "<div class=\"box-valid\">". $msg ."</div>";
	}
}

function add_product($name, $price, $desc, $ps4, $xbox, $gamecube, $ds, $img, $genre, $stock)
{
	if (!isset($name) || !isset($price) || !isset($stock))
		return;
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$row = mysqli_query($base, "SELECT * FROM jeux");
	$id = mysqli_num_rows($row) + 1;
	$query = "INSERT INTO jeux VALUES('".secu($id). "','" .secu($name). "','".secu($stock)."','".secu($price). "','NULL','".secu($ps4)."','".secu($xbox). "','".secu($gamecube)."','".secu($ds). "','".secu($desc). "','".secu($genre). "','".secu($img)."')";
	mysqli_query($base, $query);
}

function mod_user($oldlogin, $login, $passwd, $prenom, $nom, $tel, $mail, $adr, $admin) {
	if (isset($login) && isset($passwd) && isset($prenom) && isset($nom) && isset($mail) && isset($adr) && isset($admin)) {
		if ($admin == "admin") {
			$admin = 1;
		} elseif ($admin == "user") {
			$admin = 0;
		}
		$passwd = hash('whirlpool', $passwd);
		$base = mysqli_connect('localhost', 'root', '', 'myDB');
		$query = "UPDATE user SET login='$login', passwd='$passwd', prenom='$prenom', nom='$nom', telephone='$tel', mail='$mail', adresse='$adr', admin='$admin' WHERE login='$oldlogin'";
		return mysqli_query($base, $query);
	} else {
		return FALSE;
	}
}

function add_user($login, $passwd, $prenom, $nom, $tel, $mail, $adr) {
	if (isset($login) && isset($passwd) && isset($prenom) && isset($nom) && isset($mail) && isset($adr)) {
		$passwd = hash('whirlpool', $passwd);
		$base = mysqli_connect('localhost', 'root', '', 'myDB');
		$query = "INSERT INTO user VALUES ('".$login."','".$passwd."','".$prenom."','".$nom."','".$tel."','".$mail."','".$adr."', '0', '')";
		return mysqli_query($base, $query);
	} else {
		return FALSE;
	}
}

function check_user($login) {
	if (isset($login)) {
		$base = mysqli_connect('localhost', 'root', '', 'myDB');
		$search = mysqli_query($base, "SELECT login FROM user WHERE login = '$login'");
		$row = mysqli_num_rows($search);
		if ($row >= 1) {
			return FALSE;
		} else {
			return TRUE;
		}
	} else {
		return FALSE;
	}
}

function check_login($login) {
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$search = mysqli_query($base, "SELECT login FROM user WHERE login = '$login'");
	while($data = mysqli_fetch_assoc($search)) {
		if ($data['login'] === $login) {
			return TRUE;
		}
	}
	mysqli_free_result($search);
	return FALSE;
}

function check_passwd($login, $passwd) {
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$search = mysqli_query($base, "SELECT passwd FROM user WHERE login = '$login'");
	$passwd = hash('whirlpool', $passwd);
	$data = mysqli_fetch_assoc($search);
	if ($data['passwd'] === $passwd) {
		return TRUE;
	}
	mysqli_free_result($search);
	return FALSE;
}

function get_userinfos($login) {
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$search = mysqli_query($base, "SELECT * FROM user WHERE login = '$login'");
	$data = mysqli_fetch_assoc($search);
	mysqli_free_result($search);
	return $data;
}

function del_user($login) {
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$search = mysqli_query($base, "DELETE FROM user WHERE login = '$login'");
	return TRUE;
}

function rm_product($name)
{
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$query = "DELETE FROM jeux WHERE nom = \"".$name."\";";
	$result = mysqli_query($base, $query);
}

function verifie_cons($cons)
{
	foreach (explode(":", $_POST['platform']) as $plat)
	{
		if ($plat === $cons)
			return 1;
	}
	return 0;
}

function inscription_user() {
	if ($_POST['submit'] === "Valider" && ($_SESSION['userinfo'] == "" || $_SESSION['userinfo']['admin'] == 1)) {
		if ($_POST['usrlog'] && $_POST['usrprenom'] && $_POST['usrnom'] && $_POST['usraddress'] && $_POST['usrmail'] && $_POST['usrpwd'])
		{
			if (!filter_var($_POST['usrmail'], FILTER_VALIDATE_EMAIL)) {
				alert("Le format de votre mail n'est pas valide");
			} else {
				if (check_user(secu($_POST['usrlog']))) {
					if (add_user(secu($_POST['usrlog']), secu($_POST['usrpwd']), secu($_POST['usrprenom']), secu($_POST['usrnom']), secu($_POST['usrtel']), secu($_POST['usrmail']), secu($_POST['usraddress'])) == FALSE) {
						alert("Oups, we have a problem here");
					} else {
						if ($_SESSION['userinfo'] !== "" && $_SESSION['userinfo']['admin'] == 1) {
							valid("Vous venez d'ajouter ".$_POST['usrlog']." sur &#10084 games");
							echo "<script>setTimeout(\"document.location.href = 'admin.php';\",2000);</script>";
						} else {
							$_SESSION['userinfo'] = get_userinfos(secu($_POST['usrlog']));
							valid("Bienvenue ".$_SESSION['userinfo']['login']." sur &#10084 games");
							echo "<script>setTimeout(\"document.location.href = 'index.php';\",2000);</script>";
						}
					}
				} else {
					alert("Votre nom d'utilisateur n'est pas disponible");
				}
			}
		} else {
			alert("Veuillez remplir tous les champs obligatoires (*)");
		}
	}
}

function display_users_for_admin_modify_delete($login) {
	$base = mysqli_connect('localhost', 'root', '', 'myDB');
	$search = mysqli_query($base, "SELECT * FROM user WHERE NOT login = '$login'");
	while($data = mysqli_fetch_assoc($search)) {
		echo "<table><tr>";
		echo "<td>" . $data['login'] . "</td>";
		if ($data['admin'] == 1)
			echo "<td>admin</td>";
		else
			echo "<td>user</td>";
		echo "<td><a href=\"?admact=delusr&login=" . $data['login'] . "\">supprimer</a></td>";
		echo "<td><a href=\"?admact=modusr&login=" . $data['login'] . "\">mofidier</a></td>";
		echo "</tr></table>";
	}
}
 ?>
