<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = "";
$latestguide = "";
$latestreview = "";
$toplistguide = "";
$title = "";
$text = "";
$grade = "";
$title	= htmlspecialchars($title);
$text	= htmlspecialchars($text);


$query = <<<END

	SELECT  grid, title, text, timestamp, grade
	FROM guidereviewinfo
	ORDER BY timestamp DESC
	LIMIT 5;

END;

$res = $mysqli->query($query) or die();

date_default_timezone_set("Europe/Stockholm");


while($row = $res->fetch_object())
{
	$grid 	= $row->grid;
	$title	= utf8_decode(htmlspecialchars($row->title));
	$text 	= utf8_decode(htmlspecialchars($row->text));
	$grade  = $row->grade;
	$date 	= strtotime($row->timestamp);
	$date	= date("d M Y H:i", $date);

if($grade == NULL){
	$latestguide .= <<<END
	
			<a href="genre.php?grid={$grid}">{$title}</a></br>
			<i>{$text}</i><br><br>	
			
END;
}
else
{
	$latestreview .= <<<END

				<a href="genre.php?grid={$grid}">{$title}</a></br>
				<i>{$text}</i><br><br>
END;
}

}
/*
$query = <<<END

	SELECT COUNT('keeperid') FROM userclick
	WHERE grid = '{$grid}'
	ORDER BY keeperid DESC
	LIMIT 5;
END;
$res = $mysqli->query($query);

$query = <<<END

	SELECT  grid, title, text, timestamp, grade
	FROM guidereviewinfo

END;

$res = $mysqli->query($query) or die();
while($row = $res->fetch_object())
{
	$grid 	= $row->grid;
	$title	= utf8_decode(htmlspecialchars($row->title));
	$text 	= utf8_decode(htmlspecialchars($row->text));
	$grade  = $row->grade;
	$date 	= strtotime($row->timestamp);
	$date	= date("d M Y H:i", $date);

if($grade == NULL)
{
$toplistguide .= <<<END

			<a href="genre.php?grid={$grid}">{$title}</a></br>
			<i>{$text}</i><br><br>
END;
}
else
{

}
}*/
$content = <<<END
				
			
				<div class="row margin-top-100">
			
					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

	  					<div class="panel-heading">Topplista guider</div>

		  					<div class="panel-body">

		  						<ul class="media-list">
  									<li class="media">
    									<div class="media-left">
      										<a href="#">
        									<img class="media-object" src="http://placehold.it/64x64" class="ads" alt="...">
      										</a>
    									</div>
    									<div class="media-body">
      										<h4 class="media-heading">Media heading</h4>
      										...
    									</div>
  									</li>
								</ul>

			  					<p>guider 1</p> <p>But I must explain to you how all this mistaken idea of denouncing pleasure
				  					and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of
				  					the great explorer of the truth, the master-builder of human happiness.</p>
				  					<p> Master-builder without using THE KRAGGLE!</p>

		  					</div><!-- panel body -->

						</div><!-- panel heading -->

						
					

					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

	  					<div class="panel-heading">Senaste guiderna</div>

		  					<div class="panel-body">
		  						<p>

		  						{$latestguide}
		  						</p>
		  					</div>
						
						</div><!-- panel heading -->



					<div class="col-md-3 col-sm-3 pull-right profil-right">

							<div class="ads profil-right pull-right">

		  					
							<!-- Reklam karusel -->
							
		  						<img src="http://placehold.it/290x290" class="ads">

		  						<br><br><br>

		  						<img src="http://placehold.it/290x290" class="ads">

		  					
							</div><!-- reklam kolumn -->

						</div><!-- col -->				
				
					<div class="col-md-4 col-sm-4 panel panel-default">

		  					<div class="panel-heading">Topplista recensionerna</div>

			  					<div class="panel-body">

				  					<p>Toplist innehall.</p> <p>But I must explain to you how all this mistaken idea of denouncing pleasure
				  					and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of
				  					the great explorer of the truth, the master-builder of human happiness.</p>
				  					<p> Master-builder without using THE KRAGGLE!</p>
				  						  			
			  					</div><!-- panel body -->

							</div><!-- panel heading -->						

						<div class="col-md-4 col-sm-4 panel panel-default pull-left">

		  					<div class="panel-heading">Senaste recensionerna</div>

			  					<div class="panel-body">

			  						{$latestreview}

			  					</div>
							
						
							</div><!-- panel heading -->
						</div>
					</div>
				</div>
			</div><!-- container -->

  
  
END;



echo $header;
echo $content;
echo $footer;
?>