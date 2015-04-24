<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$gr_flag = "";

$query = <<<END

	SELECT * FROM guidereviewinfo
	WHERE flag < 1;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		if($row = $res->fetch_object())
		{

			$grid = $row->grid;
			$title = utf8_decode(htmlspecialchars($row->title));

			$gr_flag .= <<<END
			<a href="genre.php?grid={$grid}">{$title}</a>
END;
		}
	}

	$content = <<<END
	<div class="row margin-top-100">
		<div class="col-md-12">
			<div class="admin-profile">

			{$gr_flag}
			</div>

		</div>
	</div>
END;

echo $header;
echo $content;
echo $footer;
?>