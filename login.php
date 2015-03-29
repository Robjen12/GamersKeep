<?php

include_once("inc/Connstring.php");

$feedback = "";

if(isset($_POST["logintosite"]))
{
	if(!empty($_POST))
	{

		$keepername = isset($_POST['keepername']) ? $_POST['keepername'] : '';
		$password = isset($_POST['pw']) ? $_POST['pw'] : '';

		if($keepername == '' || $password == '')
		{
			$feedback = "<p class=\"feedback-yellow\">Fyll i alla fält</p>";
		}
		else
		{

			$keepername = $mysqli->real_escape_string($keepername);
			$password = $mysqli->real_escape_string($password);

			$query = <<<END

			
			SELECT keepername, pw, keeperid, roletype
			FROM account
			WHERE keepername = '{$keepername}';
			
END;
			$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error); 
			if($res->num_rows == 1)
			{
				
				$pwmd5 = md5($password);
				$row = $res->fetch_object();
				if($row->pw == $pwmd5)
				{

				session_start();
				session_regenerate_id();

				$_SESSION["keepername"] =	$keepername;
				$_SESSION["keeperid"] 	= 	$row->keeperid;
				$_SESSION["roletype"] 	=	$row->roletype;

				header("Location: index.php");

				}
				else
				{
					$feedback .= "<p class=\"feedback-red\">Användarnamn eller lösenord är fel</p>";
				}
				$res->close();
			}
			$mysqli->close();
		}

	}
}
$content = <<<END

<!DOCTYPE html>
<html>

	<head>
		<title>GamersKeep - Where gamers meet</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	  	<link rel="stylesheet" href="css/style.css">
	</head>

	<body class="login-picture">
		<div id="container">
			<div class="row">
				<div class="col-md-6">
					<img src="images/logo.png">
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<div class="login">
						<h1>Enter the keep</h1>
						{$feedback}
						<form action="login.php" method="post" id="login-form">
							<input type="text" id="keepername" name="keepername" value="" placeholder="Skriv in användarnamn"></br></br>
							<input type="password" id="pw" name="pw" value="" placeholder="Skriv in lösenord"></br></br>
							<button type="submit" id="submit" name="logintosite" value="Logga in">Logga in</button>
							<button><a href="register.php">Registrera sig</a></button></br></br>
						</form>
						<a href="forgotuserpassword.php">Glömt lösenord?</a>
					</div>     
				</div>   
			</div>
		</div>
	</body>




</html>
END;


echo $content;
?>