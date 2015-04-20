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
			$password = md5($password);
			
			$query = <<<END
			INSERT INTO user (keepername, fname, lname, email, about, pw)
			VALUES ('$keepername', '$fname', '$lname', '$email', '$about', '$password');
		
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

		}
		$feedback = "<p class=\"feedback-yellow\">Konto skapat</p>";
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
						<input type="checkbox" name="policy"> Jag har läst och accepterat <A HREF="popup.html" onClick="return popup(this, 'stevie')">vilkoren</a> för sidan<br><br>
						<button><a href="login.php">Bakåt</a></button>
						<button type="submit" value="submit" name="registeraccount" value="Skapa konto">Skapa Konto</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>


</html>

<SCRIPT TYPE="text/javascript">

function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, 'width=400,height=200,scrollbars=yes');
return false;
}

</SCRIPT>
END;

echo $content;
?>