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
$getflag = "";
$commentid = "";
$feedback = "";
$grbutton = "";

	$query = <<<END

		INSERT INTO userclick (grid, keeperid)
		VALUES ('{$grid}', '{$keeper}');
END;

$res = $mysqli->query($query);

if(isset($_POST['unappropriate']))
{
	
		$getflag = <<<END
		UPDATE guidereviewinfo SET flag = 1
		WHERE grid = '{$grid}';
END;
		$res = $mysqli->query($getflag) or die("Could not query database" . $mysqli->errno . 
			        " : " . $mysqli->error);
	
	
}
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
	$flag = $row->flag;

	if($flag == 0)
	{
		$grbutton = <<<END
		
		<div class="pull-right">
				<button type="submit" name="unappropriate" value="flag" class="btn btn-xs btn-success pull-left margin-left-50px" onclick="return confirm('Vill du flagga detta som olämpligt?')"
				title="Flagga för stötande innehåll till moderator">&nbsp;
					<span class="glyphicon glyphicon-flag pull-right text-white text-bold text-14px" aria-hidden="true"></span>
				</button>
			</div>
END;
	}
	else
	{
		$grbutton = <<<END
		
		<div class="pull-right">
				<button class="btn btn-xs btn-danger pull-left margin-left-50px" title="Flaggat till moderator">&nbsp;
					<span class="glyphicon glyphicon-flag pull-right text-white text-bold text-14px" aria-hidden="true"></span>
				</button>
			</div>
END;
		
	}
	if($grade > 0){
		$showgrade = <<<END
		Betyg: {$grade}
END;
	}
}


if(isset($_POST['unappropriatecomments']))
{
	$flaggedCommentId = $_GET["commentid"];

	$getflag = <<<END
	UPDATE comment SET flag = 1
	WHERE commentid = '{$flaggedCommentId}';
END;
	$res = $mysqli->query($getflag) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

}

if(!empty($_POST))
{
	if(isset($_POST['publishcomment']))
	{
		$comment = ($_POST["comment"]);

		$comment  = utf8_encode($mysqli->real_escape_string($comment));

		if(strlen($comment) > 1000 )
		{
			$feedback = "<p class=\"text-red\">Kommentaren är för lång</p>";
		}
		else
		{

			if($comment == '')
			{
				$feedback = "<p class=\"text-red\">Du måste skriva något</p>";
			}
			else
			{
			$query = <<<END
				INSERT INTO comment (keeperid, grid, comment, timestamp)
				VALUES ('{$keeper}', '{$grid}', '{$comment}', CURRENT_TIMESTAMP);
END;
			$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
			        " : " . $mysqli->error);;
			}
		}
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
		$commentid = $row->commentid;
		$commentkeeperid = $row->keeperid;
		$commentkeepername = $row->keepername;
		$comment = utf8_decode($row->comment);
		$date = strtotime($row->timestamp);
		$date = date("d M Y H:i", $date);
		$commentflag = $row->flag;

		if($commentflag == 0)
		{
			$buttons = <<<END
			<div class="pull-right">
				<button type="submit" name="unappropriatecomments" value="flag" class="btn btn-xs btn-success pull-left margin-left-50px" onclick="return confirm('Vill du flagga detta som olämpligt?')"
				title="Flagga för stötande innehåll till moderator">&nbsp;
					<span class="glyphicon glyphicon-flag pull-right text-white text-bold text-14px" aria-hidden="true"></span>
				</button>
			</div>		
END;
		}
		else
		{
			$buttons = <<<END
			<div class="pull-right">
				<button class="btn btn-xs btn-danger pull-left margin-left-50px" title="Flaggat till moderator">&nbsp;
					<span class="glyphicon glyphicon-flag pull-right text-white text-bold text-14px" aria-hidden="true"></span>
				</button>
			</div>			
END;
		
		}
		$comments .=  <<<END

		<!-- flagga -->
			<form action="genre.php?grid={$grid}&commentid={$commentid}" method="post">
				{$buttons}
			</form>
			Skriven av: <a href="profile.php?keeperid={$keeperid}">{$commentkeepername}</a>
		
			<br>
			Datum: {$date}<br>
			{$comment}
			<hr>
END;

//span class="glyphicon glyphicon-flag pull-right" aria-hidden="true">
	}

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
								
								<div class="panel-body panel-genre-body">								
									<form action="genre.php?grid={$grid}" method="post">
										{$grbutton}
									</form>
									Skriven av: <a href="profile.php?keeperid={$keeperid}">{$keepername}</a>
									
									
									</br>
																	
									Publicerad: {$timestamp}<br><br>
									{$text}<br>	
								</div><!-- panel body -->
								
																
							<div class="comments">
							{$feedback}
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