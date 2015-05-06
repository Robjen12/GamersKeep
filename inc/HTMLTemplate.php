<?php

session_start();

include_once("inc/Connstring.php");

$genre = "";
$adminText = "";
$adminMeny = "";
$profilMeny = "";

if(isset($_SESSION['keepername']) && isset($_SESSION['roletype'])){

	if($_SESSION["roletype"] == 1)
	{
	$adminText = <<<END
		<span class="glyphicon glyphicon-king pull-right text-black" aria-hidden="true"></span>
END;
	$adminMeny = <<<END
	<li role="presentation"><a role="menuitem" tabindex="-1" href="admin.php">
	<span class="glyphicon glyphicon-king pull-right text-white" aria-hidden="true"></span>Admin</a>
	</li>	
END;
	
	$admindelete = <<<END
	<button type="submit" id="delete" name="delete" value="delete">Delete</button>
END;
	
	}
	else if($_SESSION["roletype"] == 0)
	{
	$profilMeny = <<<END
	<li role="presentation"><a role="menuitem" tabindex="-1" href="profile.php">
	<span class="glyphicon glyphicon-user pull-right text-white" aria-hidden="true"></span>Profil</a>
	</li>
END;
	}
}

$query = <<<END

	SELECT genretype FROM genre
END;
$res = $mysqli->query($query) or die();

if($res->num_rows > 0){

	while($row = $res->fetch_object())
	{

		$genretype = $row->genretype;

		$genre .= <<<END
		
			<li role="presentation"><a role="menuitem" tabindex="-1" href="choosegenre.php?genretype={$genretype}">{$genretype}</a></li>	
END;
	}
}

$header = <<<END
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Gamers Keep - Där Gamers Möts</title>

		<!-- bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<!-- gamerskeep style -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/mediaqueries.css">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<!-- http://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_event_on_multiple -->
<!-- soekanimation -->
<script>
$(document).ready(function(){
    $(".soek_button").on("mouseover", function(){
        $(".soek_anim").toggleClass(".soek_anim").stop(true, true).animate({
			width: 'toggle',
			Left: '0px'
		});
    });
	
		
	$(".soek_button").on("mouseout", function(){
        $(".soek_anim").toggleClass(".soek_anim").stop(true, true).animate({
			width: 'toggle',
			Right: '0px'
		});
    });
	
    $(".soek_anim").on("mouseover",function(){
        $(".soek_anim").toggleClass(".soek_anim").animate({
			width: '0'
		})
    });
	$(".soek_anim").on("mouseout",function(){
        $(".soek_anim").toggleClass(".soek_anim").animate({
			width: '0'
		})
    });
});
</script>

