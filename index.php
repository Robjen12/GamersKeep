<?php
include_once("inc/HTMLTemplate.php");

$content = <<<END
	
	<div id="mitt">
		<div id="container">
			<div class="row">
				<div class="col-md-4">
					<div class="toplist"></div>
				</div>

				<div class="col-md-4">
					<div class="latestlist">

					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>

END;

echo $header;
echo $content;
echo $footer;
?>