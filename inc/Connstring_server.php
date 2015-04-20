<?php

$mysqli = new mysqli('gamerskeep-116448.mysql.binero.se', '116448_xp33655', 'gameteam15', '116448-gamerskeep');

if(mysqli_connect_error()){
	echo "Connect failed: " . mysqli_connect_error() . "<br>";
	exit();
}
$mysqli->set_charset("utf8");
?>
