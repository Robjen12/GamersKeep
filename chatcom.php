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

			SELECT * FROM chatcom 
			WHERE accept = 1;
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

		if($res->num_rows > 0)
		{
			if($row = $res->fetch_object())
			{

				$getchatcomid = $row->chatcomid;


				$query = <<<END

			INSERT INTO replys (reply, timestamp, flag)
			VALUE('{$reply}', CURRENT_TIMESTAMP, '');
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

		$query = <<<END

			INSERT INTO repchatcom (keeperid, keeperid2, chatcomid, replyid)
			VALUES ('{$keeperid}', '{$keeperid2}', '{$getchatcomid}', LAST_INSERT_ID());
END;
	}
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
	
		


			}
			
		}

		$query = <<<END
			SELECT *
			FROM repchatcom
			JOIN replys
			ON replys.replyid = repchatcom.replyid
			JOIN chatcom
			ON repchatcom.keeperid = chatcom.keeperid
			JOIN user
			ON repchatcom.keeperid = user.keeperid
			WHERE repchatcom.chatcomid = '{$getchatcomid}'
			GROUP BY timestamp ASC;

END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

		if($res->num_rows > 0)
		{
			while($row = $res->fetch_object())
			{
				
				$keepername = $row->keepername;
				$replys = $row->reply;
				$date 	= strtotime($row->timestamp);
				$date	= date("d M Y H:i", $date);

				$guestbook .= <<<END
				<b>{$keepername}</b><br>
				{$replys}<br>
				<p class="sendwhen">Skickat den: {$date}<br></p>
END;
			}
		}
}




if(!empty($_GET))
{
	$chatcomid = isset($_GET['chatcomid']) ? $_GET['chatcomid'] : "";

	$query = <<<END

	SELECT *
			FROM repchatcom
			JOIN replys
			ON replys.replyid = repchatcom.replyid
			JOIN chatcom
			ON repchatcom.keeperid = chatcom.keeperid
			JOIN user
			ON repchatcom.keeperid = user.keeperid
			WHERE repchatcom.chatcomid = '{$chatcomid}'
			GROUP BY timestamp ASC;
END;
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

if($res->num_rows > 0)
{
	while($row = $res->fetch_object())
	{
		
		$keepername = $row->keepername;
		$replys = $row->reply;
		$date 	= strtotime($row->timestamp);
		$date	= date("d M Y H:i", $date);

		$guestbook .= <<<END
		<b>{$keepername}</b><br>
		{$replys}<br>
		<p class="sendwhen">Skickat den: {$date}<br></p>
END;
	}
}

}	



$content = <<<END

		<div class="row margin-top-100">

			<div class="row">

				<div class="col-md-8">

					<div class="guestbook">
						<h3>Meddelande</h3><br><br>
						{$guestbook}
					</div>
					<div class="guestbookreplys">
							<form action="chatcom.php?keeperid={$keeperid2}" method="post" id="send">
								<textarea id="reply" name="reply" cols="121" rows="5"></textarea></br>
								<input type="submit" id="submit" name="friendmessage" value="Skicka">
							</form>
						</div>

				</div>

			</div>

		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
    // set the default scroll bar to bottom of chat box
    $(".guestbook").scrollTop($(".guestbook")[0].scrollHeight);
});
	</script>
END;
echo $header;
echo $content;
echo $footer
?>