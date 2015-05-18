<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$content = "";
$feedback = "";
$keeperid = $_SESSION['keeperid'];
$grid = "";
$title = "";
$text = "";
$title	= htmlspecialchars($title);
$text	= htmlspecialchars($text);
$article = "";
$users = "";

if(isset($_GET['search']))
{

	$search = $_GET['search'];
	$search = str_replace("'", "''", $search);	

			$query = <<<END

				SELECT * FROM user
				WHERE keepername LIKE '%{$search}%'
				AND roletype = 0;
END;
	
	$result = $mysqli->query($query);

	if($result->num_rows > 0)
	{
		
		while($row = $result->fetch_object())
		{

			$keeperid2 = $row->keeperid;

			if($keeperid2 == $keeperid){
				$users = <<<END
			
			<p class="droid">Användarnamn: <a href="profile.php">{$row->keepername}</a><br>


END;
				
			}
			else
			{
					$users = <<<END
			
			<p class="droid">Användarnamn: <a href="profile.php?keeperid={$keeperid2}">{$row->keepername}</a><br>
			</p>
END;

			}

		}
	}
	else
	{
		$feedback .= "<p class=\"text-yellow\">Det finns ingen i databasen med det användarnamnet.</p>";
	}
}

// Namn: {$row->fname}
//{$row->lname}
// Namn: {$row->fname}{$row->lname}<br>
//Email: {$row->email}

if(isset($_GET['search']))
{

	$query = <<<END
		SELECT * FROM guidereviewinfo
		WHERE title LIKE '%{$search}%';
END;
	$result = $mysqli->query($query) or die();

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_object())
		{
			$grid = $row->grid;
			$title = utf8_decode($row->title);
			$text = utf8_decode($row->text);
			
			$article .= <<<END
				Titel: <a href="genre.php?grid={$grid}">{$title}</a><br>
				<i>{$text}</i><br><br>
END;
		}
	}
	else
	{
		$feedback .= "<p class=\"text-yellow\">Det finns ingen artikel i databasen med det namnet.</p>";
	}
}
$content = <<<END

<div class="row margin-top-100">
			
	<div class="col-md-2 col-sm-2">
	</div>
			
		<div class="col-md-6 col-sm-6 search-content panel-width-550px panel panel-default">

	  		<div class="panel-heading panel-heading-560px">Sökresultat</div>

  					<div class="panel-body height-410px">
						
						<li class="media">
						{$users}<br>
						{$article}
						{$feedback}
						</li>
  					</div><!-- panel body -->
					
				<!-- right column -->
			</div><!-- col md 6 -->
			<div class="col-md-3 margin-right-search pull-right">

					<div class ="ads">
						<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

					</div><!-- ads -->
			</div><!-- col md 3 -->
		</div>		
</div>

END;

// Namn: {$row->fname}
//{$row->lname}<br>

echo $header;
echo $content; 
echo $footer;
?>