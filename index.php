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

//test
$genretype = "";
$genre = "";

$query = <<<END

	SELECT * FROM guidereviewinfo
	WHERE grade IS NULL
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

	$latestguide .= <<<END
	
								<ul class="media-list">
  									<li class="media">
    									<div class="media-left">
      										<a href="genre.php?grid={$grid}">
	        									<img class="media-object" src="http://placehold.it/64x64" class="ads"
	        									alt="senaste guide image">
      										</a>
    									</div>
    									<div class="media-body">
      										<h4 class="media-heading"><a href="genre.php?grid={$grid}"
      										class="text-bold">{$title}</a></br>
											<i>{$text}</i></h4><br>
    									</div>
  									</li>
								</ul>

						
END;

}
$query = <<<END

	SELECT * FROM guidereviewinfo
	WHERE grade > 0
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

	$latestreview .= <<<END

								<ul class="media-list">
  									<li class="media">
    									<div class="media-left">
      										<a href="genre.php?grid={$grid}">
	        									<img class="media-object" src="http://placehold.it/64x64" class="latest review image"
	        									alt="senaste guide image">
      										</a>
    									</div>
    									<div class="media-body">
      										<h4 class="media-heading"><a href="genre.php?grid={$grid}"
      										class="text-bold">{$title}</a></br>
											<i>{$text}</i><br></h4>
    									</div>
  									</li>
								</ul>			




		
END;
}





$query = <<<END

	SELECT userclick.grid, count(userclick.grid) AS counter, guidereviewinfo.title, guidereviewinfo.text, guidereviewinfo.grade
  	FROM userclick, guidereviewinfo
	WHERE userclick.grid = guidereviewinfo.grid
	AND guidereviewinfo.grade IS NULL
 	GROUP by userclick.grid
 	ORDER BY counter DESC
 	LIMIT 5;

END;
$result = $mysqli->query($query);

if($result->num_rows > 0)
{
        while($row = $result->fetch_object())
        {
        	$grid 	= $row->grid;
			$title	= utf8_decode(htmlspecialchars($row->title));
			$text 	= utf8_decode(htmlspecialchars($row->text));

                $toplistguide .=<<<END

                <ul class="media-list">
  									<li class="media">
    									<div class="media-left">
      										<a href="genre.php?grid={$grid}">
	        									<img class="media-object" src="http://placehold.it/64x64" class="toplist guide image"
	        									alt="toplist guide image">
      										</a>
    									</div>
    									<div class="media-body">
      										<h4 class="media-heading"><a href="genre.php?grid={$grid}"
      										class="text-bold">{$title}</a><li class="views">{$row->counter}</li></br>
											<i>{$text}</i><br></h4>
    									</div>
  									</li>
								</ul>			

               
           
END;
        }
}

$query = <<<END

	SELECT userclick.grid, count(userclick.grid) AS counter, guidereviewinfo.title, guidereviewinfo.text, guidereviewinfo.grade
  	FROM userclick, guidereviewinfo
  	WHERE userclick.grid = guidereviewinfo.grid
  	AND grade > 0
 	GROUP by grid
	ORDER BY counter DESC
	LIMIT 5;
END;

$res = $mysqli->query($query);

if($res->num_rows > 0){

	while($row = $res->fetch_object())
	{
	
	$grid 	= $row->grid;
	$title	= utf8_decode(htmlspecialchars($row->title));
	$text 	= utf8_decode(htmlspecialchars($row->text));
	$grade  = $row->grade;

	$toplistreview .= <<<END

	<ul class="media-list">
  									<li class="media">
    									<div class="media-left">
      										<a href="genre.php?grid={$grid}">
	        									<img class="media-object" src="http://placehold.it/64x64" class="toplist review image"
	        									alt="Toplist review image">
      										</a>
    									</div>
    									<div class="media-body">
      										<h4 class="media-heading"><a href="genre.php?grid={$grid}"
      										class="text-bold">{$title}</a></br><li class="views">{$row->counter}</li>
											<i>{$text}</i><br></h4>
    									</div>
  									</li>
								</ul>

		
END;

	}
}

$content = <<<END
				
			
				<div class="wrapper margin-top-100">

					<div class="row">

						<!-- left column -->
						<div class="content-left pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px quicksand">Topplista guider</div>

				  					<div class="panel-body">

				  							<p>{$toplistguide}</p>
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

								<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

							</div><!-- ads -->

		  				</div><!-- content left kolumn -->

		  				</div><!-- content center kolumn -->
		  				
		  				</div><!-- content right kolumn -->

					</div><!-- row -->

					<div class="row">

						<!-- left column row 2 -->
						<div class="content-left pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Topplista recensioner</div>

				  					<div class="panel-body">

				  							<p>{$toplistreview}</p>
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
						

		  				</div><!-- content center kolumn row 2 -->
		  				
		  				</div><!-- content left kolumn row 2 -->

		  				{$genre}

					</div><!-- row -->

				</div><!-- wrapper --> 

							
						
					
	
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>