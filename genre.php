<?php

include_once("inc/HTMLTemplate.php");

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