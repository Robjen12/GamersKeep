<?php

include_once("inc/Connstring.php");
// Om get inte är tom så utförs if satsen
if(!empty($_GET['grid']))
{
	$grid = isset($_GET['grid']) ? $_GET['grid'] : "";
// Raderar artikeln kopplat till id:et
	$query = <<<END

		DELETE FROM guidereviewinfo
		WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
	header("Location: profile.php");

}
if(!empty($_GET['commentid']))
{
	$commentid = isset($_GET['commentid']) ? $_GET['commentid'] : "";
// Raderar kommetaren kopplad till guiden/recensionen
	$query = <<<END

		DELETE FROM comment
		WHERE commentid = '{$commentid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
	header("Location: profile.php");

}

if(isset($_GET['keeperid']))
{

	$keeperid = isset($_GET['keeperid']) ? $_GET['keeperid'] : "";
// Hämtar ut alla recensioner/guider från en användare
	$query = <<<END
		SELECT * 
		FROM userguidereview
		JOIN guidereviewinfo 
		ON userguidereview.grid = guidereviewinfo.grid
		JOIN user
		ON userguidereview.keeperid = user.keeperid
		WHERE user.keeperid = '{$keeperid}';

END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		if($row = $res->fetch_object())
		{
			$grid = $row->grid;

// Tar bort alla guider och recensioner kopplade till användaren		
			$query = <<<END

				DELETE FROM userguidereview,user,guidereviewinfo
				USING userguidereview
  				LEFT JOIN user
    			ON userguidereview.keeperid = user.keeperid
  				LEFT JOIN guidereviewinfo
    			ON userguidereview.grid = guidereviewinfo.grid
				WHERE userguidereview.keeperid = '{$keeperid}';
				

END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
// Tar bort alla meddelanden kopplat till användadren
				$query = <<<END
				DELETE FROM message
				WHERE message.keeperid = '{$keeperid}' 
				OR message.keeperid2 = '{$keeperid}'
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
// Tar bort alla vänner koppladt till användaren
				$query = <<<END
				DELETE FROM keeperfriend
				WHERE keeperfriend.keeperid = '{$keeperid}'
				OR keeperfriend.keeperid2 = '{$keeperid}'
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);


	 header("Location: login.php");

		}
		
	}
	else
		{
// Tar bort alla meddelanden kopplat till användadren			
			$query = <<<END
				DELETE FROM message
				WHERE message.keeperid = '{$keeperid}' 
				OR message.keeperid2 = '{$keeperid}'
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
// Tar bort alla vänner kopplat till användadren
			$query = <<<END
				DELETE FROM keeperfriend
				WHERE keeperfriend.keeperid = '{$keeperid}'
				OR keeperfriend.keeperid2 = '{$keeperid}'
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
// Tar bort användaren
			$query = <<<END
				DELETE FROM user WHERE user.keeperid = '{$keeperid}'
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
			  " : " . $mysqli->error);

	  	header("Location: login.php");
		}

}
?>