<?php

include_once("inc/Connstring.php");

$feedback = '';

if(isset($_POST['registeraccount']))
{
	if(!empty($_POST))
	{
		$keepername = $_POST['keepername'];
		$password = ($_POST['pw']);
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$about = $_POST['about'];

		if($keepername == '' || $password == '' || $fname == '' || $lname == '' || $email == '' )
		{
			$feedback = "<p class=\"danger\">Fyll i fälten</p>";
		}
		else
		{
			$keepername = $mysqli->real_escape_string($keepername);
			$password = $mysqli->real_escape_string($password);
			$fname = $mysqli->real_escape_string($fname);
			$lname = $mysqli->real_escape_string($lname);
			$email = $mysqli->real_escape_string($email);
			$about = $mysqli->real_escape_string($about);
			$password = md5($password);
			
			$query = <<<END
			INSERT INTO user (keepername, fname, lname, email, about, pw)
			VALUES ('$keepername', '$fname', '$lname', '$email', '$about', '$password');
		
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

		}
		$feedback = "<p class=\"success\">Konto skapat</p>";
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

<body class="register-forgot-background">
	<div id="container-fluid">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<div class="register">
					<h3 class="">Registrering</h3>
					{$feedback}
					<form action="register.php" method="post" id="register-form" class="form-inline">
					<div class="form-group">
						<label for="keepername">Användarnamn</label></br>
						<input type="text" class="form-control" id="keepername" name="keepername" value="" placeholder="Användarnamn"></br>
						<label for="fname">Förnamn</label></br>
						<input type="text" class="form-control" id="fname" name="fname" value"" placeholder="Förnamn"></br>
						<label for="lname">Efternamn</label></br>
						<input type="lname" class="form-control" id="lname" name="lname" value="" placeholder="Efternamn"></br>
						<label for="email">E-post</label></br>
						<input type="text" class="form-control" id="email" name="email" value="" placeholder="E-post"></br>
						<label for="about">Om dig</label></br>
						<input type="text" class="form-control" id="about" name="about" value="" placeholder="Om dig"></br>
						<label for="pw">Lösenord</label></br>
						<input type="password" class="form-control" id="pw" name="pw" value"" placeholder="Lösenord">
						
						<!-- policy -->
							<h3 class="quicksand text-bold">Policy</h3>
							<p>För allas trivsel har vi skapat en policy, som innehåller några enkla regler. Detta för att vi gärna vill
							dela vår spelglädje med andra likasinnade. Vi förväntar därför att våra användare delar med sig av sin spelglädje
							på ett sätt som</p>
							
							<p>
							1) Gynnar alla gamers</br>
								2) Ömsesidigt respekt</br>
								3) erfarna användare utmanas att välkomma nybörjare</br>
								4) Din e-post address distribuerar vi ej vidare till tredje part, utan den används enbart som åtkomst till GamersKeep.</br>
							
							</p>						
						
						<input type="checkbox" name="policy"> Jag har läst och accepterat <a href="#">vilkoren</a> för sidan
						<br><br>
						<button class="btn btn-warning btn-sm pull-right text-bold"><a href="login.php">Bakåt</a></button>
						<button type="submit" class="btn btn-danger btn-sm pull-left text-bold" value="submit" name="registeraccount" value="Skapa konto">Skapa Konto</button>
						</div><!-- form group -->
					</form>
				</div><!-- register -->
				
			</div>
		</div>
	</div>
</body>


</html>
END;

echo $content;
?>