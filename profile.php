<?php
include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keepername = $_SESSION['keepername'];
$keeperid = $_SESSION['keeperid'];
$keeperid2 = isset($_GET['keeperid']) ? $_GET['keeperid'] : "";
$profilename = '';
$profileabout = '';
$button = "";
$latestactivity = "";
$g = "";
$r = "";
$grade = "";
$chatmess = "";
$sendmessage = "";

if(!empty($_GET))
{
	
// Hämtar ut om användaren
	$profileinfo = <<<END

		SELECT keepername, fname, lname, about, other
		FROM user
		WHERE keeperid = '{$keeperid2}';
END;
	$res = $mysqli->query($profileinfo) or die();

	if($res->num_rows == 1)
	{
		$row = $res->fetch_object();
		$profilekeepername = $row->keepername;
		$profilename = $row->fname;
		$profilelastname = $row->lname;
		$profileabout = $row->about;
		$profileother = $row->other;

	}

// Hämtar ut senaste aktiviteterna för anvnändaren
$latestact = <<<END

	SELECT guidereviewinfo.grid, guidereviewinfo.title, guidereviewinfo.timestamp, guidereviewinfo.grade, userguidereview.grid
	FROM guidereviewinfo
	JOIN userguidereview
	ON guidereviewinfo.grid = userguidereview.grid
	WHERE keeperid = '{$keeperid2}'
	ORDER BY timestamp DESC
	
END;
$res = $mysqli->query($latestact) or die();

while($row = $res->fetch_object())
{
	$keeperid = $_SESSION['keeperid'];
	$grid = $row->grid;
	$title = utf8_decode(htmlspecialchars($row->title));
	$grade = $row->grade;
	$timestamp = strtotime($row->timestamp);
	$timestamp = date("d M Y H:i", $timestamp);

	$r = "R";
	$g = "G";

	if($grade > 0)
	{

		$latestactivity .= <<<END
		 
			<a href="genre.php?grid={$grid}">{$title}</a><li class="views">{$r}</li></br><br>
		

END;
	}
	else
	{

		$latestactivity .= <<<END
		 
			<a href="genre.php?grid={$grid}">{$title}</a><li class="views">{$g}</li></br><br>
		

END;
	}
	
}

// Lägger till "lägg till vän" knapp om man är inne på en annan användares profil
$button = <<<END
	<form method="post">
	<button type="submit" name="keeperfr" value="Lägg till">Lägg till vän</button>
	</form>
END;

// Skickar in vänförfrågan i databasen
if(isset($_POST['keeperfr'])){

	$query = <<<END
	INSERT INTO keeperfriend(keeperid, keeperid2, accept) 
	VALUES ('{$keeperid}', '{$keeperid2}', '');
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

}

$sendmessage = <<<END
	<button><a href="chatcom.php">Skicka meddelande</a></button>
END;
}







else
{
	
// Hämtar ut om användaren
$profileinfo = <<<END

	SELECT keepername, fname, lname, about, other
	FROM user
	WHERE keeperid = '{$keeperid}';
END;
	$res = $mysqli->query($profileinfo) or die();

	if($res->num_rows == 1)
	{
		$row = $res->fetch_object();
		$profilekeepername = $row->keepername;
		$profilename = $row->fname;
		$profilelastname = $row->lname;
		$profileabout = $row->about;
		$profileother = $row->other;

	}

// Hämtar ut senaste aktiviteterna för anvnändaren
$latestact = <<<END

	SELECT guidereviewinfo.grid, guidereviewinfo.title, guidereviewinfo.timestamp, guidereviewinfo.grade, userguidereview.grid
	FROM guidereviewinfo
	JOIN userguidereview
	ON guidereviewinfo.grid = userguidereview.grid
	WHERE keeperid = '{$keeperid}'
	ORDER BY timestamp DESC
	
END;
$res = $mysqli->query($latestact) or die();

while($row = $res->fetch_object())
{
	$keeperid = $_SESSION['keeperid'];
	$grid = $row->grid;
	$title = utf8_decode(htmlspecialchars($row->title));
	$grade = $row->grade;
	$timestamp = strtotime($row->timestamp);
	$timestamp = date("d M Y H:i", $timestamp);

	$r = "R";
	$g = "G";

	if($grade > 0)
	{

		$latestactivity .= <<<END
		 
			<a href="genre.php?grid={$grid}">{$title}</a><li class="views">{$r}</li></br><br>
		
END;
	}
	else
	{

		$latestactivity .= <<<END
		 
			<a href="genre.php?grid={$grid}">{$title}</a><li class="views">{$g}</li></br><br>
	
END;
	}
	
}

$query = <<<END
	SELECT chatcomid, reply, keeperid, keeperid2 FROM chatcom
	WHERE chatcom.keeperid = '{$keeperid}'
	OR chatcom.keeperid2 = '{$keeperid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
			while($row = $res->fetch_object())
			{

				$chatcomid = $row->chatcomid;
				$reply = $row->reply;
				$keeper = $row->keeperid;
				$keeper2 = $row->keeperid2;

				$chatmess .= <<<END
					<a href="chatcom.php?chatcomid={$chatcomid}">{$reply}</a><br>
					
END;
				
				
			}
		
	
	}

}

