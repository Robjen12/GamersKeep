<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");


$keeperid = $_SESSION['keeperid'];
$keeperid2 = isset($_GET['keeperid']) ? $_GET['keeperid'] : "";
$guestbook = "";
$feedback = "";

//Hindrar SQL injections
//$postId		= $mysqli->real_escape_string($postId);
//Hindrar XSS-attack
//$name	= htmlspecialchars($name);
//$msg	= htmlspecialchars($msg);

if(!empty($_POST))
{

	if(isset($_POST['friendmessage']))
		
	{
		$msg = $_POST['msg'];

		if($msg == "")
		{
			$feedback = "<p class=\"text-red\">Du måste skriva ett meddelande!</p>";
		}
		else
		{
		
			if($keeperid != $keeperid2)
			{

			$query = <<<END

				INSERT INTO message (keeperid, keeperid2, msg, timestamp)
				VALUES ('{$keeperid}', '{$keeperid2}', '{$msg}', CURRENT_TIMESTAMP);
END;
		
			$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);
		}
		
		}
			
	}

		
}


if(!empty($_GET))
{

	$query = <<<END

	SELECT * 
	FROM message
	JOIN user
	ON user.keeperid = message.keeperid
	WHERE message.keeperid = '{$keeperid}'
    AND message.keeperid2 = '{$keeperid2}'
    OR message.keeperid2 = '{$keeperid}'
    AND message.keeperid = '{$keeperid2}'
	GROUP BY timestamp;	  
	 
END;
			$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

			if($res->num_rows > 0)
			{
				while($row = $res->fetch_object())
				{
					
					$keepername = $row->keepername;
					$msgs = $row->msg;
					$date 	= strtotime($row->timestamp);
					$date	= date("d M Y H:i", $date);

					$guestbook .= <<<END
					<b>{$keepername}</b><br>
					{$msgs}<br>
					<p class="sendwhen text-muted">Skickat den: {$date}<br></p>
END;
				}
			}

}	


$content = <<<END

		<div class="row margin-top-100">
		
			<div class="col-md-2 col-sm-2">
			</div>

			<div class="col-md-6 col-sm-6 margin-top-100 setting panel-width-550px panel panel-default">

				<div class="panel-heading panel-heading-560px">
					Meddelande
				</div><!-- panel heading -->
					
					<div class="panel-body height-410px pull-left">
					
						<h4 class="quicksand text-bold">Konversation</h4>
						<p class="droid">
							{$guestbook}
						</p>
					</div><!-- panel body -->	
					
			</div><!-- col md 6 panel -->
			
			</div>
			<div class="col-md-6 panel-width-550px panel panel-default">
			
			<div class="panel-heading panel-heading-560px">
					Svara
				</div><!-- panel heading -->
			<br>
				{$feedback}
				<form action="chatcom.php?keeperid={$keeperid2}" method="post" id="send">
					<textarea id="msg" name="msg" cols="121" rows="5"></textarea></br>
					<input type="submit" id="submit" name="friendmessage" value="Skicka">
				</form>
			</div><!-- guestbookreplies -->

		</div><!-- row margin top 100 -->

		
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