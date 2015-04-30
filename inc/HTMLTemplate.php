<?php

session_start();

include_once("inc/Connstring.php");

$genre = "";
$adminText = "";

if(isset($_SESSION['keepername']) && isset($_SESSION['roletype'])){

	if($_SESSION["roletype"] == 1)
	{
	$adminText = " (Admin)";
	$admindelete = <<<END
	<button type="submit" id="delete" name="delete" value="delete">Delete</button>
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
        $(".soek_anim").toggleClass(".soek_anim").animate({
			width: 'toggle',
			Left: '0px'
		});
    });
	
		
	$(".soek_button").on("mouseout", function(){
        $(".soek_anim").toggleClass(".soek_anim").animate({
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

	</head>
	<body>
		<div id="header" class="header-bg navbar navbar-default navbar-fixed-top no-border">
			
			<!-- Meny left with logo -->
			<div class="col-md-6 column-left margin-right-zero">
				<a href="index.php"><img src="images/logo-menu.png" class="img header-logo"></a>
				<div class="pull-right">
				
					<p class="text-black">Inloggad som: {$_SESSION["keepername"]}{$adminText}</p>
										
							

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
					<li class="li-icons"><a href="profile.php"><img src="images/profil2.png" class="img header-icons pull-right" title="Profil"></a>
					</li>
			  		</ul>
					
					<ul class="dropdown-menu drop-margin-0 pull-right dropdown-top-margin Droid bg-gradient-brown" role="menu" aria-labelledby="dropdownMenu1">
			    			<li role="presentation" class="dropdown-header quicksand text-black text-bold text-16px">Profil</li>
							
							<li role="presentation pull-right"><a role="menuitem" tabindex="-1" href="profile.php"><span class="glyphicon glyphicon-user pull-right text-white" aria-hidden="true"></span>Profil</a> </li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-education pull-right text-white" aria-hidden="true"></span>FAQ</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="setting.php"><span class="glyphicon glyphicon-cog pull-right text-white" aria-hidden="true"></span>Inställningar</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php"><span class="glyphicon glyphicon-off pull-right text-white" aria-hidden="true"></span>Logga ut</a></li>
							
			    		</ul>
					</div><!-- dropdown -->
					</li>
					
					
				
					<li class="li-icons"><a href="index.php"><img src="images/home.png" class="img header-icons pull-right" title="Hem"></a></li>
					<li><a href="guide_review.php"><img src="images/pen_meny.png" class="img header-icons pull-right" title="Skriv recension/guide"></a></li>
					
					<div class="dropdown">
						
		  				<ul class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="menu"
		  				 aria-expanded="true"><img src="images/swords.png" class="img header-icons pull-right" title="Genre">
			  			</ul>
				 							
		  				<ul class="dropdown-menu drop-margin-75px pull-right dropdown-top-margin Droid bg-gradient-brown" role="menu" aria-labelledby="dropdownMenu1">
			    			<li role="presentation" class="dropdown-header quicksand text-black text-bold text-16px">Genrer</li>
							<!-- laesa in genrer från db har -->
							{$genre}
			    		</ul>
					</div><!-- dropdown -->
					</li>
					
						<div class="soek_anim"></div>
					
							
								<form action="search.php" method="GET">
								<input type="text" class="form-control-search pull-left" id="searchfield" name="search" placeholder="Sök...">
								<button class="soek_button pull-right" type="Submit" value="Sök">
								
								</button>
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
			
			<!-- Meny left with triangle to the right -->			
			<div class="col-md-9 column-left height-20px">
			
			</div><!-- col md 9 column left -->			
			
			<!-- Meny right -->
			<div class="col-md-3 column-right height-20px">
			<p class="pull-right text-black text-10px margin-right-20px margin-top-10px">Copyright &copy; 2015 GameTeam</p>
			</div><!-- meny right -->
			
			<!-- Meny left row2 -->
			<div class="col-md-12 copyright text-black pull-left margin-left-10px margin-top-10px">
			
				<div class="col-md-2 pull-left">
				<address>
					<strong>Twitter, Inc.</strong><br>
					795 Folsom Ave, Suite 600<br>
					San Francisco, CA 94107<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
			
				<div class="col-md-2 pull-left">
				<address>
					<strong>Twitter, Inc.</strong><br>
					795 Folsom Ave, Suite 600<br>
					San Francisco, CA 94107<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
				
				<div class="col-md-2 pull-left">
				<address>
					<strong>Twitter, Inc.</strong><br>
					795 Folsom Ave, Suite 600<br>
					San Francisco, CA 94107<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
				
				<div class="col-md-2 pull-left">
				<address>
					<strong>Twitter, Inc.</strong><br>
					795 Folsom Ave, Suite 600<br>
					San Francisco, CA 94107<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
				
				<div class="col-md-2 pull-left text-justify">
					<address>
					<p class="text-justify"> <strong>Twitter, Inc.</strong><br>
					795 Folsom Ave, Suite 600<br>
					San Francisco, CA 94107<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
				
				<div class="col-md-2 pull-left">
				<address>
					<strong>Twitter, Inc.</strong><br>
					795 Folsom Ave, Suite 600<br>
					San Francisco, CA 94107<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
				
			<img src="images/logo_gt.png" width="200px">			
			</div><!-- col md 12 -->
			<br>
	
			
			
		</div> <!-- footer -->
	</div><!-- container fluid -->
	</body>
</html>
END;

?>