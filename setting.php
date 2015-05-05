<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeperid = $_SESSION['keeperid'];

$content = <<<END



	<div class="row margin-top-100">
		
		<div class="col-md-2 col-sm-2">
		</div>
		
		<div class="col-md-6 col-sm-6 margin-top-100 setting panel-width-550px panel panel-default">

			<div class="panel-heading panel-heading-560px">Inställningar</div>
			
				<div class="panel-body height-410px pull-left">
				
					<form action="upload.php" method="post" enctype="multipart/form-data">
					<h4 class="quicksand text-bold">Ladda upp profilbild</h4>
						<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
						<input name="userfile" type="file" id="userfile">
						<br>
						
						
							<button class="btn-sm-span pull-left margin-right-span-10px" input name="upload" type="submit" id="upload" value="">
								<span class="glyphicon glyphicon-ok text-success pull-right" aria-hidden="true"></span>
							</button>
							<button class="btn-sm-span pull-left" input name="upload" type="reset" id="upload" value="">
								<span class="glyphicon glyphicon-remove text-danger pull-right" aria-hidden="true">
							</span></button>
						
						
						<div class="col-md-11 pull-left">
							
						</div>
						
					</form><br><br>
					
					<h4 class="quicksand text-bold">Ta bort kontot</h4>
					<p>Önskar du inte längre delta i GamersKeep, kan du ta bort din profil vid att klicka på knappen nedan.
					Tänk på att all din information raderas om du tar bort din profil, även alla dina inlägg här på GamersKeep.
					</p>
					<a class="login" href="delete.php?keeperid={$keeperid}"><button class="btn btn-danger">Ta bort din profil</button></a>
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