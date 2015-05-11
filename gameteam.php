<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$content = <<<END


		<div class="row margin-top-100">
			
			<div class="col-md-2 col-sm-2">
			</div>
			
			<div class="col-md-6 col-sm-6 search-content panel-width-550px panel panel-default">

	  			<div class="panel-heading panel-heading-560px">GameTeam</div>

  					<div class="panel-body height-410px">
						
						<h4 class="quicksand text-bold">Introduktion</h4>
						<p>Vi är hardcore gamers som har valt att skapa en mötesplats på nätet för gamers.
						Här kan du utvexla dina efarenheter med andra gamers och prata om dina favoritspel. 
						Varmt välkommen!</p>
						<br>

						<!-- robert -->
						
						<ul class="media-list">
  							<li class="media">
    							<div class="media-left">	
	        						<img class="media-object img-rounded" src="http://placehold.it/124x124" class="ads" alt="Robert">
    							</div>
    							
								<div class="media-body">
      								<h4 class="media-heading text-bold quicksand">
									Robert, 300 år.
									<br><br>
								
									<p class="text-normal">4 fruar i olika delar av världen, 2 i WoW, samt 21 barn.
									Favoritspel: World of Warcraft, Diablo III, Monster Hunter och Dragon Age.
									<br><br>
									Programmeringsspråk: PHP, MySQL, HTML5 och CSS3.<br>
									Övrigt: Kasten siger att du ska sätta in 2300 kr på hans jyskebank konto.								
									</p>
    							</div>
  							</li>
						</ul><!-- media list -->
						
						<hr>
						
						<!-- dorte -->
						
						<ul class="media-list">
  							<li class="media">
    							<div class="media-left">	
	        						<img class="media-object img-rounded" src="http://placehold.it/124x124" class="ads" alt="Robert">
    							</div>
    							
								<div class="media-body">
      								<h4 class="media-heading text-bold quicksand">
									Dorte, 599 år.<br><br>
								
									<p class="text-normal">4 fruar i olika delar av världen, 2 i WoW, 1 i Dragon Age, samt 25 barn.
									Favoritspel: Dragon Age, Dragon Age och Dragon Age.
									<br><br>
									Programmeringsspråk: PHP, MySQL, HTML5 och CSS3.<br><br><br>
									Övrigt: Går ibland vilse vid Ica Maxi i Halmstad med en påse
									fläskesvål i handen och pratar flytande grötigt danska.
									</p>
    							</div>
  							</li>
						</ul><!-- media list -->
						<hr>
						<ul class="media-list">
  							<li class="media">
    							<div class="media-left">	
	        						<img class="media-object img-rounded" src="http://placehold.it/124x124" class="ads" alt="Robert">
    							</div>
    							
								<div class="media-body">
      								<h4 class="media-heading text-bold quicksand">
									Maria, 150 år.<br><br>
								
									<p class="text-normal">4 sugardaddies i olika delar av världen, 2 i Grönland, inga barn än.
									Favoritspel: Halo, Halo och HALOOOOO.
									<br><br>
									Designer i: Photoshop och Illustrator<br><br><br>
									Övrigt: Alltid på utskick efter ännu en sugardaddy, ju fler ju bättre!
									Ring mig på: 0606060606!
																		
									</p>
									
    							</div>
  							</li>
						</ul><!-- media list -->
						
						<hr>
						
						<ul class="media-list">
  							<li class="media">
    							<div class="media-left">	
	        						<img class="media-object img-rounded" src="http://placehold.it/124x124" class="ads" alt="Robert">
    							</div>
    							
								<div class="media-body">
      								<h4 class="media-heading text-bold quicksand">
									Malena, 350 år.<br><br>
								
									<p class="text-normal">2 fruar i olika delar av världen, samt 2 män i WoW, och 1 barn.
									Favoritspel: World of Warcraft, Diablo III, Talking Tom 2.
									<br><br>
									Programmeringsspråk: C++, MySQL, PHP, DVD, CD.<br><br>
									Övrigt: Spindeln i nätet! Har koll på allt och alla!
																		
									</p>
    							</div>
  							</li>
						</ul><!-- media list -->
						
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