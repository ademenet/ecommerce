<?php

function security_check($string) {
	if(ctype_digit($string)) {
		$string = intval($string);
	}
	else {
		$string = mysql_real_escape_string($string);
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

function check_login($login) {
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
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
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
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
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
	$search = mysqli_query($base, "SELECT * FROM user WHERE login = '$login'");
	$data = mysqli_fetch_assoc($search);
	mysqli_free_result($search);
	return $data;
}

function del_user($login) {
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
	$search = mysqli_query($base, "DELETE FROM user WHERE login = '$login'");
	return TRUE;
}

function rm_product($name)
{
	$base = mysqli_connect('localhost', 'root', 'peer2peer', 'myDB');
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
 ?>