<!-- header ikoner -->
<!-- http://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_event_mouseover_mouseout -->
<script>
$(document).ready(function(){
    $(".soek_button").mouseover(function(){
        $(this).css("background-image", "url('images/search3.png')");
	});	
	$(".soek_button").mouseout(function(){
        $(this).css("background-image", "url('images/search2.png')");
    });
	$(".header_ikoner.header_profil").mouseover(function(){
        $(this).css("background-image", "url('images/profil3.png')");
	});
	$(".header_ikoner.header_profil").mouseout(function(){
        $(this).css("background-image", "url('images/profil2.png')");
    });
	$(".header_ikoner.header_genrer").mouseover(function(){
        $(this).css("background-image", "url('images/swords2.png')");
	});
	$(".header_ikoner.header_genrer").mouseout(function(){
        $(this).css("background-image", "url('images/swords.png')");
    });
	$(".header_ikoner.header_home").mouseover(function(){
        $(this).css("background-image", "url('images/home2.png')");
	});
	$(".header_ikoner.header_home").mouseout(function(){
        $(this).css("background-image", "url('images/home.png')");
    });
		$(".header_ikoner.header_write").mouseover(function(){
        $(this).css("background-image", "url('images/pen_meny2.png')");
	});
	$(".header_ikoner.header_write").mouseout(function(){
        $(this).css("background-image", "url('images/pen_meny.png')");
    });
});
</script>


	</head>
	<body>
		<div id="header" class="header-bg navbar navbar-default navbar-fixed-top no-border">
			
			<!-- Meny left with logo -->
			<div class="col-md-6 column-left margin-right-zero">
				<a href="index.php"><img src="images/logo-menu.png" class="img header-logo"></a>
				<div class="pull-right">
						

				</div><!-- pull right -->
			</div><!-- col md 6 -->
			
			<!-- center -->
			<div class="col-md-1 column-center pull-left margin-right-zero">
			
			
								
			</div><!-- col md 1 center -->
			
			<!-- Meny right -->
			<div class="col-md-5 column-right pull-right margin-right-zero nav nav-pills pull-right">
			
			
				<ul>
				
					<div class="dropdown">
				
					<ul class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="menu" aria-expanded="true">
					<a href="profile.php" alt="Profil"><div class="header_ikoner header_profil no-border pull-right"></div></a>
					</li>
			  		</ul>
					
					<ul class="dropdown-menu drop-margin-0 pull-right dropdown-top-margin Droid bg-gradient-brown" role="menu" aria-labelledby="dropdownMenu1">
			    			<li role="presentation" class="dropdown-header quicksand text-black text-bold text-16px"> {$_SESSION["keepername"]}{$adminText}</li>
							<li role="presentation" a role="menuitem" tabindex="-1">{$adminMeny}</li>
							<li role="presentation" a role="menuitem" tabindex="-1">{$profilMeny}</li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-education pull-right text-white" aria-hidden="true"></span>FAQ</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="setting.php"><span class="glyphicon glyphicon-cog pull-right text-white" aria-hidden="true"></span>Inställningar</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php"><span class="glyphicon glyphicon-off pull-right text-white" aria-hidden="true"></span>Logga ut</a></li>
							
			    		</ul>
					</div><!-- dropdown -->
					</li>
					
					
				
					<li><a href="index.php"><div class="header_ikoner header_home pull-right"></div></a></li>
					<li><a href="guide_review.php" alt="Skriv recension/guide"><div class="header_ikoner header_write pull-right"></div></a></li>
					
					<div class="dropdown">
						
		  				<ul class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="menu"
		  				 aria-expanded="true"><div class="header_ikoner header_genrer pull-right" alt="Genrer"></div>
			  			</ul>
				 							
		  				<ul class="dropdown-menu drop-margin-75px pull-right dropdown-top-margin Droid bg-gradient-brown" role="menu" aria-labelledby="dropdownMenu1">
			    			<li role="presentation" class="dropdown-header quicksand text-black text-bold text-16px">Genrer</li>
							<!-- laesa in genrer från db har -->
							{$genre}
			    		</ul>
					</div><!-- dropdown -->
					</li>
					
						
					
							
								<form action="search.php" method="GET" class="soek_form">
								<div class="soek_anim"></div>
								<button class="soek_button pull-right" type="Submit" value="Sök" alt="Sök">
								
								</button>
								<input type="text" class="form-control-search pull-right" id="searchfield" name="search" placeholder="Sök...">
								</form>
					
				</ul>
				
			</div><!-- meny right -->
			
			<!-- Meny left row2 -->
			<div class="col-md-9 column-left-row2 margin-left-zero no-border">
			</div><!-- col md 9 -->
			
			<!-- Meny left row2 -->
			<div class="col-md-3 column-right-row2 no-border">
			
			</div><!-- meny left row 2 -->
			
		</div> <!-- header -->

END;
$content = <<<END
		<div class="container-fluid">
		
END;
$footer = <<<END
<div id="footer" class="footer_bg">
			
			<!-- footer left with triangle to the right -->			
			<div class="col-md-9 column-left height-20px">
			
			</div><!-- col md 9 column left -->			
			
			<!-- footer right -->
			<div class="col-md-3 column-right height-20px">
			
			</div><!-- meny right -->
			
			<!-- footer left row2 -->
			<div class="col-md-9 copyright margin-top-10px pull-left">
			
				<div class="col-md-4 pull-left quicksand text-bold text-16px">					
					GAMERSKEEP
					<p class="droid text-normal">
					<a href="#">Syfte</a><br>
					<a href="#">Policy</a><br>
					<a href="#">FAQ</a><br>
					</p>										
				</div>
				
				<div class="col-md-4 pull-left quicksand text-bold text-16px">
					KONTAKT
					<p class="droid text-normal">
					<a href="#">Annoncera</a><br>
					<a href="#">Mejl</a>
					</p>
				</div>
				
				<div class="col-md-4 pull-left quicksand text-bold text-16px">
					SOCIALA MEDIER
					<p class="droid text-normal">
					Twitter<br>
					Facebook<br>
					Annat
					</p>
				</div>	
						
						
			
			
			
			</div><!-- -->
	
			<!-- Meny right row2 -->
			
			<div class="col-md-3 quicksand text-bold text-16px pull-right margin-top-10px">
				<div class="footer-right">
			<!--<img src="images/hh.png" class="pull-right margin-right-15px" width="125px">-->
				GAMETEAM
				<p class="droid text-normal">
				<a href="gameteam.php">Vem vi är</a><br>
				<a href="#">Robert</a><br>
				<a href="#">Dorte</a><br>
				<a href="#">Maria</a><br>
				<a href="#">Malena</a>
				</p>				
			</div>
			</div><!-- col md 3 sociala media -->
			
			
			<div class="col-md-12 pull-left text-left bg-white margin-top-30px">
			
				<div class="col-md-11 pull-right">
				
					<img src="images/logo_gt.png" width="200px" class="pull-right">
					<br><br><br><br>
					<p class="pull-right text-10px">Copyright &copy; 2015 GameTeam.</p>
				
				</div><!-- col md 3 -->
			
			</div><!-- col md 12 -->
			
		</div> <!-- footer -->
	</div><!-- container fluid -->
	</body>
</html>
END;

?>