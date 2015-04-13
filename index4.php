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
				
			
				<div class="wrapper margin-top-100">

					<div class="row">

						<!-- left column -->
						<div class="content-left margin-horizontal-15px pull-left">

							<div class ="panel panel-default margin-horizontal-15px pull-left">

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
										</ul><!-- media list -->

					  					<p>guider 1</p> <p>But I must explain to you how all this mistaken idea of denouncing pleasure
						  					and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of
						  					the great explorer of the truth, the master-builder of human happiness.</p>
						  					<p> Master-builder without using THE KRAGGLE!</p>

				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->

		  				</div><!-- content left kolumn -->

					
		  				<!-- left column -->
						<div class="content-center margin-horizontal-15px pull-left">

							<div class ="panel panel-default margin-horizontal-15px">

								<p>center column</p>
							</div>

		  				</div><!-- content kolumn -->

		  				<!-- right column -->
						<div class="content-right pull-left ">

							<div class ="panel panel-default margin-horizontal-15px pull-right">

								<p>right column</p>
							</div>

		  				</div><!-- content kolumn -->

					</div><!-- row -->

				</div><!-- wrapper -->
		

  
  
END;



echo $header;
echo $content;
echo $footer;
?>