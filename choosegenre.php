<?php

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

if(!empty($_GET))
{

	$genretype = isset($_GET['genretype']) & $_GET['genretype'] : "")

	$query = <<<END
	SELECT * FROM guidereviewinfo
	INNER JOIN genreguidereview
	ON guidereviewinfo.grid = genreguidereview.grid
	WHERE genretype = '{$genretype}'
	ORDER BY timestamp DESC;
END;
	$result = $mysqli->query($query) or die();

	while($result->num_rows > 0){
		$row = $result->fetch_object();
		$grid = $row->grid;
		$title =$row->title;
		$text = $row->text;
		$grade = $row->grade;
		$genre = $row->genretype;

	$latestgenreguide .= <<<END

		<a href="choosegenre.php?grid={$grid}">{$title}</a>
		{$text}

END;

	}

}

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