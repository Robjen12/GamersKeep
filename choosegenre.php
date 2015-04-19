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
					<form class="form-inline margin-left-25px">
					<div class="form-group">
					<form action="search.php" method="get" id="searchgenrer">
					<h3 class="text-bold">Sök efter en specifik titel</h3>
						<input type="text" class="form-control droid" id="searchgenre" name="searchgenre" placeholder="Titel">
						<button type="submit" class="btn btn-danger text-bold login-text quicksand text-white pull-right" value="Sök"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button><br>
					</form>
					</div><!-- form group -->
					
					<div class="col-md-4 col-sm-4 panel panel-default">

	  					<div class="panel-heading">
							Topplista guider <li class="views">{$genretype}</li>
						</div><!-- panel heading -->

		  					<div class="panel-body">

			  					{$toplistgenreguide}

		  					</div><!-- panel body -->

						</div><!-- panel heading -->					

					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

	  					<div class="panel-heading">
							Senaste guider<li class="views">{$genretype}</li>
						</div><!-- panel heading -->

		  				<div class="panel-body">

		  					{$latestgenreguide}

		  				</div><!-- panel body -->
						
					</div><!-- col md 4 -->

					<div class="col-md-3 col-sm-3 ads pull-right">

					<!-- Reklam karusel -->
					
	  					<img src="http://placehold.it/300x300">			
							  					
					</div><!-- reklam kolumn -->
					
				</div><!-- row -->

				<div class="row">
					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

		  					<div class="panel-heading">Topplista recensioner<li class="views">{$genretype}</li></div>

			  					<div class="panel-body">

										
				  				{$toplistgenrereview}
				  						  			
			  					</div><!-- panel body -->

							</div><!-- panel heading -->							
						

					<div class="col-md-4 col-sm-4 panel panel-default pull-left">

		  				<div class="panel-heading">
							Senaste recensioner<li class="views">{$genretype}</li>
						</div><!-- panel heading -->

			  				<div class="panel-body">
		  						{$latestgenrereview}

		  					</div>							
						
						</div><!-- panel heading -->
						
					<div class="col-md-3 col-sm-3 ads pull-right">

						<!-- Reklam karusel -->
								
						<img src="http://placehold.it/300x300">									
															
					</div><!-- reklam kolumn -->
												
					</div><!-- col md 4 -->
					</div><!-- col md 4 -->

				</div><!-- row -->
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>