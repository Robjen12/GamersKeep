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
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="register">
					<form action="register.php" method="post" id="register-form">
						<label for="keepername">Användarnamn:</label>
						<input type="text" id="keepername" name="keepername" value="">
						<label for="Lösenord">
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>


</html>
END;

echo $content;
?>