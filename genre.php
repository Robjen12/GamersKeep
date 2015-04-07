<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = isset($_GET['grid']) ? $_GET['grid'] : '';


	$query = <<<END

		INSERT INTO userclick (grid, keeperid)
		VALUES ('{$grid}', '{$keeper}');
END;

$res = $mysqli->query($query);

$query = <<<END

	SELECT title, text, timestamp
	FROM guidereviewinfo
	WHERE grid = '{$grid}';
END;
$res = $mysqli->query($query);

$row = $res->fetch_object();

$title = utf8_decode(htmlspecialchars($row->title));
$text  = utf8_decode(htmlspecialchars($row->text));
$timestamp = strtotime($row->timestamp);
$timestamp = date("d M Y H:i", $timestamp);

$content = <<<END

<head>
	<link rel="stylesheet" href="css/guide_panel_style.css">
</head>
		<div class="container">
			<div class="row margin-top-100">
				<div class="col-md-6">
						<div class="grinfo">
							<div class="panel panel-default">
								<div class="panel-heading">Titel: {$title}</div></br>
								Skriven av:</br>
								Publicerad: {$timestamp}<br><br>
								{$text}<br>	
							</div>
						</div>
				</div>
				<div class="col-md-6"></div>
			</div>
		</div>
END;

echo $header;
echo $content;
echo $footer;

?>