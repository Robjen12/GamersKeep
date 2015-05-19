<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeperid = $_SESSION['keeperid'];
$feedback = "";

$uploadDir = 'pictures/';

if(isset($_POST['upload']))
{
$fileName = $_FILES['userfile']['name'];
$tmpName = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

// get the file extension first
$ext = substr(strrchr($fileName, "."), 1); 

// make the random file name
$randName = md5(rand() * time());

$filePath = $uploadDir . $randName . '.' . $ext;

$result = move_uploaded_file($tmpName, $filePath);
if (!$result) {
echo "Något gick snett med uppladdningen.";
exit;
}

if(!get_magic_quotes_gpc())
{
$fileName = addslashes($fileName);
$filePath = addslashes($filePath);
}

if(isset($filePath))
{
	$query = <<<END

	DELETE FROM userpic
	WHERE keeperid = '{$keeperid}'
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}

$query = <<<END
	INSERT INTO picture (picname, size, type, link )
	VALUES ('$fileName', '$fileSize', '$fileType', '$filePath');
END;
 	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
 $query = <<<END
 	INSERT INTO userpic(picid, keeperid)
 	VALUES (LAST_INSERT_ID(), '{$keeperid}');
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);



$feedback = "<p class=\"text-green pull-left\">uppladdad</p>";
}

$profil_bild = <<<END
			<img src="images/profil_bild.png">	
END;

$keeperid = $_SESSION['keeperid'];
$keepername = $_SESSION['keepername'];

// Hämtar ut bild från databasen kopplat till användaren.
$query = <<< END
	
	SELECT picname, type, size, link
	FROM picture
	JOIN userpic
	ON userpic.picid = picture.picid
	WHERE keeperid = '{$keeperid}';
END;

	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

// Om resultatet är större än noll utförs blocket.	
			if($res->num_rows > 0)
			{
					if($row = $res->fetch_object())
					{
						$link = $row->link;
// Om filen existerar visas den
						if(file_exists($link))
						{
							$profil_bild = <<<END
						<img src="{$link}">
END;
						}
	

					}
			}
	
$content = <<<END



	<div class="row margin-top-100">
		
		<div class="col-md-2 col-sm-2">
		</div>
		
			<div class="col-md-6 col-sm-6 margin-top-100 setting panel-width-550px panel panel-default">

			<div class="panel-heading panel-heading-560px">Inställningar</div>
			
				<div class="panel-body height-410px pull-left">
				
					<h4 class="quicksand text-bold">Profilbild</h4>
					
					<div class="profil_bild_container pull-left">
					{$feedback}
						<div class="profil_bild pull-left">
							{$profil_bild}
						</div>
					</div><!-- profil bild container -->
					
					<br><br><br><br><br><br><br>
					<div class="pull-left text-bold">
						{$keepername}
					</div>
					<br><br>
						<form action="setting.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
						<input name="userfile" type="file" id="userfile">	
										
						
							<button class="pull-left margin-right-span-10px btn btn-sm-span span-color-green" input name="upload" type="submit"
							id="upload" value="">
								<span class="glyphicon glyphicon-ok pull-right" aria-hidden="true"></span>
							</button>
							<button class="btn btn-sm-span span-color-red pull-left text-16px" input name="upload" type="reset" id="upload" value="">
								<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true">
							</span></button>
							
							
							
						</form>							
					<br><br>
					
					<h4 class="quicksand text-bold">Ta bort kontot</h4>
					<p>Önskar du inte längre delta i GamersKeep, kan du ta bort din profil vid att klicka på knappen nedan.
					Tänk på att all din information raderas om du tar bort din profil, även alla dina inlägg här på GamersKeep.
					</p>
					
					<div class="pull-left white-a-text">
						<a href="delete.php?keeperid={$keeperid}" role="button" class="btn btn-danger white-a-text"
						onclick="return confirm('Vill du verkligen ta bort kontot?')">
							Ta bort din profil
						</a>
					</div>
					
					
					
				</div><!-- panel body -->

			</div><!-- panel heading -->

					
				<!-- right column -->
						<div class="col-md-3 margin-right-search pull-right">

							<div class ="ads">

								<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

							</div><!-- ads -->
				</div><!-- col md 3 -->
				</div><!-- col md 6 -->
		</div>
	</div>
END;

echo $header;
echo $content;
echo $footer;
?>