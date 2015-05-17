<?php

include_once("inc/Connstring.php");

$feedback1 = '';
$feedback2 = '';
$feedback3 = '';
$feedback4 = '';
$feedback5 = '';
$policy = '';
$keepername = '';
$fname = '';
$lname = '';
$email = '';

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	
</head>

<body class="register">
	<div class="container">
		<div class="row margin-top-75">
			<div class="col-md-6 pull-left margin-top-register">
				<img src="images/logo.png" width="50%">
			</div>
			
			<div class="col-md-6 col-sm-6 register-left panel-width-550px panel panel-default pull-left collapse">
			
				
					<div class="collapse">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit,
						sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
					</div>
			</div><!-- col md 6 -->		
			
			<div class="col-md-6 col-sm-6 register-right panel-width-550px panel panel-default pull-right">
				
				{$feedback4}
					<div class="panel-heading panel-heading-560px">Registrering</div>
					
					<div class="panel-body height-410px pull-left">
					
						<form action="register.php" method="post" id="register-form" class="form-inline">
						<div class="form-group">
						{$feedback1}
							<label for="keepername">Användarnamn</label></br>
							<input type="text" class="form-control" id="keepername" name="keepername" value="{$keepername}" placeholder="Användarnamn"></br>
							<label for="fname">Förnamn</label></br>
							<input type="text" class="form-control" id="fname" name="fname" value="{$fname}" placeholder="Förnamn"></br>
							<label for="lname">Efternamn</label></br>
							<input type="lname" class="form-control" id="lname" name="lname" value="{$lname}" placeholder="Efternamn"></br>
							{$feedback2}
							<label for="email">E-post</label></br>
							<input type="text" class="form-control" id="email" name="email" value="{$email}" placeholder="E-post"></br>
							{$feedback3}
							<label for="pw">Lösenord</label></br>
							<input type="password" class="form-control" id="pw" name="pw" value="" placeholder="Lösenord"><br>
							<label for="pw">Ange Lösenord igen</label></br>
							<input type="password" class="form-control" id="pw2" name="pw2" value="" placeholder="Lösenord"><br><br>
							{$feedback5}
							<input type="checkbox" id="policy" name="policy" value=""> Jag har läst och accepterat
							<a href="#" class="a">villkoren</a>för sidan
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
<script>
$(document).ready(function(){
    $(".a").click(function(){
        $(".collapse").collapse('toggle');
    });
});
</script>
</body>
</html>

END;

echo $content;
?>