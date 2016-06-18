<?php
// Cette fonction prend un texte en parametre et retourne un message d'erreur.
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
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
	$row = mysqli_query($base, "SELECT * FROM jeux");
	$id = mysqli_num_rows($row) + 1;
	$query = "INSERT INTO jeux VALUES('".$id. "','" . $name . "','".$stock."','". $price. "','NULL','". $ps4."','".$xbox. "','".$gamecube."','". $ds . "','". $desc. "','". $genre . "','". $img."')";
	mysqli_query($base, $query);
}

function add_user($login, $passwd, $prenom, $nom, $tel, $mail, $adr) {
	if (isset($login) && isset($passwd) && isset($prenom) && isset($nom) && isset($mail) && isset($adr)) {
		$passwd = hash('whirlpool', $passwd);
		$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
		$query = "INSERT INTO user VALUES ('".$login."','".$passwd."','".$prenom."','".$nom."','".$tel."','".$mail."','".$adr."', '0')";
		mysqli_query($base, $query);
	} else {
		return;
	}
}

function check_user($login) {
	if (isset($login)) {
		$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
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

// les fonctions check_login et check_passwd renvoient TRUE si le mot de passe ou le login user n'existe pas ou est errone et FALSE sinon.
function check_login($login) {
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
	$search = mysqli_query($base, "SELECT login FROM user WHERE login = '$login'");
	while($data = mysqli_fetch_assoc($search)) {
		if ($data['login'] === $login) {
			return FALSE;
		}
	}
	mysqli_free_result($search);
	return TRUE;
}

function check_passwd($passwd) {
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
	$search = mysqli_query($base, "SELECT passwd FROM user WHERE 1");
	$passwd = hash('whirlpool', $passwd);
	while($data = mysqli_fetch_assoc($search)) {
		if ($data['passwd'] === $passwd) {
			return FALSE;
		}
	}
	mysqli_free_result($search);
	return TRUE;
}

function check_admin($login) {
	// $base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
	// $search = mysqli_query($base, "SELECT login FROM user WHERE login = '$login'");
	// while($data = mysqli_fetch_assoc($search)) {
	// 	if ($data === $login) {
	// 		echo "FALSE!";
	// 		return FALSE;
	// 	}
	// }
	// mysqli_free_result($search);
	return TRUE;
}

function rm_product($name)
{
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
	$query = "DELETE FROM jeux WHERE nom = \"".$name."\";";
	$result = mysqli_query($base, $query);
/*	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<br />";
		print_r($row);
	}
 */
}
 ?>
