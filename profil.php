<?php

include_once("inc/HTMLTemplate.php");

$content = <<<END

			<div class="container">

				<div class="row margin-top-100 margin-horizontal-zero">
				
					<!-- torn kolumn  -->
					<div class="col-md-4 col-sm-4">

	  					<div class="row profil">

	  						<div class="column-left-top">

	  							<p>sat in overste del av torn i bakgrund har med en class i column left top</p>
	  						</div>
	  					
	  					</div><!-- row profil left top -->

	  					<div class="row profil">
		  							
	  						<div class="column-left-center">

	  							<p>left center</p>
	  						</div>

	  						</div><!-- row profil left top -->

	  					<div class="row profil">


	  						<div class="column-left-bottom">
	  							<p>left bottom</p>
	  						</div>
						
						</div><!-- row -->	
					
					<!-- center kolumn  -->
					<div class="col-md-4 col-sm-4">			

						
	  				<!-- reklam kolumn  -->
					<div class="col-md-3 col-sm-3 ads">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/200x350 pull-right">
	  					
					</div><!-- reklam kolumn -->

					</div><!-- kolumn 1 -->
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