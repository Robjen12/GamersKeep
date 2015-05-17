<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$content = <<<END

	<div class="row margin-top-100">
		
		<div class="col-md-2 col-sm-2">
		</div>
		
			<div class="col-md-6 col-sm-6 margin-top-100 setting panel-width-550px panel panel-default">

			<div class="panel-heading panel-heading-560px">Policy</div>
			
				<div class="panel-body height-410px pull-left quicksand">
					
					För allas trivsel har vi skapat en policy, som innehåller några enkla regler. Detta för att vi gärna
					vill dela vår spelglädje med andra likasinnade utan att någon ska bli påhoppade. Vi förväntar därför
					att våra med-gamers delar med sig
					av sin spelglädje på ett sätt som:
					<br><br>
					<span class="badge badge-info">1</span> Gynnar alla oavsett ras, kön, religion eller sexuell orientering.
					<br><br>
					<span class="badge badge-info">2</span> Med ömsesidigt respekt.
					<br><br>
					<span class="badge badge-info">3</span> Erfarna användare utmanas att välkomma nybörjare.
					<br><br>
					<span class="badge badge-info">4</span> Inga spelgenrer är bättre än andra.
					<br><br>
					<span class="badge badge-info">5</span> Personliga påhopp tolereras ej. Alla stötliga inlägg rapporteras till moderatorer
					som hanterar busar.							
					<br><br>
					<span class="badge badge-info">6</span> Ha roligt och prata entusiastiskt om dina favoritspel.
					Argumentera gärna varför de är dina favoriter!							
					<br><br>
					<span class="badge badge-info">7</span> Din mejl address samt namn distribuerar vi ej vidare till tredje part, den
					hanteras enligt PUL.
					<br>				
					
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