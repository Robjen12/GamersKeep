<?php

include_once("inc/Connstring.php");

$feedback = '';

if(isset($_POST['registeraccount']))
{
	if(!empty($_POST))
	{
		$keepername = $_POST['keepername'];
		$password = md5($_POST['pw']);
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$about = $_POST['about'];

		if($keepername == '' || $password == '' || $fname == '' || $lname == '' || $email == '' )
		{
			$feedback = "<p class=\"feedback-yellow\">Fyll i fälten</p>";
		}
		else
		{
			$keepername = $mysqli->real_escape_string($keepername);
			$password = $mysqli->real_escape_string($password);
			$fname = $mysqli->real_escape_string($fname);
			$lname = $mysqli->real_escape_string($lname);
			$email = $mysqli->real_escape_string($email);
			$about = $mysqli->real_escape_string($about);

			$query = <<<END
			INSERT INTO user (keepername, fname, lname, email, about)
			VALUES ('$keepername', '$fname', '$lname', '$email', '$about');
		
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

			$query = <<<END
			INSERT INTO account (keepername, pw)
			VALUES ('$keepername','$password');
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error); 
		}
	}
}


$content = <<<END

<!DOCTYPE html>

<html>

<head>
	<title>GamersKeep - Where Gamers meet</title>
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
					{$feedback}
					<form action="register.php" method="post" id="register-form">
						<label for="keepername">Användarnamn:</label></br>
						<input type="text" id="keepername" name="keepername" value=""></br>
						<label for="fname">Förnamn:</label></br>
						<input type="text" id="fname" name="fname" value""></br>
						<label for="lname">Efternamn:</label></br>
						<input type="lname" id="lname" name="lname" value=""></br>
						<label for="email">E-postadress:</label></br>
						<input type="text" id="email" name="email" value=""></br>
						<label for="about">Om dig</label></br>
						<input type="text" id="about" name="about" value=""></br>
						<label for="pw">Lösenord:</label></br>
						<input type="password" id="pw" name="pw" value""></br></br>
						<button><a href="login.php">Bakåt</a></button>
						<button type="submit" value="submit" name="registeraccount" value="Skapa konto">Skapa Konto</button>
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