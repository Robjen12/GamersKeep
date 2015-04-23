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
				

				<div class="row margin-top-100">
				
					<form action="search.php" method="get" id="searchgenrer">
					<h3 class="quicksand text-white">Sök efter en specifik titel</h3>
						<input type="text" id="searchgenre" name="searchgenre">
						<input type="submit" value="Sök"><br><br>
					</form>

					<div class="col-md-4 col-sm-4 panel panel-default">

	  					<div class="panel-heading">
							Topplista guider <li class="views">{$genretype}</li>
						</div><!-- panel heading -->

		  					<div class="panel-body height-410px">

			  					{$toplistgenreguide}

		  					</div><!-- panel body -->

						</div><!-- panel heading -->					

					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

	  					<div class="panel-heading">
							Senaste guider<li class="views">{$genretype}</li>
						</div><!-- panel heading -->

		  				<div class="panel-body height-410px">
		  					{$latestgenreguide}
		  				</div><!-- panel body -->
						
					</div><!-- col md 4 -->

					<div class="col-md-4 content-right pull-right">

							<div class ="ads">

								<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

							</div><!-- ads -->
							<br>
					</div><!-- ads right row 1 -->					

				</div><!-- row -->

				<div class="row">
					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

		  					<div class="panel-heading">
								Topplista recensioner <li class="views">{$genretype}</li>
							</div><!-- panel heading -->

			  				<div class="panel-body height-410px">										
				  				{$toplistgenrereview}		  			
			  				</div><!-- panel body -->

					</div><!-- col md 4 -->						

					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

		  					<div class="panel-heading">
								Senaste recensioner<li class="views">{$genretype}</li>
							</div><!-- panel heading -->

			  				<div class="panel-body height-410px">
			  						{$latestgenrereview}
		  					</div><!-- panel body -->
													
							
					</div><!-- col md 4 -->
							
						<div class="col-md-4">
						
							
						</div><!-- content right -->
												
					</div><!-- col md 4 -->
					</div><!-- col md 4 -->

				</div><!-- row -->
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>