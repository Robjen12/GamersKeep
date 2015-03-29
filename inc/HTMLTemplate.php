<?php

session_start();

$header = <<<END
<!DOCTYPE html>
<html>
	<head>
		<title>GamersKeep - Where Gamers Meet</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Satter tecken till utf-8 sa svenska tecken visas ratt -->
		<meta charset="utf-8">
	</head>
	<body>
		<div id="header" class="bg-gradient-black navbar navbar-default navbar-fixed-top">
			
			<!-- Meny left with logo -->
			<div class="col-md-4 column-left">
				<img src="images/logo.png" class="img header-logo">
			</div>
			
			<!-- Meny center -->
			<div class="col-md-4 column-center">
			</div>
			<!-- Meny right -->
			<div class="col-md-4 column-right pull-right margin-right-zero">
			
				<!-- meny ikoner -->	
				<img src="images/profil2.png" class="img header-icons pull-right" alt="Profil">
				<img src="images/swords.png" class="img header-icons pull-right">
				<img src="images/pen.png" class="img header-icons pull-right">
				<img src="images/home.png" class="img header-icons pull-right">
				<img src="images/search.png" class="img header-icons pull-right">
			</div><!-- meny right -->
			<!-- Meny left row2 -->
			<div class="col-md-4 column-left-row2 bg-white height-20px transparent-bg">			
			</div><!-- -->
			<!-- Meny center row2 -->
			<div class="col-md-4 column-center-row2 bg-white height-20px">
			</div><!-- -->
			<!-- Meny right row2 -->
			<div class="col-md-4 column-right-row2 margin-horizontal-zero height-20px">
			<a href="logout.php" class="pull-right">Logga ut</a>
			</div><!-- -->
			
		</div> <!-- header -->
END;
$content = <<<END
<div class="row">
</div>
END;
$footer = <<<END
		<div id="footer" class="bg-gradient-brown">
			
			<!-- Meny left with logo -->
			
			<div class="col-md-4 column-left-row2 bg-white height-20px">
			</div>
			
			<!-- Meny center -->
			
			<div class="col-md-4 column-center-row2 bg-white height-20px">
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
	</body>
</html>
END;
?>