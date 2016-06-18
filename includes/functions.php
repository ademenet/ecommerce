<?php
// Cette fonction prend un texte en parametre et retourne un message d'erreur.
function ft_error($err='') {
	$mess = ($err != '') ? $err : "Une erreur inédite s'est produite.";
	exit ('<p>'.$mess.'</p><p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p>');
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
