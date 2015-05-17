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
	
</head>

<body class="register">
	<div class="container">
		<div class="row margin-top-75">
			<div class="col-md-6 pull-left margin-top-register">
				<img src="images/logo.png" width="50%">
			</div>
			
			<div class="col-md-6 col-sm-6 register-left panel-width-550px panel panel-default policy-height-600px pull-left">
				
					<div class="panel-heading panel-heading-560px">Policy</div>
					
						<div class="panel-body height-410px pull-left quicksand">
					
							För allas trivsel har vi skapat en policy, som innehåller några enkla regler. Detta för att vi gärna
							vill dela vår spelglädje med andra likasinnade utan att någon ska bli påhoppade. Vi förväntar därför
							att våra med-gamers delar med sig
							av sin spelglädje på ett sätt som:
							<br><br>
							<span class="badge badge-info">1</span> Gynnar alla oavsett ras, kön, religion eller sexuell orientering.
							<br><br>
							<span class="badge badge-info">2</span> Med ömsesidigt respekt.
							<br><br>
							<span class="badge badge-info">3</span> Erfarna användare utmanas att välkomma nybörjare.
							<br><br>
							<span class="badge badge-info">4</span> Inga spelgenrer är bättre än andra.
							<br><br>
							<span class="badge badge-info">5</span> Personliga påhopp tolereras ej. Alla stötliga inlägg rapporteras till moderatorer
							som hanterar busar.							
							<br><br>
							<span class="badge badge-info">6</span> Ha roligt och prata entusiastiskt om dina favoritspel.
							Argumentera gärna varför de är dina favoriter!							
							<br><br>
							<span class="badge badge-info">7</span> Din mejl address samt namn distribuerar vi ej vidare till tredje part, den
							hanteras enligt PUL.
							<br>
				
						</div><!-- panel body -->
						
			</div><!-- col md 6 -->
			
			<div class="col-md-6 col-sm-6 register-right panel-width-405px panel panel-default pull-left">
				
				{$feedback4}
					<div class="panel-heading panel-heading-415px">Registrering</div>
					
					<div class="panel-body height-410px pull-left">
					
						<form action="register.php" method="post" id="register-form" class="form-inline quicksand">
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
							villkoren för sidan.
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

END;

echo $content;
?>