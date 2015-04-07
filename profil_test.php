<?php
include_once("inc/HTMLTemplate.php");

$content = <<<END
				
			<div class="container">
				<div class="row margin-top-100">
			
					<div class="col-md-3 col-sm-3 pull-left">

	  					<div class="row profil">
	  						<div class="column-left-top">
	  							<p>Välkommen</p>
  	  						</div>	  					
	  						<div class="column-left-center">
<img src="images/profil_bild.png">	  							

	  							<p><b>Keepername</b></p>
	  							<p>left center</p>
	  						</div>
	  					</div><!-- row profil left top -->

	  					<div class="row profil">
	  						<div class="column-left-bottom">
	  							<p>left bottom</p>
	  						</div>
						</div><!-- row -->
						
					</div>

						
					

					<div class="col-md-6 col-sm-6 panel panel-default pull-left">

	  					<div class="panel-heading">Senaste listorna</div>

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



					<div class="col-md-3 col-sm-3 ads">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/200x350">
	  					
					</div><!-- reklam kolumn -->
					</div><!-- kolumn 2 -->
					</div><!-- kolumn 2 -->

				</div><!-- row -->
			</div><!-- container -->

  
  
END;



echo $header;
echo $content;
echo $footer;
?>