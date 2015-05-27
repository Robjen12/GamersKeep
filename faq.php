<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$content = <<<END

	<div class="row margin-top-100">
		
		<div class="col-md-3 col-sm-3 margin-top-100 panel panel-default panel-width-330px pull-left">
			<div class="panel-heading panel-heading-340px">
			left
			</div>
		</div><!-- col md 3 -->
		
		<div class="col-md-6 col-sm-6 margin-top-100 panel panel-default pull-left">

			<div class="panel-heading">
				FAQ - Frequently asked questions
			</div><!-- panel heading -->
			
			<div class="panel-body height-410px pull-left quicksand">
					
				<h4 class="quicksand text-bold">Frågor som oftast ställas:</h4>
				<br>
				
				<span class="badge badge-warning">1</span> Hur hittar jag min kompis här?
				<br>
				<br>
				<span class="badge badge-success">2</span> Klick på forstorningsglaset för att öppna sökrutan.
				Sök på det namn din kompis har registrerat sig med här på GamersKeep, och klick sedan på länkan. 
				<br><br>
				<span class="badge badge-info">3</span> Erfarna gamers utmanas att välkomma nybörjare.
				<br><br>
				<span class="badge badge-info">4</span> Inga spelgenrer är bättre än andra.
				<br><br>
				<span class="badge badge-info">5</span> Personliga påhopp tolereras ej. Alla stötliga inlägg rapporteras till moderatorer
				som hanterar busar.							
				<br><br>
				<span class="badge badge-info">6</span> Din mejl address samt namn distribuerar vi ej vidare till tredje part, den
				hanteras enligt PUL.					
				<br><br>
				<span class="badge badge-info">7</span> Ha roligt och prata entusiastiskt om dina favoritspel.
				Argumentera gärna varför de är dina favoriter!
				<br>				
					
			</div><!-- panel body -->
			
		</div><!-- col md 6 -->
			
		<!-- right column -->
		<div class="col-md-3 margin-top-100 pull-left">
			<div class"margin-ads pull-left">
				<img src="images/ad_req.jpg" class="pull-right" width="300px">
			</div>
		</div><!-- col md 6 -->
	</div><!-- row -->

END;

echo $header;
echo $content;
echo $footer;
?>