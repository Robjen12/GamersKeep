<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = "";
$title = "";
$text = "";
$grade = "";
$genre = "";
$latestgenreguide = "";
$latestgenrereview = "";
$toplistgenreguide = "";
$toplistgenrereview = "";
$title	= htmlspecialchars($title);
$text	= htmlspecialchars($text);

if(!empty($_GET))
{

	$genretype = isset($_GET['genretype']) ? $_GET['genretype'] : "";

	$query = <<<END

	SELECT * FROM guidereviewinfo
	JOIN genreguidereview
	ON guidereviewinfo.grid = genreguidereview.grid
	WHERE genretype = '{$genretype}'
	AND grade IS NULL
	ORDER BY timestamp DESC
	LIMIT 5;
END;

	$result = $mysqli->query($query) or die();

	date_default_timezone_set("Europe/Stockholm");

if($result->num_rows > 0)
{


	while($row = $result->fetch_object())
	{
		
		$grid = $row->grid;
		$title	= utf8_decode($row->title);
		$text 	= utf8_decode($row->text);
		$subtext = substr($text, 0, 160);
		$grade = $row->grade;
		$date 	= strtotime($row->timestamp);
		$date	= date("d M Y H:i", $date);
		$genre = $row->genretype;

		$latestgenreguide .= <<<END

			<ul class="media-list margin-left-topplista">
				<li class="media">
					<div class="media-left">
				</div>
    			<div class="media-body">
      					<h4 class="media-heading"><a href="genre.php?grid={$grid}">{$title}</a>
						<li class="views"></li>
						<br>
						<h5 class="media-heading">{$subtext}...<a href="genre.php?grid={$grid}">Läs mer</a></h5>
    				</div><!-- media body -->
  				</li><!-- media -->
			</ul><!-- media list -->

END;

	}
}
	$query = <<<END

	SELECT * FROM guidereviewinfo
	JOIN genreguidereview
	ON guidereviewinfo.grid = genreguidereview.grid
	WHERE grade > 0
	AND genretype = '{$genretype}'
	ORDER BY timestamp DESC
	LIMIT 5;

END;

	$result = $mysqli->query($query) or die();

	date_default_timezone_set("Europe/Stockholm");

if($result->num_rows > 0)
{


	while($row = $result->fetch_object())
	{
		$grid = $row->grid;
		$title	= utf8_decode($row->title);
		$text 	= utf8_decode($row->text);
		$subtext = substr($text, 0, 160);
		$grade = $row->grade;
		$date 	= strtotime($row->timestamp);
		$date	= date("d M Y H:i", $date);
		$genre = $row->genretype;	

		$latestgenrereview .= <<<END

			<ul class="media-list margin-left-topplista">
				<li class="media">
					<div class="media-left">
				</div>
    			<div class="media-body">
      					<h4 class="media-heading"><a href="genre.php?grid={$grid}">{$title}</a>
						<li class="views"></li>
						<br>
						<h5 class="media-heading">{$subtext}...<a href="genre.php?grid={$grid}">Läs mer</a></h5>
    				</div><!-- media body -->
  				</li><!-- media -->
			</ul><!-- media list -->
END;
	}


}

$query = <<<END

	SELECT *, COUNT(userclick.grid) AS counter 
	FROM userclick
	JOIN guidereviewinfo
	ON userclick.grid = guidereviewinfo.grid
	JOIN genreguidereview
	ON userclick.grid = genreguidereview.grid
	WHERE genretype = '{$genretype}'
	AND grade IS NULL
	GROUP BY userclick.grid
	ORDER BY counter DESC
	LIMIT 5;
END;

$result = $mysqli->query($query) or die();

if($result->num_rows > 0)
{

	while($row = $result->fetch_object())
	{
		$grid = $row->grid;
		$title = utf8_decode($row->title);
		$text = utf8_decode($row->text);
		$subtext = substr($text, 0, 160);
		$grade = $row->grade;

		$toplistgenreguide .= <<<END

			<ul class="media-list margin-left-topplista">
				<li class="media">
					<div class="media-left">
				</div>
    			<div class="media-body">
      					<h4 class="media-heading"><a href="genre.php?grid={$grid}">{$title}</a>
						<li class="views">{$row->counter}</li>
						<br>
						<h5 class="media-heading">{$subtext}...<a href="genre.php?grid={$grid}">Läs mer</a></h5>
    				</div><!-- media body -->
  				</li><!-- media -->
			</ul><!-- media list -->
END;

	}

}

$query = <<<END
	
	SELECT *, COUNT(userclick.grid) AS counter
	FROM userclick
	JOIN guidereviewinfo
	ON userclick.grid = guidereviewinfo.grid
	JOIN genreguidereview
	ON userclick.grid = genreguidereview.grid
	WHERE genretype = '{$genretype}'
	AND grade > 0
	GROUP BY userclick.grid
	ORDER BY counter DESC
	LIMIT 5;
END;

$result = $mysqli->query($query) or die();

if($result->num_rows >0)
{

	while($row = $result->fetch_object())
	{

		$grid = $row->grid;
		$title = utf8_decode($row->title);
		$text = utf8_decode($row->text);
		$subtext = substr($text, 0, 160);
		$grade = $row->grade;

		$toplistgenrereview .= <<<END

		<ul class="media-list margin-left-topplista">
				<li class="media">
					<div class="media-left">
				</div>
    			<div class="media-body">
      					<h4 class="media-heading"><a href="genre.php?grid={$grid}">{$title}</a>
						<li class="views">{$row->counter}</li>
						<br>
						<h5 class="media-heading">{$subtext}...<a href="genre.php?grid={$grid}">Läs mer</a></h5>
    				</div><!-- media body -->
  				</li><!-- media -->
			</ul><!-- media list -->
END;

	}
}



}

