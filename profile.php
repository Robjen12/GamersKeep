<?php
include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keepername = $_SESSION['keepername'];
$keeperid = $_SESSION['keeperid'];
$profilename = '';
$profileabout = '';

// Hämtar ut om användaren
$profileinfo = <<<END

	SELECT fname, lname, about
	FROM user
	WHERE keepername = '{$keepername}';
END;
$res = $mysqli->query($profileinfo) or die();

if($res->num_rows == 1){
	$row = $res->fetch_object();
	$profilename = $row->fname;
	$profilelastname = $row->lname;
	$profileabout = $row->about;

}

// Hämtar ut senaste aktiviteterna för anvnändaren
$latestact = <<<END

	SELECT guidereviewinfo.grid, guidereviewinfo.title, guidereviewinfo.timestamp, userguidereview.grid
	FROM guidereviewinfo
	INNER JOIN userguidereview
	ON guidereviewinfo.grid = userguidereview.grid
	ORDER BY timestamp
	LIMIT 3;
END;
$res = $mysqli->query($latestact) or die();

while($row = $res->fetch_object())
{
	$keeperid = $_SESSION['keeperid'];
	$grid = $row->grid;
	$title = utf8_decode(htmlspecialchars($row->title));
	$timestamp = strtotime($row->timestamp);
	$timestamp = date("d M Y H:i", $timestamp);

	$latestactivity .= <<<END

		<a href="genre.php?grid={$grid}">{$title}</a></br>
END;
}

// Hämtar ut övrigt om användaren
$other = <<<END

	SELECT other 
	FROM user
	WHERE keepername = '{$keepername}'
END;
$res = $mysqli->query($other) or die();

if($res->num_rows == 1){
	$row = $res->fetch_object();
	$profileother = $row->other;
}

$content = <<<END

		
			<div class="container">
				<div class="row margin-top-100">
			
					<div class="col-md-3 col-sm-3 pull-left">

	  					<div class="row profil">
	  					
	  						<div class="column-left-top">
	  						<br>
	  					
	  							<p>Välkommen</p>
  	  					
  	  						</div>	  					
	  					
	  						<div class="column-left-center text-center">	  							
	  					
	  								<img src="images/profil_bild.png">	  							

	  							<p><b>{$keepername}</b></p>
	  					
	  						</div>

	  						<div class="column-left-bottom text-center">

	  							<p>Senaste nytt</p>
	  							
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

						<div class="col-md-3 col-sm-3 ads">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/200x350">
	  					
					</div><!-- reklam kolumn -->
					

					<div class="col-md-3 col-sm-3 panel-width-330px panel panel-default pull-left">

	  					<div class="panel-heading panel-heading-340px">Övrigt</div>

		  					<div class="panel-body">
 								{$profileother}
		  					</div>
						
						</div><!-- panel heading -->

						<div class="col-md-3 col-sm-3 panel-width-190px panel panel-default pull-left">

	  					<div class="panel-heading panel-heading-200px">Senaste aktiviteter</div>

		  					<div class="panel-body">
 
		  						{$latestactivity}

		  					</div>
						
						</div><!-- panel heading -->



					
					</div><!-- kolumn 2 -->
					</div><!-- kolumn 2 -->

				</div><!-- row -->
			</div><!-- container -->

  
  
END;



echo $header;
echo $content;
echo $footer;
?>