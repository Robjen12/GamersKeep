<?php

$content = <<<END


<!DOCTYPE html>

<html>

<head>
	<title>GamersKeep - WHere Gamers meet</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
</head>

<body>
	<div id="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<div class="register">
					<h1>Registrering</h1>
					<form action="register.php" method="post" id="register-form">
						<label for="keepername">Användarnamn:</label></br>
						<input type="text" id="keepername" name="keepername" value=""></br>
						<label for="fname">Förnamn:</label></br>
						<input type="text" id="fname" name="fname" value""></br>
						<label for="lname">Efternamn:</label></br>
						<input type="lname" id="lname" name="lname" value=""></br>
						<label for="email">E-postadress:</label></br>
						<input type="text" id="email" name="email" value=""></br>
						<label for="pw">Lösenord:</label></br>
						<input type="password" id="pw" name="pw" value""></br></br>
						<button type="submit" value="submit" value="Skapa konto">Skapa Konto</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>


</html>
END;

echo $content;
?>