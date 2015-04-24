<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");
$grid = isset($_GET['grid']) ? $_GET['grid'] : "";
$gr_flag = "";

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
			<a href="genre.php?grid={$grid}">{$title}</a><button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
			<button class="admit"><a href="admin.php?grid={$grid}">V</a></button><br><br>
END;
		}
	}

	$admit = <<<END
		UPDATE guidereviewinfo SET flag = 0
		WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($admit) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	$content = <<<END
	<div class="row margin-top-100">
		<div class="col-md-12">
			<div class="admin-profile">
			
			{$gr_flag}
			</div>

		</div>
	</div>

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