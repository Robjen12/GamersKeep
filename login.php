<?php


$content = <<<END

<!DOCTYPE html>
<html>

<head>
	<title>GamersKeep - Where gamers meet</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="">
</head>

<body>
	<div="container">
	<h1>Enter the keep</h1>
		<form action="login.php" method="post" id="login-form">
			<input type="text" id="keepername" name="keepername" value="" placeholder="Skriv in användarnamn"></br></br>
			<input type="" id="pw" name="pw" value="" placeholder="Skriv in lösenord"></br></br>
			<button type="submit" id="submit" value="Logga in">Logga in</button>
			<button type="submit" id="submit" value="Registrera sig">Registrera sig</button>
		</form>
	</div>
</body>




</html>
END;


echo $content;
?>