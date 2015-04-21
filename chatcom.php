<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$chatcomid = $_GET['chatcomid'];
$guestbook = "";


if(!empty($_GET))
{
	$query = <<<END

	SELECT *
	FROM chatcom
    JOIN user
	ON chatcom.keeperid = user.keeperid
	WHERE chatcomid = '{$chatcomid}'
    GROUP BY timestamp DESC;
END;
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

if($res->num_rows > 0)
{
	if($row = $res->fetch_object())
	{

		$keepername = $row->keepername;
		$replys = $row->reply;
		$date 	= strtotime($row->timestamp);
		$date	= date("d M Y H:i", $date);

		$guestbook .= <<<END
		<b>{$keepername}</b><br>
		Skickat den: {$date}<br>
		{$replys}<br>
END;
	}
}

}	

$content = <<<END

		<div class="row margin-top-100">

			<div class="row">

				<div class="col-md-8">

					<div class="guestbook">
						<h3>Meddelande</3>
						{$guestbook}


					</div>

				</div>

			</div>

		</div>
END;
echo $header;
echo $content;
echo $footer
?>