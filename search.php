<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$content = "";
$feedback = "";

if(isset($_GET['search'])){

	$query = <<<END

		SELECT * FROM user
		WHERE keepername LIKE '%{$_GET['search']}%';
END;
	
	$result = $mysqli->query($query);

	if($result->num_rows > 0)
	{
		
		while($row = $result->fetch_object())
		{
			$keeperid = $row->keeperid;
			$users = <<<END
			
			Användarnamn: <a href="profile.php?keeperid={$keeperid}">{$row->keepername}</a><br>
			Namn: {$row->fname}{$row->lname}<br>
			Email: {$row->email}<br>
END;
		}
	}
	else
	{
		$feedback = "<p class=\"feedback-yellow\">Det finns ingen i databasen med det användarnamnet</p>";
	}
}

$content = <<<END

	<div id="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div id="searchresult">
				{$users}
				{$feedback}
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
END;
echo $header;
echo $content; 
echo $footer;
?>