<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$content = <<<END


		<div class="row margin-top-100">	
			
			<div class="col-md-2">
			</div>	
			
			<div class="col-md-6 col-sm-6 search-content panel-width-550px panel panel-default">

	  			<div class="panel-heading panel-heading-560px">
					GameTeam
				</div>

				<div class="panel-body height-410px">
						
					<h4 class="quicksand text-bold">Introduktion</h4>
					<p class="text-normal quicksand text-16px">Vi är entusiatiska gamers som har valt att skapa en trevlig mötesplats på nätet för gamers.
					Här kan du utvexla dina efarenheter med andra gamers och prata om dina favoritspel. 
					Varmt välkommen!</p>
					<br>
					<!-- robert -->
								
					<ul class="media-list">
						<li class="media">
   							
							<div class="media-left white-a-text">	
        						<img class="media-object img-rounded" src="images/robert.jpg" width="128" class="ads" alt="Robert">
								<br>
								<a href="mailto:robjn@home.se" class="btn btn-sm btn-primary btn-block media-center text-center" role="button">
									<span class="glyphicon glyphicon-envelope" aria-hidden="true" class="pull-left"></span>&nbsp;Kontakt
								</a>
   							</div><!-- media left -->
							
							<div class="media-body">
								<h4 class="media-heading text-bold quicksand">
									Robert
								</h4>
   								<p class="text-normal quicksand">
									Gameteams Back-end programmör.
									Programmeringsspråk: PHP, MySQL, Javascript, jQuery, HTML5 och CSS3.
									<br>
									<br>
									Favoritspel: World of Warcraft, Monster Hunter och Phoenix Wright: Ace Attorney.
									<br>
									Övrigt: Kasten siger att du ska sätta in 2300 kr på hans jyskebank konto.
									<br>
									Andra intressen: Släktsforskning, amerikanska kulinariska delikatesser samt
									country musik med Brad Paisley.							
								</p>
   							</div><!-- media body -->
						</li><!-- media -->
					</ul><!-- media list -->
					
					<hr>
					<!-- dorte -->
						
					<ul class="media-list">
						<li class="media">
   							<div class="media-left white-a-text">	
	       						<img class="media-object img-rounded" src="images/dorte.jpg" width="128" class="ads" alt="Dorte">
								<br>
								<a href="mailto:dorand@home.se" class="btn btn-sm btn-primary btn-block media-center text-center" role="button">
									<span class="glyphicon glyphicon-envelope" aria-hidden="true" class="span-bottom"></span>&nbsp;Kontakt
								</a>
    						</div>
    						
							<div class="media-body">
    							<h4 class="media-heading text-bold quicksand">
									Dorte
								</h4>
								<p class="text-normal quicksand">
									Gameteams Front-end programmör.
									Programmeringsspråk: PHP, SQL, javascript, jQuery, HTML5 och CSS3.
									<br>
									<br>
									Favoritspel: Dragon Age serien och The Settlers serien.
									<br>
									Övrigt: Går ibland vilse vid Ica Maxi i Halmstad med en påse
									fläskesvål i handen och talar flytande grötig danska.
									<br>
									Andra intressen: Fotografera, digital grafik, musik, springa.
								</p>
    						</div><!-- media body -->
  						</li><!-- media -->
					</ul><!-- media list -->
					
					<hr>
					<!-- maria -->
					
					<ul class="media-list">
  						<li class="media">
    						<div class="media-left white-a-text">	
	        					<img class="media-object img-rounded" src="images/maria.jpg" width="128" class="ads" alt="Maria">
								<br>
								<a href="mailto:mardro@gameteam.se" class="btn btn-sm btn-primary btn-block media-center text-center" role="button">
									<span class="glyphicon glyphicon-envelope" aria-hidden="true" class="span-bottom"></span>&nbsp;Kontakt
								</a>
    						</div>
    						
							<div class="media-body">
      							<h4 class="media-heading text-bold quicksand">
									Maria
								</h4>
								<p class="text-normal quicksand">
									Gameteams huvudansvarliga grafiker och co-dokumentör.
									<br>
									Designer i: Photoshop och Illustrator.
									<br><br>
									Favoritspel: Halo.
									<br>
									Övrigt: Har blivit beroende på danska fläskesvål! De är dejlige!
									<br>
									Andra intressen: Design, fotografera, cafébesök med vännerna samt springa.
								</p>
    						</div><!-- media body -->
  						</li><!-- media -->
					</ul><!-- media list -->					
					
					<hr>
					<!-- malena -->
					
					<ul class="media-list">
  						<li class="media">
    						<div class="media-left white-a-text">	
	        					<img class="media-object img-rounded" src="images/malena.jpg" width="128" class="ads" alt="Malena">
								<br>
								<a href="mailto:maljan@gameteam.se" class="btn btn-sm btn-primary btn-block media-center text-center" role="button">
									<span class="glyphicon glyphicon-envelope" aria-hidden="true" class="span-bottom"></span>&nbsp;Kontakt
								</a>
    						</div>
    						
							<div class="media-body">
      							<h4 class="media-heading text-bold quicksand">
									Malena
								</h4>
								
								<p class="quicksand text-normal">Gameteams Scrum-ledare, huvudansvarlig för databas, samt co-backend programmör.
								Programmeringsspråk: C++, SQL, PHP.
								<br>
								<br>
								Favoritspel: World of Warcraft och Diablo III.								
								Övrigt: Spindeln i nätet. Har koll på allt och alla!
								<br><br>
								Andra intressen: Udda musikbands som Duck Sauce, The Singing Turkey With Fries On The Side samt Du-visste-inte-
								ens-det-fanns-sån-musik.								
																	
								</p>
    						</div><!-- media body -->
  						</li><!-- media -->
					</ul><!-- media list -->
  				</div><!-- panel body -->
			</div><!-- col md 6 -->
			
			<!-- right column -->
			<div class="col-md-3 margin-right-search pull-right">
				<div class ="ads">
					<img src="images/ad_req.jpg" class="ads pull-right" width="300px">
				</div><!-- ads -->
			</div><!-- col md 3 -->
			
		</div><!-- row -->
	
END;
echo $header;
echo $content; 
echo $footer;
?>