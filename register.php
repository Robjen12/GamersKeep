<?php

include_once("inc/Connstring.php");

$feedback1 = '';
$feedback2 = '';
$feedback3 = '';
$feedback4 = '';
$feedback5 = '';
$policy = '';

$policy = <<<END


END;


if(isset($_POST['registeraccount']))
{
	

		$keepername = $_POST['keepername'];
		$password = $_POST['pw'];
		$password2 = $_POST['pw2'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$policy = (isset($_POST['policy'])); 
		
		if($keepername == '' || $password == '' || $password2 == '' || $fname == '' || $lname == '' || $email == '' )
		{
				$feedback4 = "<p class=\"text-red\">Fyll i alla fält</p>";
		}
		else if($password != $password2)
		{
				$feedback3 = "<p class=\"text-red\">Lösenordet matchar inte</p>";
		}
		else if($policy == 0)
		{
			$feedback5 = "<p class=\"text-red\">Har du läst och accepterat villkoren?</p>";
		}
		else
		{

			$keepername = $mysqli->real_escape_string($keepername);
			$fname = $mysqli->real_escape_string($fname);
			$lname = $mysqli->real_escape_string($lname);
			$email = $mysqli->real_escape_string($email);	

		    $query = <<<END
		    SELECT keepername FROM user 
		    WHERE keepername = '{$keepername}'
		    ORDER BY keepername
		    LIMIT 1;
END;

		   	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
			$usertaken = false;

		   	if($res->num_rows == 1)
		   	{
		   		$feedback1 = "<p class=\"text-red\">Användarnamn upptaget</p>";
				$usertaken = true;
		   	}

		  
		   	$query1 = <<<END
		   	SELECT email FROM user 
		   	WHERE email = '{$email}'
		   	ORDER BY email
		   	LIMIT 1; 
END;

		   	$res1 = $mysqli->query($query1) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
			$emailtaken = false;

		   	if($res1->num_rows == 1)
		   	{
		   		$feedback2 = "<p class=\"text-red\">Email upptaget</p>";
				$emailtaken = true;
		   	}

			if(!$usertaken && !$emailtaken)
			{
				$password = $mysqli->real_escape_string($password);
				$password = md5($password);

				$query2 = <<<END
					INSERT INTO user (keepername, fname, lname, email, pw)
					VALUES ('$keepername', '$fname', '$lname', '$email', '$password');
				
END;
				$res2 = $mysqli->query($query2) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

				header("Location: login.php");

						
						
			}				
		}		
					
	
	
}



$content = <<<END

<!DOCTYPE html>

<html>

<head>
	<title>GamersKeep - Registrering</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="css/style.css">	
	
</head>

<body class="register-forgot-background">
	<div id="container-fluid">
		<div class="row">
			<div class="col-md-4 pull-left">
				<img src="images/logo.png">		
			</div><!-- col md 4 -->
			
			<div class="col-md-8 pull-right">
				<div class="register">
				{$feedback4}
					<h3 class="text-bold quicksand">Registrering</h3>
					<form action="register.php" method="post" id="register-form" class="form-inline">
					<div class="form-group col-lg-12">
					{$feedback1}
						<label for="keepername">Användarnamn</label></br>
						<input type="text" class="form-control" id="keepername" name="keepername" value="" placeholder="Användarnamn"></br>
						<label for="fname">Förnamn</label></br>
						<input type="text" class="form-control" id="fname" name="fname" value"" placeholder="Förnamn"></br>
						<label for="lname">Efternamn</label></br>
						<input type="lname" class="form-control" id="lname" name="lname" value="" placeholder="Efternamn"></br>
						{$feedback2}
						<label for="email">E-post</label></br>
						<input type="text" class="form-control" id="email" name="email" value="" placeholder="E-post"></br>
						{$feedback3}
						<label for="pw">Lösenord</label></br>
						<input type="password" class="form-control" id="pw" name="pw" value="" placeholder="Lösenord"><br>
						<label for="pw">Ange Lösenord igen</label></br>
						<input type="password" class="form-control" id="pw2" name="pw2" value="" placeholder="Lösenord"><br><br>
						{$feedback5}
						<input type="checkbox" id="policy" name="policy" value=""> Jag har läst och accepterat
						<A HREF="popup.html" onClick="return popup(this, 'stevie')">villkoren</a> för sidan
						<br>
						<br>
						<button type="submit" class="btn btn-primary btn-sm pull-left text-bold" value="submit" name="registeraccount"
						value="Skapa konto">
							Skapa Konto
						</button>
						
						<div class="pull-right a text-white">							
							<a href="login.php" class="btn btn-default btn-sm text-bold login-text" role="button">																
								Tillbaka till login
							</a>
						</div>
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
window.open(href, windowname, 'width=600,height=300,scrollbars=yes');
return false;
}

</SCRIPT>
END;

echo $content;
?>