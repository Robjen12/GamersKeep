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
		
	</head>
	<body>
		<div id="header" class=" navbar navbar-default navbar-fixed-top">
			
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
			<div class="col-md-4 column-right pull-right margin-right-zero nav nav-pills pull-right">
			
				<ul>
					<li><a href="profile.php"><img src="images/profil2.png" class="img header-icons pull-right" alt="Profil" title="Profil">
					</a>
					</li>
					<li class="li-icons"><a href="index.php"><img src="images/home.png" class="img header-icons pull-right" title="Nyheter"></a></li>
					<li><a href="guide_review.php"><img src="images/pen.png" class="img header-icons pull-right" title="Skriv recension/guide"></a></li>
					
						<div class="dropdown">
						
		  					<ul class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="menu"
		  					 aria-expanded="true"><img src="images/swords.png" class="img header-icons pull-right" title="Genre">
			  				</ul>
				 							
		  					<ul class="dropdown-menu pull-right dropdown-top-margin Droid bg-gradient-brown" role="menu" aria-labelledby="dropdownMenu1">
			    				<li role="presentation" class="dropdown-header quicksand text-black text-bold text-16px">Genrer</li>
								<!-- laesa in genrer från db har -->
								{$genre}
			    			</ul>
						</div><!-- dropdown -->
						
					</li>
					
					<li class="li-icons"><a href="#"><img src="images/search.png" class="img header-icons pull-right" title="Sök"></a></li>
				</ul>
				
			</div><!-- meny left -->
			<!-- Meny left row2 -->
			<div class="col-md-4 column-left-row2 height-20px">			
			</div><!-- -->
			<!-- Meny center row2 -->
			<div class="col-md-4 column-center-row2 height-20px">
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