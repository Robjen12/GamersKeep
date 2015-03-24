<?php


$content = <<<END

<!DOCTYPE html>
<html>

<head>
	<title>GamersKeep - Where gamers meet</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div id="container">
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<div class="login">
					<h1>Enter the keep</h1>
					<form action="login.php" method="post" id="login-form">
						<input type="text" id="keepername" name="keepername" value="" placeholder="Skriv in användarnamn"></br></br>
						<input type="password" id="pw" name="pw" value="" placeholder="Skriv in lösenord"></br></br>
						<button type="submit" id="submit" value="Logga in">Logga in</button>
						<button type="submit" id="submit" value="Registrera sig">Registrera sig</button>
					</form>
				</div>     <!-- login -->
			</div>   <!-- col-md-4 -->
		</div>
	</div>
</body>




</html>
END;


echo $content;
?>