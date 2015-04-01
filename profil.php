<?php

include_once("inc/HTMLTemplate.php");

$content = <<<END

			<div class="container">
				<div class="row margin-top-100">
			
					<div class="col-md-4 col-sm-4">

	  					<div id="square"></div>
						
						
					

					<div class="col-md-4 col-sm-4">
					<div id="trapez"></div>

						<div id="rectangle"></div>
	  					
					<div class="col-md-3 col-sm-3 ads">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/200x350">
	  					
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