$content = <<<END
				

				<div class="wrapper margin-top-100">

					<div class="row">
					
						<div class="content-left pull-left">
					
						<div class="panel panel-default panel-width-240px pull-left">

	  					<div class="panel-heading panel-heading-250px quicksand">
							Topplista guider <li class="views">{$genretype}</li>
						</div><!-- panel heading -->

		  					<div class="panel-body height-410px">

			  					{$toplistgenreguide}

		  					</div><!-- panel body -->

						</div><!-- panel heading -->
						
						</div><!-- panel -->
					
					<!-- center column -->
					<div class="content-center pull-left">

					<div class="panel panel-default panel-width-240px pull-left">

	  					<div class="panel-heading panel-heading-250px">
							Topplista recensioner<li class="views">{$genretype}</li>
						</div><!-- panel heading -->

		  				<div class="panel-body height-410px">
		  					{$toplistgenrereview}
		  				</div><!-- panel body -->
						
					</div><!-- col md 4 -->
					
					</div><!-- panel -->

					<div class="content-right margin-right-15px pull-right">

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
						<div class="panel panel-default panel-width-240px pull-left">

		  					<div class="panel-heading panel-heading-250px">
								 Senaste guider<li class="views">{$genretype}</li>
							</div><!-- panel heading -->

			  				<div class="panel-body height-410px">										
				  				{$latestgenreguide}
			  				</div><!-- panel body -->

						</div><!-- panel heading -->

					</div><!-- panel -->

					<!-- center column  row 2 -->
					<div class="content-center pull-left">					

					<div class="panel panel-default panel-width-240px pull-left">

		  					<div class="panel-heading panel-heading-250px">
								Senaste recensioner<li class="views">{$genretype}</li>
							</div><!-- panel heading -->

			  				<div class="panel-body height-410px">
			  						{$latestgenrereview}
		  					</div><!-- panel body -->					
							
							</div><!-- panel heading -->

						</div><!-- panel -->
					
		  			<!-- right column row 2 -->
						<div class="content-right margin-right-15px pull-right">

							<div class ="ads">

								<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

							</div><!-- ads -->	

		  				</div><!-- content right kolumn row 2 -->

		  				</div><!-- content center kolumn row 2 -->
		  				
		  				</div><!-- content left kolumn row 2 -->

					</div><!-- row -->

					<div class="row ads-row">
						<div class="content-full pull-left">

							<div class ="ads">

								<img src="images/ad_req.jpg" class="ads pull-left" width="300px">
								<img src="images/ad_req.jpg" class="ads pull-left" width="300px">

							</div><!-- ads -->	

		  				</div>
					</div>

				
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>