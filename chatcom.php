<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");


$keeperid = $_SESSION['keeperid'];
$keeperid2 = isset($_GET['keeperid']) ? $_GET['keeperid'] : "";
$guestbook = "";


if(!empty($_POST))
{

	if(isset($_POST['friendmessage']))
	{
		$reply = $_POST['reply'];

		$query = <<<END

			INSERT INTO chatcom (keeperid, keeperid2, reply, timestamp, flag)
			VALUES ('{$keeperid}', '{$keeperid2}', '{$reply}', CURRENT_TIMESTAMP, '');
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
	}
		$query = <<<END
			SELECT *
			FROM chatcom
			JOIN user
			ON chatcom.keeperid = user.keeperid
			WHERE chatcomid = LAST_INSERT_ID()
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




if(!empty($_GET))
{
	$chatcomid = isset($_GET['chatcomid']) ? $_GET['chatcomid'] : "";;

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
						<h3>Meddelande</3><br><br>
						{$guestbook}
						<form action="chatcom.php?keeperid={$keeperid2}" method="post" id="send">
								<textarea id="reply" name="reply" cols="40" rows="5"></textarea></br>
								<input type="submit" id="submit" name="friendmessage" value="Skicka">
						</form>
					</div>

				</div>

			</div>

		</div>
END;
echo $header;
echo $content;
echo $footer
?>