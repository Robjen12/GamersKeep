<?php

include_once("inc/HTMLTemplate.php");

$content = <<<END

			<div class="container">
				<div class="row margin-top-100 margin-horizontal-zero">
			
					<div class="col-md-4 col-sm-4">

	  					<div class="row profil column-left-top">

	  						<p>left top</p>
	  					</div>

	  					<div class="row profil column-left-center">

		  							<p>left center</p>
		  							
	  						<div class="profil column-left-center">
	  						</div>

	  						<div class="profil column-left-bottom">
	  						</div>
						
						</div><!-- row -->	
					

					<div class="col-md-4 col-sm-4">
					

						
	  					
					<div class="col-md-3 col-sm-3 ads">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/200x350 pull-right">
	  					
					</div><!-- reklam kolumn -->
					</div><!-- kolumn 2 -->
					</div><!-- kolumn 2 -->

				</div><!-- row -->
			</div><!-- container -->


		
					
					<div class="col-md-4">
				</div>
			</div>
		</div>
	</body>
</html>

END;
echo $header;
echo $content;
echo $footer;
?>