<?php

include_once("inc/Connstring.php");

if(!empty($_GET))
{
	$grid = isset($_GET['grid']) ? $_GET['grid'] : "";

	$query = <<<END

		DELETE FROM guidereviewinfo
		WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
	header("Location: profile.php");
}
	
?>