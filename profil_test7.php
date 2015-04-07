<?php
include_once("inc/HTMLTemplate.php");

$content = <<<END
				
			<div class="container">
				<div class="row">
			
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
	  							
	  							</div><!-- col md 3>

	  							<p>Vänner</p>		

	  						</div><!-- column left bottom -->
						
						</div><!-- row profil -->

					</div><!-- col md 3 torn -->
						
						
					

					<div class="col-md-9 col-sm-9 profil column-top-right pull-left">

						<div class="col-md-9 profil-right info panel-default">

						col md 6
						</div>

						<div class="col-md-3 pull-left reklam pull-right">

						col md 3
						</div>
					</div>
	  					

						

					
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



					<div class="col-md-3 col-sm-3 ads pull-right">

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