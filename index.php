<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = "";
$latestguide = "";
$latestreview = "";
$toplistreview = "";
$toplistguide = "";
$title = "";
$text = "";
$grade = "";
$title	= htmlspecialchars($title);
$text	= htmlspecialchars($text);


$query = <<<END

	SELECT * FROM guidereviewinfo
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
}

$query = <<<END

	SELECT * FROM guidereviewinfo
	WHERE grade > 0
	ORDER BY timestamp DESC
	LIMIT 5;

END;

$res2 = $mysqli->query($query) or die();

date_default_timezone_set("Europe/Stockholm");


while($row2 = $res2->fetch_object())
{
	$grid 	= $row2->grid;
	$title	= utf8_decode(htmlspecialchars($row2->title));
	$text 	= utf8_decode(htmlspecialchars($row2->text));
	$grade  = $row2->grade;
	$date 	= strtotime($row2->timestamp);
	$date	= date("d M Y H:i", $date);

if($grade != NULL){
	$latestreview .= <<<END

				<a href="genre.php?grid={$grid}">{$title}</a></br>
				<i>{$text}</i><br><br>
END;
}


}

$query = <<<END

	SELECT userclick.keeperid, userclick.grid, guidereviewinfo.title, guidereviewinfo.grid, guidereviewinfo.grade, guidereviewinfo.text, COUNT(userclick.grid)
	FROM userclick
	INNER JOIN guidereviewinfo
	ON userclick.grid = guidereviewinfo.grid
	GROUP BY userclick.grid
	ORDER BY userclick.grid DESC
	LIMIT 5;
END;

$res = $mysqli->query($query);

while($row = $res->fetch_object())
{
	
	$grid 	= $row->grid;
	$title	= utf8_decode(htmlspecialchars($row->title));
	$text 	= utf8_decode(htmlspecialchars($row->text));
	$grade  = $row->grade;

if($grade == NULL)
{
$toplistguide .= <<<END

			<a href="genre.php?grid={$grid}">{$title}</a></br>
			<i>{$text}</i><br><br>
END;
}
else
{
$toplistreview .= <<<END

		<a href="genre.php?grid={$grid}">{$title}</a></br>
			<i>{$text}</i><br><br>
END;
}
}
$content = <<<END
				

				<div class="row margin-top-100">
			
					<div class="col-md-4 col-sm-4 panel panel-default">

	  					<div class="panel-heading">Topplista guider</div>

		  					<div class="panel-body">

			  					{$toplistguide}

		  					</div><!-- panel body -->

						</div><!-- panel heading -->

						
					

					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

	  					<div class="panel-heading">Senaste guiderna</div>

		  					<div class="panel-body">

		  						{$latestguide}

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

				  					{$toplistreview}
				  						  			
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
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>