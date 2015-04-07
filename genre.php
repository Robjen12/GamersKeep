<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = isset($_GET['grid']) ? $_GET['grid'] : '';

if(isset($_GET['grid']))
{

	$query = <<<END

		INSERT INTO userclick (grid, keeperid)
		VALUES ('{$grid}', '{$keeper}');
END;
}
$res = $mysqli->query($query);

$content = <<<END

<!DOCTYPE html>
<html>

	<body>

		<div id="container">
			<div class="row">
				<div class="col-md-4">
					<div class="latest">
						
					</div>

				</div>
				<div class="col-md-4">
					<div class="toplist"></div>

				</div>
				<div class="col-md-4">


				</div>
			</div>
		</div>

	</body>

</html>
END;

echo $header;
echo $content;
echo $footer;

?>