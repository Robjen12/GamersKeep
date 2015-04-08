<?php
include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keepername = $_SESSION['keepername'];
$keeperid = $_SESSION['keeperid'];
$profilename = '';
$profileabout = '';

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
 
		  						<p>Senaste listorna innehall: No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but
		  						because those who do not know
		  						how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who
		  						loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances
		  						occur in which toil and pain can procure him some great pleasure.</p>

		  						<p>Senaste listorna innehall: No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but
		  						because those who do not know
		  						how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who
		  						loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances
		  						occur in which toil and pain can procure him some great pleasure.</p>

		  						<p>Senaste listorna innehall: No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but
		  						because those who do not know
		  						how to pursue pleasure rationally encounter consequences that are extremely painful. </p>

		  					</div>
						
						</div><!-- panel heading -->

						<div class="col-md-3 col-sm-3 panel-width-190px panel panel-default pull-left">

	  					<div class="panel-heading panel-heading-200px">Länkar</div>

		  					<div class="panel-body">
 
		  						<p>Senaste listorna innehall: No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but
		  						because those who do not know
		  						how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who
		  						loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances
		  						occur in which toil and pain can procure him some great pleasure.</p>

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