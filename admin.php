<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");
$grid = isset($_GET['grid']) ? $_GET['grid'] : "";
$gr_flag = "";
$admit = "";

// Sätter flaggan till noll om innehållet inte är olämpligt
if(isset($_POST['ok']))
{
	$admit = <<<END
		UPDATE guidereviewinfo SET flag = 0
		WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($admit) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}
// Hämtar ut allt i guidereviewinfo som har status 1 i posten flag
$query = <<<END

	SELECT * FROM guidereviewinfo
	WHERE flag = 1;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{

			$grid = $row->grid;
			$title = utf8_decode(htmlspecialchars($row->title));

			$gr_flag .= <<<END
				
				<form action="admin.php?grid={$grid}" method="post">
				<a href="genre.php?grid={$grid}">{$title}</a>
					<button type="submit" name="ok" value="">V</button>
					<button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
				</form>
END;
		}
	}

			//<button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
			//<button class="admit"><a href="admin.php?grid={$grid}">V</a></button><br><br>

	$content = <<<END
	<div class="row margin-top-100">
			
		<div class="col-md-12 panel panel-default panel-guide-review height-410px">
			
			<div class="panel-heading panel-heading-guide-review">
			
				Admin Profile</br></br>
				<p>Guide och recensioner</p>
				{$gr_flag}<br>
				<p>Kommentarer</p>
			</div><!-- panel heading -->

		</div><!-- col md 12 -->
		
	</div><!-- row margin top 100 -->

	<script>
		$(document).ready(function(){
			$(.admit).click(function(){
				{$admit}
			});

		})

	</script>
END;

echo $header;
echo $content;
echo $footer;
?>