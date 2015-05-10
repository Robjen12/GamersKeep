<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$profil_bild = <<<END
			<img src="images/profil_bild.png">	
END;

$keeperid = $_SESSION['keeperid'];
$keepername = $_SESSION['keepername'];

$query = <<< END
	
	SELECT picname, type, size, link
	FROM picture
	JOIN userpic
	ON userpic.picid = picture.picid
	WHERE keeperid = '{$keeperid}';
END;

	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	
			if($res->num_rows > 0)
				{
					if($row = $res->fetch_object())
					{
						$link = $row->link;

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
					
					<div class="profil_bild pull-left">
						{$profil_bild}
					</div>
					<br><br><br><br><br><br><br>
					<div class="pull-left text-bold">
						{$keepername}
					</div>
					<br><br>
						<form action="upload.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
						<input name="userfile" type="file" id="userfile">
						
						<br>
						
						
							<button class="btn-sm-span pull-left margin-right-span-10px" input name="upload" type="submit" id="upload" value="">
								<span class="glyphicon glyphicon-ok text-success pull-right" aria-hidden="true"></span>
							</button>
							<button class="btn-sm-span pull-left" input name="upload" type="reset" id="upload" value="">
								<span class="glyphicon glyphicon-remove text-danger pull-right" aria-hidden="true">
							</span></button>
						</form>							
					<br><br>
					
					<h4 class="quicksand text-bold">Ta bort kontot</h4>
					<p>Önskar du inte längre delta i GamersKeep, kan du ta bort din profil vid att klicka på knappen nedan.
					Tänk på att all din information raderas om du tar bort din profil, även alla dina inlägg här på GamersKeep.
					</p>
					
					<div class="pull-left white-a-text">
						<a href="delete.php?keeperid={$keeperid}" role="button" class="btn btn-danger white-a-text" onclick="return confirm('Vill du verkligen ta bort kontot?')">
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