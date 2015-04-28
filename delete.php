<?php

include_once("inc/Connstring.php");

if(!empty($_GET['grid']))
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
		SELECT * FROM user, guidereviewinfo, userguidereview, comment WHERE user.keeperid = '{$keeperid}';

END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		if($row = $res->fetch_object())
		{
			$grid = $row->grid;

			$query = <<<END

				DELETE FROM userguidereview,user,guidereviewinfo
				USING userguidereview
  				LEFT JOIN user
    			ON userguidereview.keeperid = user.keeperid
  				LEFT JOIN guidereviewinfo
    			ON userguidereview.grid = guidereviewinfo.grid
				WHERE user.keeperid = '{$keeperid}';

END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);



	 header("Location: login.php");

		}
	}
}
?>