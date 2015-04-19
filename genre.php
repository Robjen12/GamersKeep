<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = isset($_GET['grid']) ? $_GET['grid'] : '';
$showgrade = "";
$text = "";
$title = "";
$timestamp = "";
$comments = "";

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


if($res->num_rows ==1)
{
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
}

if(!empty($_POST))
{
	if(isset($_POST['publishcomment']))
	{
		$comment = ($_POST["comment"]);

		$comment  = utf8_encode($mysqli->real_escape_string($comment));

		$query = <<<END
			INSERT INTO comment (keeperid, grid, comment, timestamp)
			VALUES ('{$keeper}', '{$grid}', '{$comment}', CURRENT_TIMESTAMP);
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
			        " : " . $mysqli->error);;

	}
}
$query = <<<END
	
	SELECT * FROM comment
	WHERE grid = '{$grid}'
	ORDER BY timestamp DESC;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
			        " : " . $mysqli->error);

	while($row = $res->fetch_object())
	{
		$comment = utf8_decode(htmlspecialchars($row->comment));
		$date = strtotime($row->timestamp);
		$date = date("d M Y H:i", $date);

		$comments .=  <<<END

		Skriven av: keepername <!-- flagga --><a href="#" alt="Markera stötande innehåll">
		<span class="glyphicon glyphicon-flag pull-right" aria-hidden="true"></span></a><br>
		Publicerad: {$date}<br>
		{$comment}
		<hr>
END;
	}

$content = <<<END

		<div class="wrapper margin-top-100">
			<div class="row">
				<div class="content-genre col-md-8 margin-genre pull-left">
						<div class="grinfo">
							<div class="panel panel-default panel-genre pull-left">
								<div class="panel-heading panel-heading-genre quicksand">{$title}
								<li class="views">{$showgrade}</li>
								</div><!-- panel heading -->
								
								<div class="panel-body">
								
									Skriven av: keepername <!-- flagga --><a href="#" alt="Markera stötande innehåll">
										<span class="glyphicon glyphicon-flag pull-right" aria-hidden="true"></span></a>
										</br>
									Publicerad: {$timestamp}<br><br>
									{$text}<br>
								
							</div><!-- panel -->
							
							<div class="comments">
								<form action="genre.php?grid={$grid}" method="post">
									<h3>Kommentarer</h3>
									<textarea id="comment" name="comment" cols="80" rows="5"></textarea>
									<input type="submit" id="submit" name="publishcomment" value="Kommentera">
								</form>
							</div><!-- comments -->
							
							<div class="showcomments">
								<div class="panel panel-default">
									{$comments}
									
									
								</div><!-- panel -->
							</div><!-- show comments -->
						</div><!-- grinfo -->
				</div>
				<div class="col-md-6"></div>
			</div>
		</div>
END;

echo $header;
echo $content;
echo $footer;

?>