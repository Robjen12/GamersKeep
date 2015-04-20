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
		<div id="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div id="forgot">
						<h3>Hämta ditt användarnamn och lösenord</h3>
						<h6>Ange emailen som du angav vid registrering</h6>
						<form action="forgotuserpassword.php" method="post" id="">
							<input type="text" id="email" name="email" value="" placeholder="Ange din email här"></br></br>
							<button type="submit" id="submit" name="retriveuserpass" value="Skicka mail">Skicka mail</button>
							<button><a href="login.php">Bakåt</a></button>
						</form>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</body>

</html>
END;

echo $content;
?>