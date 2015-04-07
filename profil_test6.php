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

	  							<img src="images/profil_bild.png" class="pull-left friend-bild">
	  							<p class="profil-vanner text-center">SourFeet</p>
	  							<img src="images/profil_bild.png" class="pull-left friend-bild">
	  							<p class="profil-vanner">PharfelKugel</p>
	  							<img src="images/profil_bild.png" class="pull-left friend-bild">
	  							<p class="profil-vanner">StinkyWinky</p>

	  							</div><!-- col md 6>

	  							<p>Vänner</p>		

	  						</div><!-- column left bottom -->
						
						</div><!-- row -->
						
					</div>	
						
					

					<div class="col-md-9 col-sm-9 profil-right pull-right">


	  					<div class="col-md-3 col-sm-3 profil-right-column-1">Introduktion</div>

		  					<div class="panel-body">

		  						<p>Här kan du skriva mera om dig själv, ex vilka spel du gillar och liknande.</p>

		  						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a augue eleifend,
		  							tempor felis eu, rutrum nisi. Curabitur at nisl urna. Aliquam erat volutpat.
		  						  	Phasellus congue vehicula tristique. Maecenas vulputate ultricies laoreet.
		  						   	Suspendisse potenti. Praesent nec tellus in nulla commodo consectetur.
		  						   	Integer mauris eros, pellentesque sed blandit et, aliquet eget magna. Quisque
		  						   	vel dui justo.</p>

		  						<p> </p>

		  					</div><!-- panel body -->
						
						</div><!-- panel heading -->

					<div class="col-md-6 col-sm-6 panel panel-default pull-left">

					
	  					<div class="panel-heading">Sociala Medier</div>

		  					<div class="panel-body">

		  						<p>Här kan du skriva mera om dig själv, ex vilka spel du gillar och liknande.</p>

		  						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a augue eleifend,
		  							tempor felis eu, rutrum nisi. Curabitur at nisl urna. Aliquam erat volutpat.
		  						  	Phasellus congue vehicula tristique. Maecenas vulputate ultricies laoreet.
		  						   	Suspendisse potenti. Praesent nec tellus in nulla commodo consectetur.
		  						   	Integer mauris eros, pellentesque sed blandit et, aliquet eget magna. Quisque
		  						   	vel dui justo.</p>

		  						<p> </p>

		  					</div><!-- panel body -->
						
						</div><!-- panel heading -->


					<div class="col-md-3 col-sm-3 ads pull-left">

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