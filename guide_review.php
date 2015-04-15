<?php

/* master guide_review.php */

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$table = "guidereviewinfo";
$keeper = $_SESSION['keeperid'];
$feedback = "";
$admindelete = "";


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

			if($title == "" || $text == "")
			{
				$feedback = "<p class=\"feedback-yellow\">Fyll i alla fält</p>";
			}
			
			else
			{

				$query = <<<END

					INSERT INTO {$table}(title, text, timestamp)
					VALUES ('{$title}', '{$text}', CURRENT_TIMESTAMP);
END;
				 $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

				 $genre = $_POST["genretype"];
				 
				 $query = <<<END

				 	INSERT INTO genreguidereview(grid, genretype)
				 	VALUES (LAST_INSERT_ID(), '{$genre}')
END;
				$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
		        
				 $query = <<<END

				 	INSERT INTO userguidereview(grid, keeperid)
				 	VALUES (LAST_INSERT_ID(), '{$keeper}');
END;
				 $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
			}
			$feedback = "<p class=\"feedback-yellow\">Inlägget har publicerats</p>";
		}

		else if(isset($_POST['review']))
		{

			if($title == "" || $text == "" || $grade == "")
			{
				$feedback = "<p class=\"feedback-yellow\">Fyll i alla fält</p>";
			}

			else
			{

				$query = <<<END

					INSERT INTO {$table}(title, text, timestamp, grade)
					VALUES ('{$title}', '{$text}', CURRENT_TIMESTAMP, '{$grade}' );
				
END;
				$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

				$genre = $_POST["genretype"];
				 
				 $query = <<<END

				 	INSERT INTO genreguidereview(grid, genretype)
				 	VALUES (LAST_INSERT_ID(), '{$genre}')
END;
				$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
		        
	        	$query = <<<END

	        		INSERT INTO userguidereview(grid, keeperid)
	        		VALUES (LAST_INSERT_ID(), '{$keeper}');
END;
				$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
			}
			$feedback = "<p class=\"feedback-yellow\">Inlägget har publicerats</p>";
		}
	}


$query = <<<END

 	SELECT * FROM genre

END;
 $result = $mysqli->query($query) or die();

$dropdown = '<select name="genretype">';

while($row = $result->fetch_assoc())
{
	 $genretype = $row['genretype'];
	 
	 $dropdown .= <<<END
	 	<option value="{$genretype}">{$genretype}</option>
END;

}
$dropdown .= '</select>';


$content = <<<END

		<head>
			<link rel="stylesheet" href="css/guide_panel_style.css">
		</head>

		<div class="container">
			<div class="row margin-top-100">
				<div class="col-md-12"> 
							<div id="guide_review">
								<form action="guide_review.php" method="post" id="guide_review_form">
									<div class="panel panel-default">
										<div class="panel-heading">Skriva recension eller guide</div><br>
										<label for="title">Titel</label></Br>
										<input type="text" id="title" name="title" value="" placeholder="Ange titeln"></br></br>
										<input type="radio" id="guidecheck" name="guide" value="Guide">Guide
										<input type="radio" id="reviewcheck" name="review" value="Review">Recension</br></br>
										{$feedback}
										<label for="genretype">Genre</label><br>
										{$dropdown}<br><br>
										<label for="information">Innehållet:</label>
										<textarea id="nicEdit" name="nicEdit" cols="80" rows="15"></textarea></br>
										<label for="grade" id="gradescale">Betyg (1-5)</label></br>
										<input type="number" id="grade" name="grade" min="1" max="5" value="">
										<button type="submit" id="publish" name="publish_guide_review" value="Publicera">Publicera innehållet</button><br><br>
										{$admindelete}
										</div>
									</div>
								</form>			
							</div>
						
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="js/nicEdit.js"></script>
		<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

	<script>

	$(document).ready(function(){
		$('#grade').hide();
		$('#gradescale').hide();
		$('#reviewcheck').click(function(){
			$('#grade').show();
			$('#gradescale').show();
		});
		$('#guidecheck').click(function(){
			$('#grade').hide();
			$('#gradescale').hide();
		});
	});	
	</script>

	<script>
	$(document).ready(function () {
  $('input[type=radio]').prop('checked', false);
  $('input[type=radio]:first').prop('checked', true)

  $('input[type=radio]').click(function (event) {
    $('input[type=radio]').prop('checked', false);
    $(this).prop('checked', true);

  
  });
});
	</script>


END;


echo $header;
echo $content;
echo $footer;
?>