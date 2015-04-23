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
$penbutton = "";
$penbutton2 = "";
$formabout = "";
$formother = "";

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
/*if(isset($_POST['keeperfr'])){

	$query = <<<END
	INSERT INTO keeperfriend(keeperid, keeperid2, accept) 
	VALUES ('{$keeperid}', '{$keeperid2}', '');
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

}*/

$sendmessage = <<<END
	<button><a href="chatcom.php?keeperid={$keeperid2}">Skicka meddelande</a></button>
END;
}







// Hämtar ut all information om ens egen profil
else
{
	$penbutton = <<<END
	<a href="#"><img src="images/pen.png" width="30px" id="pen" class="pull-right" title="Redigera"></a>
END;
	$penbutton2 = <<<END
	<a href="#"><img src="images/pen.png" width="30px" id="pen2" class="pull-right" title="Redigera"></a>
END;

	$formabout = <<<END

		<form action="profile.php" method="post" id="updateform">
			<textarea id="updateinfo" name="updateinfo" cols="60" row="10">{$profileabout}</textarea>
			<input type="submit" id="submit" name="update" value="Uppdatera info">
		</form>
END;

	$formother = <<<END

		<form action="profile.php" method="post" id="updateformother">
			<textarea id="updateother" name="updateother" cols="30" row="10">{$profileabout}</textarea>
			<input type="submit" id="submit" name="updateothers" value="Uppdatera info">
		</form>
END;

if(isset($_POST['update']))
{
	$about = $_POST['updateinfo'];
	$query = <<<END

		UPDATE user SET about ='$about'
		WHERE keeperid = '{$keeperid}'
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}
if(isset($_POST['updateothers']))
{
	$other = $_POST['updateother'];

	$query = <<<END

		UPDATE user SET other = '$other'
		WHERE keeperid = '{$keeperid}';
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}
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
		 
			<a href="genre.php?grid={$grid}">{$title}</a><li class="views">{$r}
			<button class=delete><a href="delete.php?grid={$grid}">x</a></button>
			<button class=edit><a href="guide_review_edit.php?grid={$grid}">pen</a></button></li></br><br>
			
END;
	}
	else
	{

		$latestactivity .= <<<END
		 
			<a href="genre.php?grid={$grid}">{$title}</a><li class="views">{$g} 
			<button class=delete><a href="delete.php?grid={$grid}">x</a></button>
			<button class=edit><a href="guide_review_edit.php?grid={$grid}">pen</a></button></li></br><br>
		
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
	  							{$sendmessage}
	  						</div>

	  						<div class="column-left-bottom text-center">

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

	  					<div class="panel-heading panel-heading-560px">Om mig {$penbutton}</div>


		  					<div class="panel-body">

			  					<p>Namn: {$profilename} {$profilelastname}</p> 
			  					{$profileabout}
			  						
			  					{$formabout}


		  					</div><!-- panel body -->

						</div><!-- panel heading -->

						<div class="col-md-3 col-sm-3 pull-right profil-right">

							<div class="ads profil-right pull-right">

		  					
							<!-- Reklam karusel -->
							
		  						<<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

		  						<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

		  					
							</div><!-- reklam kolumn -->

						</div><!-- col -->
					

					<div class="col-md-3 col-sm-3 ovrigt panel panel-default pull-left">

	  					<div class="panel-heading ovrigt-heading">Övrigt {$penbutton2}</div>

		  					<div class="panel-body">
 								{$profileother}
 								{$formother}
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
<script>
$(document).ready(function(){
	$('#updateform').hide();
		$('#pen').click(function(){
			$('#updateform').show();
		});
});

</script>

<script>
$(document).ready(function(){
	$('#updateformother').hide();
		$('#pen2').click(function(){
			$('#updateformother').show();
		});
});

</script>
  
END;


echo $header;
echo $content;
echo $footer;
?>