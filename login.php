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
			$feedback = "<p class=\"text-yellow\">Fyll i alla fält</p>";
		}
		else
		{

			$keepername = $mysqli->real_escape_string($keepername);
			$password = $mysqli->real_escape_string($password);

			$query = <<<END

			
			SELECT keepername, pw, keeperid, roletype
			FROM user
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
					$feedback .= "<p class=\"text-red\">Användarnamn eller lösenord är fel</p>";
				}
				$res->close();
			}
			
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
					<h2 class="login-font"><b>Ett community för gamers av gamers</b></h2>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-3 login-cloud quicksand text-bold text-16px">
					<div class="login">
						<h2 class="quicksand text-bold">Enter the Keep</h2>
						{$feedback}
						<form action="login.php" method="post" id="login-form" class="quicksand">
							Användarnamn<br>
							<input type="text" class="form-control" id="keepername" name="keepername" value="" placeholder="Skriv in användarnamn">
							</br>
							Lösenord</br>
							<input type="password" class="form-control" id="pw" name="pw" value="" placeholder="Skriv in lösenord">
							</br>
													
							<button type="submit" class="btn btn-danger btn-sm pull-left text-bold" id="submit" name="logintosite" value="Logga in">Logga in</button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							

							<a href="register.php" class="btn btn-warning btn-sm text-bold login-text" role="button" text-white>Registrera dig</button></a></br>
						</form>
						<a href="forgotuserpassword.php" class="text-10px text-primary">Glömt lösenord?</a>
					</div>     
				</div>   
			</div>
		</div>
	</body>
</html>
END;

echo $content;
?>