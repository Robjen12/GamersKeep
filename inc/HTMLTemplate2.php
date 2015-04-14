<?php

session_start();

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
		
	</head>
	<body>
		<div id="header" class="bg-gradient-black navbar navbar-default navbar-fixed-top">
			
			<!-- Meny left with logo -->
			<div class="col-md-4 column-left">
				<img src="images/logo.png" class="img header-logo">
			</div>
			
			<!-- Meny center -->
			<div class="col-md-4 column-center">

				<p>Inloggad som: {$_SESSION["keepername"]}{$adminText}

				<form action="search.php" method="GET">
				<input type="text" id="searchfield" name="search" placeholder="Sök..">
				<input type="Submit" value="Sök">
				</form>

			</div><!-- column center -->

			<!-- Meny right -->
			<div class="col-md-4 column-right pull-right margin-right-zero nav">
			
				<ul class="dropdown-menu-right" role="menu">
					<li><a href="#"><img src="images/search.png" class="img header-icons pull-right"></a></li>
					<li><a href="index.php"><img src="images/home.png" class="img header-icons pull-right"></a></li>
					<li><a href="guide_review.php"><img src="images/pen.png" class="img header-icons pull-right"></a></li>
					
						<div class="dropdown">
		  					<ul class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"
		  					 aria-expanded="true"><img src="images/swords.png" class="img header-icons pull-left">
			  				</ul>
		  					<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
			    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
			    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
			    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
			    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
			  				</ul>
						</div><!-- dropdown -->
						
					</li>

					<li class="list-group-item"><li class="list-group-item"><a href="profile.php"><img src="images/profil2.png"
					class="img header-icons pull-right" alt="Profil"></a></li>
				</ul>
					<!-- meny ikoner -->	
				

				
				
				
				
				


				
			</div><!-- meny right -->
			<!-- Meny left row2 -->
			<div class="col-md-4 column-left-row2 bg-black height-20px transparent-bg">			
			</div><!-- -->
			<!-- Meny center row2 -->
			<div class="col-md-4 column-center-row2 bg-black height-20px">
			</div><!-- -->
			<!-- Meny right row2 -->
			<div class="col-md-4 column-right-row2 margin-horizontal-zero height-20px">
			<a href="logout.php" class="pull-right">Logga ut</a>
			</div><!-- -->
			
		</div> <!-- header -->

END;
$content = <<<END
		<div class="container-fluid">
END;
$footer = <<<END
		<div id="footer" class="bg-gradient-brown">
			
			<!-- Meny left with logo -->
			
			<div class="col-md-4 column-left-row2 bg-black height-20px">
			</div>
			
			<!-- Meny center -->
			
			<div class="col-md-4 column-center-row2 bg-black height-20px">
			</div>
			<!-- Meny right -->
			<div class="col-md-4 column-right-row2 margin-horizontal-zero height-20px">
			</div><!-- meny right -->
			<!-- Meny left row2 -->
			<div class="col-md-4 column-left">
			</div><!-- -->
			<!-- Meny center row2 -->
			<div class="col-md-4 column-center">
			</div><!-- -->
			<!-- Meny right row2 -->
			
			<div class="col-md-4 column-right pull-right margin-right-zero">
			
			</div><!-- -->
			
		</div> <!-- footer -->
	</div><!-- container fluid -->
	</body>
</html>
END;

?>