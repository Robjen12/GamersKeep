<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");


$keeperid = $_SESSION['keeperid'];
$keeperid2 = isset($_GET['keeperid']) ? $_GET['keeperid'] : "";
$guestbook = "";
$feedback = "";
$msg = "";
$namecolor_first = "";

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
					$msg = $row->msg;
					$date 	= strtotime($row->timestamp);
					$date	= date("d M Y H:i", $date);


// http://stackoverflow.com/questions/25121144/alternating-row-colors-in-bootstrap-3-no-table

					$guestbook .= <<<END
					<div class="guestbook_feed">
						<span class="glyphicon glyphicon-user media-top pull-left" aria-hidden="true"></span>
						<h4 class="media-heading media-top pull-left">{$keepername}</h4>
						<br>
						<br>
						<p class="media-body quicksand text-normal" pull-left>{$msg}</p>
						<br>
						<p class="text-muted text-size-8px pull-right">{$date}</p>
						<br>
					</div><!-- guestbook feed -->
END;
				}
			}

}	


$content = <<<END

		<div class="row margin-top-100">

			<div class="col-md-8 col-sm-8 margin-top-100 panel panel-default panel-guide-review">

				<div class="panel-heading panel-heading-guide-review">
					Meddelande
				</div><!-- panel heading -->
				
				<div class="guestbook">
					<div class="panel-body height-410px pull-left">
					
						<h4 class="quicksand text-bold">Konversation</h4>
							<p class="quicksand text-normal">{$guestbook}</p>
				</div><!-- guestbook -->
			</div><!-- col md 8-->
			
			<div class="col-md-8 col-sm-8 margin-top-100 chatcom_bottom">
					
						<h4 class="quicksand text-bold">Svara</h4>						
								{$feedback}
								<form action="chatcom.php?keeperid={$keeperid2}" method="post" id="send" class="textarea-width-498">
									<textarea id="msg" name="msg" rows="5" class="form-control textarea-width-498 quicksand">
									</textarea>									
									<input type="submit" id="submit" name="friendmessage" value="Skicka" role="button"
									class="btn btn-primary btn-sm text-info">
									<input type="reset" id="reset" value="Ångra" role="button" class="btn btn-default btn-sm right">
								</form>
					</div><!-- panel body -->					
			</div><!-- panel body -->
			</div><!-- col md 6 panel chatcom bottom -->		
		</div><!-- row margin top 100 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
	//	set the default scroll bar to bottom of chat box
	$(".guestbook").scrollTop($(".guestbook")[0].scrollHeight);
	});
</script>
END;
echo $header;
echo $content;
echo $footer
?>