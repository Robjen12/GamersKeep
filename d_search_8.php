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

		
			$query = <<<END

				SELECT * FROM user
				WHERE keepername LIKE '%{$_GET['search']}%';
END;
	
	$result = $mysqli->query($query);

	if($result->num_rows > 0)
	{
		
		while($row = $result->fetch_object())
		{

			$keeperid2 = $row->keeperid;

			if($keeperid2 == $keeperid){
				$users = <<<END
			
			Användarnamn: <a href="profile.php">{$row->keepername}</a><br>
			Namn: {$row->fname}{$row->lname}<br>
			Email: {$row->email}<br>
END;
				
			}
			else
			{
					$users = <<<END
			
			Användarnamn: <a href="profile.php?keeperid={$keeperid2}">{$row->keepername}</a><br>
			Namn: {$row->fname}{$row->lname}<br>
			Email: {$row->email}<br>
END;

			}

		}
	}
	else
	{
		$feedback = "<p class=\"feedback-yellow\">Det finns ingen i databasen med det användarnamnet.</p>";
	}
}
if(isset($_GET['searchgenre']))
{

	$query = <<<END
		SELECT * FROM guidereviewinfo
		WHERE title LIKE '%{$_GET['searchgenre']}%';
END;
	$result = $mysqli->query($query) or die();

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_object())
		{
			$grid = $row->grid;
			$title = utf8_decode(htmlspecialchars($row->title));
			$text = utf8_decode(htmlspecialchars($row->text));
			
			$article .= <<<END
				Titel: <a href="genre.php?grid={$grid}">{$title}</a><br>
				<i>{$text}</i><br><br>
END;
		}
	}
	else
	{
		$feedback = "<p class=\"text-yellow\">Det finns ingen artikel i databasen med det namnet.</p>";
	}
}
$content = <<<END
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!-- soekanimation -->

<!-- http://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_event_on_multiple -->
<script>
$(document).ready(function(){
    $(".soek_button").on("mouseover", function(){
        $(".soek_anim").toggleClass(".soek_anim").animate({
			width: 'toggle',
			Left: '0px'
		});
    });
	
		
	$(".soek_button").on("mouseout", function(){
        $(".soek_anim").toggleClass(".soek_anim").animate({
			width: 'toggle',
			Right: '0px'
		});
    });
	
    $(".soek_anim").on("mouseover",function(){
        $(".soek_anim").toggleClass(".soek_anim").animate({
			width: '0'
		})
    });
	$(".soek_anim").on("mouseout",function(){
        $(".soek_anim").toggleClass(".soek_anim").animate({
			width: '0'
		})
    });
});

</script>

<body>

		<div class="row margin-top-100">
		
			<div class="col-md-4">
			</div><!-- col md 4 -->
			
			<div class="col-md-4">
			<div class="col-md-6 col-sm-6 panel-width-550px panel panel-default pull-left">

	  					<div class="panel-heading panel-heading-560px">Sökresultat Dorte</div>


		  					<div class="panel-body height-290px">
							<!-- <button class="soek_button">Start Animation</button> -->

							

							<div class="soek_anim"></div>
	
						<form class="form-inline">
							<div class="form-group">
							
								<form action="search.php" method="GET">
								<input type="text" class="form-control" id="searchfield" name="search" placeholder="Sök speltitel">
								<button class="btn btn-default soek_button" type="Submit" value="Sök"> </button>
								</form>
							
							</div><!-- form group -->
						</div><!-- form inline -->
							
						<p>	{$users}
							{$article}
							{$feedback} </p>

							Tillbaka


		  					</div><!-- panel body -->

						</div><!-- panel heading -->
						
				
			</div>
			<div class="col-md-4">
			</div><!-- col md 4 -->
		</div>
	</div>
END;
echo $header;
echo $content; 
echo $footer;
?>