if(!empty($_POST))
{

	if(isset($_POST['friendmessage']))
	{
		$reply = $_POST['reply'];

		$query = <<<END

			INSERT INTO chatcom (keeperid, keeperid2, reply, timestamp, flag)
			VALUES ('{$keeperid}', '{$keeperid2}', '{$reply}', CURRENT_TIMESTAMP, '');
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
	}
	
}


$content = <<<END

		

				<div class="row margin-top-100">
			
					<div class="col-md-3 col-sm-3 pull-left">

	  					<div class="row profil margin-left-profile">
	  					
	  						<div class="column-left-top">
	  						<br>
	  					
	  							<p>Välkommen</p>
  	  					
  	  						</div>	  					
	  					
	  						<div class="column-left-center text-center">	  							
	  					
	  								<img src="images/profil_bild.png">	  							

	  							<p><b>{$profilekeepername}</b></p>
	  							{$button}
	  						</div>

	  						<div class="column-left-bottom text-center">

	  							{$sendmessage}

	  						<div class="latestmessage">
	  							<p>Senaste inläggen</p>
	  								{$chatmess}
	  						</div>


	  							<p>Sociala Medier</p>
	  							
	  							<p>Vanner</p>	  							

	  							</div><!-- col md 3>

	  							<p>Vänner</p>		

	  						</div><!-- column left bottom -->
						
						</div><!-- row -->

						</div>
						
						<div class="col-md-6 col-sm-6 panel-width-550px panel panel-default pull-left">

	  					<div class="panel-heading panel-heading-560px">Om mig <img src="images/pen.png" width="30px" class="pull-right"></div>


		  					<div class="panel-body">

			  					<p>Namn: {$profilename} {$profilelastname}</p> 
			  					{$profileabout}
			  						  			
		  					</div><!-- panel body -->

						</div><!-- panel heading -->

						<div class="col-md-3 col-sm-3 pull-right profil-right">

							<div class="ads profil-right pull-right">

		  					
							<!-- Reklam karusel -->
							
		  						<img src="http://placehold.it/290x290" class="ads">

		  						<br><br><br>

		  						<img src="http://placehold.it/290x290" class="ads">

		  					
							</div><!-- reklam kolumn -->

						</div><!-- col -->
					

					<div class="col-md-3 col-sm-3 ovrigt panel panel-default pull-left">

	  					<div class="panel-heading ovrigt-heading">Övrigt</div>

		  					<div class="panel-body">
 								{$profileother}
		  					</div>
						
						</div><!-- panel heading -->

						<div class="col-md-3 col-sm-3 aktiviteter panel panel-default pull-left margin-left-25px">

	  					<div class="panel-heading aktiviteter-heading">Aktiviteter</div>

		  					<div class="panel-body">
 
		  						<a href class="text-primary">{$latestactivity}</a>

		  					</div>
						
						</div><!-- panel heading -->



					
					</div><!-- kolumn 2 -->
					</div><!-- kolumn 2 -->

				</div><!-- row -->
<!-- NYA GREJER -->
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="guestbook">
							<form action="profile.php?keeperid={$keeperid2}" method="post">
								<label for="reply">Meddelande</label><br>
								<textarea id="reply" name="reply" cols="80" rows="15"></textarea></br>
								<input type="submit" id="submit" name="friendmessage" value="Skicka">
							</form>
						</div>
					</div>
				</div>


  
  
END;


echo $header;
echo $content;
echo $footer;
?>