<?php
include_once("inc/HTMLTemplate.php");




$content = <<<END

		<link href='css/style_profil.css' rel='stylesheet' type='text/css'>
				
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
	  							<p>Sista nytt</p>

	  							<p>Sociala Medier</p>
	  							
	  							<p>Vanner</p>	  							

	  							</div><!-- col md 3>

	  							<p>Vänner</p>		

	  						</div><!-- column left bottom -->
						
						</div><!-- row -->

						</div>
						
						<div class="col-md-6 col-sm-6 panel-width-550px panel panel-default">

	  					<div class="panel-heading width-500px">Din Profil</div>

		  					<div class="panel-body">

			  					<p>Namn</p> <p>But I must explain to you how all this mistaken idea of denouncing pleasure
			  					and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of
			  					the great explorer of the truth, the master-builder of human happiness.</p>
			  					<p> Master-builder without using THE KRAGGLE!</p>
			  						  			
		  					</div><!-- panel body -->

						</div><!-- panel heading -->

						<div class="col-md-3 col-sm-3 ads">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/200x350">
	  					
					</div><!-- reklam kolumn -->
					

					<div class="col-md-3 col-sm-3 panel-width-330px panel panel-default pull-left">

	  					<div class="panel-heading panel-heading-340px">Datorspecifikationer</div>

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