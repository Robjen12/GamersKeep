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
		$title	= utf8_decode(htmlspecialchars($row->title));
		$text 	= utf8_decode(htmlspecialchars($row->text));
		$grade = $row->grade;
		$date 	= strtotime($row->timestamp);
		$date	= date("d M Y H:i", $date);
		$genre = $row->genretype;

		$latestgenreguide .= <<<END

			<a href="genre.php?grid={$grid}">{$title}</a></br>
			{$text}<br><br>

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
		$title	= utf8_decode(htmlspecialchars($row->title));
		$text 	= utf8_decode(htmlspecialchars($row->text));
		$grade = $row->grade;
		$date 	= strtotime($row->timestamp);
		$date	= date("d M Y H:i", $date);
		$genre = $row->genretype;	

		$latestgenrereview .= <<<END

			<a href="genre.php?grid={$grid}">{$title}</a></br>
			{$text}<br><br>
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
		$title = utf8_decode(htmlspecialchars($row->title));
		$text = utf8_decode(htmlspecialchars($row->text));
		$grade = $row->grade;

		$toplistgenreguide .= <<<END

			<a href="genre.php?grid={$grid}">{$title}</a><br>
			<i>{$text}</i><br><br>
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
		$title = utf8_decode(htmlspecialchars($row->title));
		$text = utf8_decode(htmlspecialchars($row->text));
		$grade = $row->grade;

		$toplistgenrereview .= <<<END

		<a href="genre.php?grid={$grid}">{$title}</a><br>
		<i>{$text}</i><br><br>
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
					<div class="content-center margin-left-25px pull-left">

					<div class="panel panel-default panel-width-240px pull-left">

	  					<div class="panel-heading panel-heading-250px">
							Senaste guider<li class="views">{$genretype}</li>
						</div><!-- panel heading -->

		  				<div class="panel-body height-410px">
		  					{$latestgenreguide}
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
								Topplista recensioner <li class="views">{$genretype}</li>
							</div><!-- panel heading -->

			  				<div class="panel-body height-410px">										
				  				{$toplistgenrereview}		  			
			  				</div><!-- panel body -->

						</div><!-- panel heading -->

					</div><!-- panel -->

					<!-- center column  row 2 -->
					<div class="content-center margin-left-25px pull-left">					

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

				
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>