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
	  					
	  						<div class="column-left-center text-center">	  							
	  					
	  								<img src="images/profil_bild.png">	  							

	  							<p><b>Keepername</b></p>
	  					
	  						</div>

	  						<div class="column-left-bottom">
	  							<p>Om mig</p>

	  							<p>Sociala Medier</p>
	  							
	  							<p>Vanner</p>


	  							<p class="profil-vanner text-center"><b>SourFeet</b></p>

	  							<p class="profil-vanner">PharfelKugel</p>

	  							<p class="profil-vanner">StinkyWinky</p>

	  							</div><!-- col md 3>

	  							<p>Vänner</p>		

	  						</div><!-- column left bottom -->
						
						</div><!-- row -->

						</div>
						
						
					

					<div class="col-md-6 col-sm-6 panel panel-default pull-left width-col-6">

	  					<div class="panel-heading width-col-6">Senaste listorna</div>

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