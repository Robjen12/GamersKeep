<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeperid = $_SESSION['keeperid'];

$content = <<<END

	<div class="row">
		<div class="col-md-6 margin-top-100">
			<div class="settings">
			<h2>Inställningar</h2>
				<form action="upload.php" method="post" enctype="multipart/form-data">
				<h4><b>Ladda upp profilbild<b></h4>
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
					<input name="userfile" type="file" id="userfile"> <br>
					<input name="upload" type="submit" class="box" id="upload" value="Spara bild">
				</form><br><br>
			<h4><b>Ta bort kontot<b></h4>
			<button><a href="delete.php?keeperid={$keeperid}">Ta bort kontot</a></button>
			</div>
		</div>

	</div>
END;

echo $header;
echo $content;
echo $footer;
?>