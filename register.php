<?php

include_once("inc/Connstring.php");

$feedback = '';
$query = "";

if(isset($_POST['registeraccount']))
{

	if(!empty($_POST))
	{

			$query .= <<<END

	SELECT keepername, email FROM user;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		if($row = $res->fetch_object())
		{
			$keepername2 = $row->keepername;
			$email2 = $row->email;
		}
	}

		$keepername = $_POST['keepername'];
		$password = ($_POST['pw']);
		$password2 = ($_POST['pw2']);
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		

		if($keepername == '' || $password == '' || $password2 == '' ||$fname == '' || $lname == '' || $email == '' )
		{
			$feedback = "<p class=\"text-red\">Fyll i alla fälten</p>";
		}
		else
		{
			if($password != $password2)
			{
				$feedback = "<p class=\"text-red\">Lösenordet matchar inte</p>";
			}
			else if($keepername == $keepername2)
			{
				$feedback = "<p class=\"text-red\">Användarnamn upptaget</p>";
			}
			else 
			{
					$keepername = $mysqli->real_escape_string($keepername);
					$password = $mysqli->real_escape_string($password);
					$fname = $mysqli->real_escape_string($fname);
					$lname = $mysqli->real_escape_string($lname);
					$email = $mysqli->real_escape_string($email);
					$password = md5($password);
			
					$query = <<<END
					INSERT INTO user (keepername, fname, lname, email, pw)
					VALUES ('$keepername', '$fname', '$lname', '$email', '$password');
		
END;
					$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

					header("Location: login.php");


			}
				
			
			
			
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
						<label for="pw">Lösenord</label></br>
						<input type="password" class="form-control" id="pw" name="pw" value"" placeholder="Lösenord"><br>
						<label for="pw">Ange Lösenord igen</label></br>
						<input type="password" class="form-control" id="pw2" name="pw2" value"" placeholder="Lösenord"><br><br>
						<input type="checkbox" name="policy"> Jag har läst och accepterat <A HREF="popup.html" onClick="return popup(this, 'stevie')">villkoren</a> för sidan<br>
						<br>
						<button type="submit" class="btn btn-primary btn-sm pull-left text-bold" value="submit" name="registeraccount" value="Skapa konto">Skapa Konto</button>
						</div><!-- form group -->	
				</form>
				</div><!-- register -->
				
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
window.open(href, windowname, 'width=600,height=250,scrollbars=yes');
return false;
}

</SCRIPT>
END;

echo $content;
?>