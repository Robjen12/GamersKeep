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
$commmentkeepername = "";
$keepername = "";
$keeperid = "";
	$query = <<<END

		INSERT INTO userclick (grid, keeperid)
		VALUES ('{$grid}', '{$keeper}');
END;

$res = $mysqli->query($query);

$query = <<<END

	SELECT *
	FROM guidereviewinfo
    JOIN userguidereview
    ON guidereviewinfo.grid = userguidereview.grid
    JOIN user
    ON userguidereview.keeperid = user.keeperid
	WHERE guidereviewinfo.grid = '{$grid}'
    GROUP BY guidereviewinfo.grid;
END;

$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

if($res->num_rows ==1)
{
	$row = $res->fetch_object();

	$keeperid = $row->keeperid;
	$keepername = $row->keepername;
	$title = utf8_decode($row->title);
	$text  = utf8_decode($row->text);
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
	JOIN user
	ON comment.keeperid = user.keeperid
	WHERE grid = '{$grid}'
	ORDER BY timestamp DESC;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
			        " : " . $mysqli->error);

	while($row = $res->fetch_object())
	{
		$commentkeeperid = $row->keeperid;
		$commentkeepername = $row->keepername;
		$comment = utf8_decode($row->comment);
		$date = strtotime($row->timestamp);
		$date = date("d M Y H:i", $date);

		$comments .=  <<<END

		Skriven av: <a href="profile.php?keeperid={$keeperid}">{$commentkeepername}</a> <!-- flagga --><a href="#" class="flag" alt="Markera stötande innehåll">
		<span class="glyphicon glyphicon-flag pull-right" aria-hidden="true"></span></a><br>
		Publicerad: {$date}<br>
		{$comment}
		<hr>
END;


	}

	$getflag = <<<END
		UPDATE guidereviewinfo SET flag = 1
		WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($getflag) or die("Could not query database" . $mysqli->errno . 
			        " : " . $mysqli->error);
$content = <<<END

		<div class="wrapper margin-top-100">
			<div class="row">
			
				<div class="content-genre col-md-8 margin-genre pull-left">
						<div class="grinfo">
							<div class="panel panel-default panel-genre pull-left">
								<div class="panel-heading panel-heading-genre quicksand">
									{$title}
									<li class="views">{$showgrade}</li>
								</div><!-- panel heading -->
								</br>
								
								<div class="panel-body">								
									
									Skriven av: <a href="profile.php?keeperid={$keeperid}">{$keepername}</a>
									<!-- flagga --><a href="genre.php?grid={$grid}" class="flag" alt="Markera stötande innehåll">
									<span class="glyphicon glyphicon-flag pull-right" aria-hidden="true"></span></a>
									</br>
																	
									Publicerad: {$timestamp}<br><br>
									{$text}<br>	
								</div><!-- panel body -->
								
																
							<div class="comments">
								<form action="genre.php?grid={$grid}" method="post" class="quicksand text-bold">
									<h3>Kommentera</h3>
									<textarea id="comment" name="comment" cols="80" rows="6"></textarea>
									</br>
									
									<button type="submit" class="btn btn-primary btn-sm pull-left text-bold login-text
									text-white" id="submit" name="publishcomment" value="Kommentera">Kommentera
									</button>
									</br></br>
								</form>

								
								</div><!-- comments -->
							
						
						
						</div>
							
							
							<div class="showcomments">
								<div class="panel panel-default panel-genre pull-left">
									<div class="panel-heading panel-heading-genre quicksand">
										Kommentarer
									</div><!-- panel heading -->
								
								<div class="panel-body">
									
									{$comments}
								</div><!-- panel body -->
									
								
								</div>
							</div><!-- show comments -->
							
							
						</div>

				</div>
				
			</div>
		</div>
	<script>
	$(document).ready(function(){
		$('.flag')click(function(){
			{$getflag}
		});
	});
	</script>
END;

echo $header;
echo $content;
echo $footer;

?>