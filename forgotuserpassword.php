<?php

include_once("inc/Connstring.php");

$content = <<<END


<!DOCTYPE html>
<html>

	<head>
		<title>GamersKeep - Where gamers meet</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<meta charset="utf-8">
	</head>

	<body class="register-forgot-background">
		<div id="container-fluid">
			<div class="row">
				
				<div class="col-md-3">
				</div><!-- col md 3 -->
				
				<div class="col-md-6">
					<div id="forgot">
						<div class="panel panel-default">
						
						<div class="panel-header">Hämta ditt användarnamn och lösenord</div>
						<div class="panel-body">
						<h6>Ange emailen som du angav vid registrering</h6>
						<form action="forgotuserpassword.php" method="post" id="" class="quicksand">
							<input type="text" class="form-control" id="email" name="email" value="" placeholder="Ange din mejl här"><br>
							<button class="btn btn-danger btn-sm text-bold" type="submit" id="submit" name="retriveuserpass" value="Skicka mail">Skicka mail</button>
							<button class="btn btn-warning btn-sm text-bold text-white pull-right"><a class="text-bold text-white" href="login.php">Bakåt</a></button>
						</form>
					</div><!-- forgot -->
					</div><!-- panel body -->
				</div><!-- col md 6 -->

				<div class="col-md-3">
				</div><!-- col md 3 -->
				
			</div><!-- row -->
		</div><!-- container fluid -->		
	</div><!-- register forgot background -->
		
	</body>

</html>
END;

echo $content;
?>