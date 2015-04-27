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
if(isset($_GET['keeperid']))
{

	$keeperid = isset($_GET['keeperid']) ? $_GET['keeperid'] : "";

	$query = <<<END

		DELETE FROM user
		WHERE keeperid = '{$keeperid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	 header("Location: login.php");
}
?>