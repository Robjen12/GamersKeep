<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$table = "guidereviewinfo";
$keepername = "keepername";

if(isset($_POST['publish_guide_review']))
{

	if(!empty($_POST))
	{

		$guidetitle = $_POST['title'];
		$guidetext = $_POST['nicEdit'];

		$guidetitle = utf8_encode($mysqli->real_escape_string($guidetitle));
		$guidetext  = utf8_encode($mysqli->real_escape_string($guidetext));

		$query = <<<END

			INSERT INTO {$table}(title, text, timestamp)
			VALUES ('{$guidetitle}', '{$guidetext}', CURRENT_TIMESTAMP);
END;
		 $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
        " : " . $mysqli->error);
		 $query = <<<END

		 	INSERT INTO userguidereview(grid, keepername)
		 	VALUES (LAST_INSERT_ID(), {$keepername})
END;
		 $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
        " : " . $mysqli->error);
	}
}
$content = <<<END

<!DOCTYPE html>
<html>

	<head></head>
	<body>
		<div id="container">
			<div class="row">
				<div class="col-md-4">
					<div id="guide_review">
						
						<form action="guide_review.php" method="post" id="">
							<input type="checkbox" name="guide" value="Guide">Guide
							<input type="checkbox" name="recension" value="Recension">Recension</Br></br>
							<label for="title">Titel</label></Br>
							<input type="text" id="title" name="title" value="" placeholder="Ange titeln"><br></br>
							<label for="information">Innehållet:</label>
							<textarea id="nicEdit" name="nicEdit" cols="80" rows="20"></textarea></br>
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
		
	</body>
</html>
END;

echo $header;
echo $content;
echo $footer;
?>