<?php


$content = <<<END

<!DOCTYPE html>
<html>

<head>
	<title>GamersKeep - Where gamers meet</title>
	<link rel="stylesheet" href="">
</head>

<body>
	<div="container">
	<h1>Enter the keep</h1>
		<form action="login.php" method="post" id="login-form">
			<label for="keepername">Användarnamn</label>
			<input type="text" id="keepername" name="keepername" value="" placeholder="Skriv in användarnamn"></br>
			<label for="pw">Lösenord</label>
			<input type="" id="pw" name="pw" value="" placeholder="Skriv in lösenord"></br>
			<button type="submit" id="submit" value="Logga in">Enter the keep</button>
		</form>
	</div>
</body>




</html>
END;


echo $content;
?>