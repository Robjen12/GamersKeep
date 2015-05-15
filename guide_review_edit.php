<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$grid = isset($_GET['grid']) ? $_GET['grid'] : "";
$feedback = "";
$dropdown = "";
$grades = "";

//NYTT
if(!empty($_GET))
{

	$query = <<<END

		SELECT * 
		FROM guidereviewinfo
		WHERE grid = '{$grid}';
END;
	
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

		if($res->num_rows == 1)
		{
			if($row = $res->fetch_object())
			{

				$edittitle = utf8_decode(htmlspecialchars($row->title));
				$edittext = utf8_decode(htmlspecialchars($row->text));
				$editgrade = $row->grade;

				if($editgrade > 0)
				{
					$guideorreview = <<<END
					<input type="radio" id="reviewcheck" name="review" value="Review">Recension</br></br>
					
									
END;
					$grades = <<<END
					<label for="grade" id="gradescale">Betyg (1-5)</label></br>
					<input type="number" class="text-black" id="grade" name="grade" min="1" max="5" value="{$editgrade}">
END;
				}
				if($editgrade == NULL)
				{
					$guideorreview = <<<END
					<input type="radio" id="guidecheck" name="guide" value="Guide">Guide</br></br>
									
END;

				}
			}
		}
if(isset($_POST['guide']))
{
	$edittitle	= $_POST['title'];
	$edittext 	= ($_POST['nicEdit']);

	$edittitle = utf8_encode($mysqli->real_escape_string($edittitle));
	$edittext  = utf8_encode($mysqli->real_escape_string($edittext));

	$query = <<<END

	UPDATE guidereviewinfo SET title = '$edittitle', text = '$edittext' 
	WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	$genre = $_POST["genretype"];

	$query = <<<END

	UPDATE genreguidereview SET genretype = '$genre' 
	WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
		        
	$feedback = "<p class=\"text-green\">Inlägget har uppdaterats</p>";
}

if(isset($_POST['review']))
{

	$edittitle	= $_POST['title'];
	$edittext 	= ($_POST['nicEdit']);
	$editgrade = $_POST['grade'];

	$edittitle = utf8_encode($mysqli->real_escape_string($edittitle));
	$edittext  = utf8_encode($mysqli->real_escape_string($edittext));

	$query = <<<END

	UPDATE guidereviewinfo SET title = '$edittitle', text = '$edittext', grade = '$editgrade'
	WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	$genre = $_POST["genretype"];

	$query = <<<END

	UPDATE genreguidereview SET genretype = '$genre' 
	WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
		        
	$feedback = "<p class=\"text-green\">Inlägget har uppdaterats</p>";
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

// SLUT NYTT

$content = <<<END

		<div class="container-fluid">
			<div class="row margin-top-100">
				<div class="col-md-12 margin-left-guide"> 
							<div id="guide_review">
								<form action="guide_review_edit.php?grid={$grid}" method="post" id="guide_review_form">
									<div class="panel panel-default panel-genre">
										<div class="panel-heading panel-heading-genre">Redigera recension eller guide
										</div><!-- panel heading -->
						
										<div class="panel body panel-genre margin-skriva skriva">
										<label for="title"><h3 class="quicksand">Titel</h3></label>
										<br>
										<input type="text" class="form-control" id="title" name="title" value="{$edittitle}" placeholder="Ange titeln"></br></br>
										{$guideorreview}
										{$feedback}
										<label for="genretype">Genre</label><br>
										{$dropdown}<br><br>
										<label for="information">Innehållet:</label>
										<textarea id="nicEdit" name="nicEdit" cols="80" rows="15">{$edittext}</textarea></br>
										{$grades}
										<button type="submit" id="submit" name="updaterevgui">Spara ändringar</button>
										</div>
									</div>
								</form>			
							</div>
						
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="js/nicEdit.js"></script>
		<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">

 		 bkLib.onDomLoaded(function() {
       		 new nicEditor({buttonList : ['bold','italic','underline', 'center', 'left', 'right']}).panelInstance('nicEdit');
       
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