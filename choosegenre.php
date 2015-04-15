<?php
/* master choosegenre.php */

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

/*$keeper = $_SESSION['keeperid'];
$grid = "";
$latestguide = "";
$latestreview = "";
$toplistreview = "";
$toplistguide = "";
$title = "";
$text = "";
$grade = "";
$title	= htmlspecialchars($title);
$text	= htmlspecialchars($text);*/


$content = <<<END
				

				<div class="row margin-top-100">
			
					<div class="col-md-4 col-sm-4 panel panel-default">

	  					<div class="panel-heading">Topplista guider</div>

		  					<div class="panel-body">

			  					

		  					</div><!-- panel body -->

						</div><!-- panel heading -->

						
					

					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

	  					<div class="panel-heading">Senaste guiderna</div>

		  					<div class="panel-body">

		  						

		  					</div>
						
						</div><!-- panel heading -->



					<div class="col-md-3 col-sm-3 ads pull-right">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/200x350">
	  					
					</div><!-- reklam kolumn -->
					

				</div><!-- row -->



				<div class="row">
					<div class="col-md-4 col-sm-4 panel panel-default">

		  					<div class="panel-heading">Topplista recensionerna</div>

			  					<div class="panel-body">

				  					
				  						  			
			  					</div><!-- panel body -->

							</div><!-- panel heading -->

							
						

						<div class="col-md-4 col-sm-4 panel panel-default pull-left">

		  					<div class="panel-heading">Senaste recensionerna</div>

			  					<div class="panel-body">

			  						
			  					</div>
							
						
							</div><!-- panel heading -->
						</div>
					</div>
				</div>
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>