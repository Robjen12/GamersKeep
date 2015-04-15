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
	
			<a class="text-bold" href="genre.php?grid={$grid}">{$title}</a></br>
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
				
			
				<div class="wrapper margin-top-100">

					<div class="row">

						<!-- left column -->
						<div class="content-left margin-left-25px pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Topplista guider</div>

				  					<div class="panel-body">

				  							<p>guider 1</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->


					
		  				<!-- center column -->
						<div class="content-center margin-left-25px pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Senaste guider</div>

				  					<div class="panel-body">

				  							<p>{$latestguide}</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->		  				

		  				<!-- right column -->
						<div class="content-right margin-right-25px pull-right">

							<div class ="ads">

								<img src="http://placehold.it/290x300" class="ads pull-right">

							</div><!-- ads -->

		  				</div><!-- content left kolumn -->

		  				</div><!-- content center kolumn -->
		  				
		  				</div><!-- content right kolumn -->

					</div><!-- row -->

					<div class="row">

						<!-- left column row 2 -->
						<div class="content-left margin-left-25px pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Topplista recensioner</div>

				  					<div class="panel-body">

				  							<p>Topplista recensioner</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->
					
		  				<!-- center column  row 2 -->
						<div class="content-center margin-left-25px pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Senaste recensioner</div>

				  					<div class="panel-body">

				  							<p>{$latestreview}</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->		  				

		  				<!-- right column row 2 -->
						<div class="content-right margin-right-25px pull-right">

							<div class ="ads">

								<img src="http://placehold.it/290x300" class="ads pull-right">

							</div><!-- ads -->

		  				</div><!-- content right kolumn row 2 -->

		  				</div><!-- content center kolumn row 2 -->
		  				
		  				</div><!-- content left kolumn row 2 -->

					</div><!-- row -->

				</div><!-- wrapper -->
		

  
  
END;



echo $header;
echo $content;
echo $footer;
?>