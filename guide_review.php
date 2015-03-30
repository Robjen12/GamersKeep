<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$table = "guidereviewinfo";
$keepername = $_SESSION['keepername'];
$feedback = "";

	if(!empty($_POST))
	{

		$title	= $_POST['title'];
		$text 	= $_POST['nicEdit'];
		$grade	= $_POST['grade'];

		$title = utf8_encode($mysqli->real_escape_string($title));
		$text  = utf8_encode($mysqli->real_escape_string($text));
		$grade = utf8_encode($mysqli->real_escape_string($grade));


		if(isset($_POST['guide']))
		{

		$query = <<<END

			INSERT INTO {$table}(title, text, timestamp)
			VALUES ('{$title}', '{$text}', CURRENT_TIMESTAMP);
END;
		 $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
        " : " . $mysqli->error);

		 $query = <<<END

		 	INSERT INTO userguidereview(grid, keepername)
		 	VALUES (LAST_INSERT_ID(), '{$keepername}');
END;
		 $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
        " : " . $mysqli->error);
		}
		else if(isset($_POST['review']))
		{

			if($grade == "")
			{
				$feedback= "<p class=\"feedback-yellow\">Måste välja betyg</p>";
			}

			else
			{

			$query = <<<END

				INSERT INTO {$table}(title, text, timestamp, grade)
				VALUES ('{$title}', '{$text}', CURRENT_TIMESTAMP, '{$grade}' );
			
END;
			$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	        " : " . $mysqli->error);

        	$query = <<<END

        		INSERT INTO userguidereview(grid, keepername)
        		VALUES (LAST_INSERT_ID(), '{$keepername}');
END;
			$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	        " : " . $mysqli->error);
			}
		}
	}


$content = <<<END

		<div id="container">
			<div class="row">
				<div class="col-md-4">
					<div id="guide_review">
						<form action="guide_review.php" method="post" id="guide_review_form">
							<label for="title">Titel</label></Br>
							<input type="text" id="title" name="title" value="" placeholder="Ange titeln"><br></br>
							<input type="checkbox" id="guidecheck" name="guide" value="Guide">Guide
							<input type="checkbox" id="reviewcheck" name="review" value="Review">Recension</Br></br>
							<label for="information">Innehållet:</label>
							<textarea id="nicEdit" name="nicEdit" cols="80" rows="20"></textarea></br>
							{$feedback}
							<label for="grade">Betyg</label><br>
							<input type="number" id="grade" name="grade" min="1" max="5" value="" placeholder="Ange betyg här">
							<button type="submit" id="publish" name="publish_guide_review" value="Publicera">Publicera innehållet</button>
						</form>
					</div>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4"></div>
			</div>
		</div>
		
		<script type="text/javascript" src="js/nicEdit.js"></script>
		<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

	<script>

	$(document).ready(function(){
		$('#grade').hide();
		$('#reviewcheck').click(function(){
			$('#grade').show();
		});
		
	});	
	</script>


END;

echo $header;
echo $content;
echo $footer;
?>