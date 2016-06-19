<?php
$create_table_game = "CREATE TABLE jeux
	(
		id INT,
		nom VARCHAR(100),
		stock INT,
		prix FLOAT,
		platform VARCHAR(100),
		ps4 BOOLEAN,
		xboxone BOOLEAN,
		gamecube BOOLEAN,
		ds BOOLEAN,
		description VARCHAR(100),
		genre VARCHAR(100),
		img VARCHAR(500)
	)";

$create_table_user = "CREATE TABLE user
	(
		login VARCHAR(100),
		passwd VARCHAR(500),
		prenom VARCHAR(100),
		nom VARCHAR(100),
		telephone VARCHAR(100),
		mail VARCHAR(500),
		adresse VARCHAR(200),
		admin BOOLEAN
	)";

$create_gloabal = "CREATE TABLE global
	(
		conf VARCHAR(200)
	)";

$insert_game = "INSERT INTO jeux (id, nom, stock, prix, ps4, xboxone, gamecube, ds, description, img, genre) VALUES
	('1', 'FIFA 16', '50', '70', '1' , '1', '0', '1', 'bon jeux de sport', 'img/11693-1.jpg', 'sport'),
	('2', '07 Legends', '50', '35', '1' , '1', '0', '0', 'bon jeux de tir', 'img/11693-1.jpg', 'shoot'),
	('3', 'Alice: Madness Returns', '50', '35', '1' , '1', '0', '0', 'bon jeux de merde', 'img/10893-1.jpg', 'aventure'),
	('4', 'Batman: Arkham City', '50', '35', '1' , '1', '0', '0', 'bon jeux de merde', 'img/', 'aventure'),
	('5', 'Bomberman', '50', '35', '1' , '1', '0', '0', 'bon jeux de merde', 'img/20902-1.jpg', 'arcade'),
	('6', 'Brave: The Video Game', '50', '35', '1' , '1', '0', '0', 'bon jeux de merde', 'img/18310-1.jpg', 'arcade'),
	('7', 'The Simpsons: Hit et Run', '50', '35', '1' , '1', '0', '0', 'bon jeux de merde', 'img/8552-1.jpg', 'aventure:arcade'),
	('8', 'Wario World', '50', '35', '0' , '0', '0', '1', 'bon jeux de merde', 'img/2327-1.jpg', 'arcade'),
	('9', 'Wallace et Gromit in Project Zoo', '50', '35', '0' , '0', '1', '1', 'bon jeux de merde', 'img/30934-1.jpg', 'aventure'),
	('11', 'Skyrim', '50', '35', '0' , '0', '1', '1', 'bon jeux', 'img/sky.jpg', 'aventure'),
	('12', 'Snoopy La belle Aventure', '50', '35', '0' , '0', '1', '1', 'bon jeux', 'img/snoop.jpg', 'aventure:arcade'),
	('13', 'Bob : vengeance robot', '50', '35', '0' , '0', '1', '1', 'bon jeux', 'img/rob.jpg', 'aventure:arcade'),
	('10', 'Skate 3', '50', '35', '0' , '0', '1', '1', 'bon jeux de skate', 'img/skate.jpg', 'sport')";

$insert_genre = "INSERT INTO global VALUES('arcade:aventure:sport')";

$admpwd = hash('whirlpool', "123");

$insert_admin = "INSERT INTO user (login, passwd, prenom, nom, telephone, mail, adresse, admin) VALUES
	('admin','".$admpwd."','','','','','', '1')";

$base = mysqli_connect('localhost', 'root', '');
mysqli_query($base, "CREATE DATABASE myDB");
mysqli_close($base);
$base = mysqli_connect('localhost', 'root', '', 'myDB');
mysqli_query($base, $create_table_game);
mysqli_query($base, $create_gloabal);
mysqli_query($base, $create_table_user);
$ret = mysqli_query($base, $insert_game);
$ret += mysqli_query($base, $insert_admin);
$ret += mysqli_query($base, $insert_genre);
if ($ret == 3) {
	echo "Installation réussie\n";
} else {
	echo "Un problème est survenue durant l'installation\n";
}
?>
