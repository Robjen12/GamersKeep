<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = isset($_GET['grid']) ? $_GET['grid'] : '';
$showgrade = "";

	$query = <<<END

		INSERT INTO userclick (grid, keeperid)
		VALUES ('{$grid}', '{$keeper}');
END;

$res = $mysqli->query($query);

$query = <<<END

	SELECT title, text, timestamp, grade
	FROM guidereviewinfo
	WHERE grid = '{$grid}';
END;
$res = $mysqli->query($query);

$row = $res->fetch_object();

$title = utf8_decode(htmlspecialchars($row->title));
$text  = utf8_decode(htmlspecialchars($row->text));
$timestamp = strtotime($row->timestamp);
$timestamp = date("d M Y H:i", $timestamp);
$grade = $row->grade;

if($grade > 0){
	$showgrade = <<<END
	Betyg: {$grade}
END;
}
$content = <<<END

		<div class="wrapper margin-top-100">

			<div class="row">

				<div class="content-genre col-md-8 margin-genre pull-left">
				
					<div class="grinfo">

						<div class ="panel panel-default panel-genre pull-left">

							<div class="panel-heading panel-heading-genre quicksand">{$title}
							<li class="views">{$showgrade}</li></div></br>

				  				<div class="panel-body">

									Skriven av: keepername</br>
									Publicerad: {$timestamp}<br><br>
									{$text}<br>	
							
								</div><!-- panel body -->

							</div><!-- panel heading -->

						</div><!-- panel -->
						
					</div><!-- grinfo -->
					
				</div><!-- content genre -->
								
			</div><!-- row -->

END;

echo $header;
echo $content;
echo $footer;

?>