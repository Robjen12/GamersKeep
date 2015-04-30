<?php
include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keepername = $_SESSION['keepername'];
$keeperid = $_SESSION['keeperid'];
$keeperid2 = isset($_GET['keeperid']) ? $_GET['keeperid'] : "";
$profilename = '';
$profileabout = '';
$button = "";
$latestactivity = "";
$g = "";
$r = "";
$v = "";
$k = "";
$grade = "";
$chatmess = "";
$sendmessage = "";
$penbutton = "";
$penbutton2 = "";
$formabout = "";
$formother = "";
$profil_bild = "";

if($_SESSION['roletype'] == 1)
{
	header("Location: admin.php");
}

if(!empty($_GET))
{
	
// Hämtar ut om användaren
	$profileinfo = <<<END

		SELECT keepername, fname, lname, about, other
		FROM user
		WHERE keeperid = '{$keeperid2}';
END;
	$res = $mysqli->query($profileinfo) or die();

	if($res->num_rows == 1)
	{
		$row = $res->fetch_object();
		$profilekeepername = $row->keepername;
		$profilename = $row->fname;
		$profilelastname = $row->lname;
		$profileabout = $row->about;
		$profileother = $row->other;

	}
// Hämtar ut annan användaren bild
$query = <<< END

	
	SELECT picname, type, size, link
	FROM picture
	JOIN userpic
	ON userpic.picid = picture.picid
	WHERE keeperid = '{$keeperid2}';
END;

	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		if($row = $res->fetch_object())
		{
			$link = $row->link;

			if(file_exists($link))
			{
				$profil_bild = <<<END
			<img class="profil_bild" src="{$link}">	
END;
			}
			else
			{
			$profil_bild = <<<END
			<img src="images/profil_bild.png">
END;
			}
	

		}
	}
// Hämtar ut senaste aktiviteterna för anvnändaren
$latestact = <<<END

	SELECT guidereviewinfo.grid, guidereviewinfo.title, guidereviewinfo.timestamp, guidereviewinfo.grade, userguidereview.grid
	FROM guidereviewinfo
	JOIN userguidereview
	ON guidereviewinfo.grid = userguidereview.grid
	WHERE keeperid = '{$keeperid2}'
	ORDER BY timestamp DESC
	
END;
$res = $mysqli->query($latestact) or die();

while($row = $res->fetch_object())
{
	$keeperid = $_SESSION['keeperid'];
	$grid = $row->grid;
	$title = utf8_decode(htmlspecialchars($row->title));
	$grade = $row->grade;
	$timestamp = strtotime($row->timestamp);
	$timestamp = date("d M Y H:i", $timestamp);

	$r = "<span class=\"glyphicon glyphicon-edit pull-left\" aria-hidden=\"true\">&nbsp;</span>";
	$g = "<span class=\"glyphicon glyphicon-book pull-left\" aria-hidden=\"true\">&nbsp;</span>";

	if($grade > 0)
	{

		$latestactivity .= <<<END
		
		
		 
			<a href="genre.php?grid={$grid}">{$title}</a>{$r}
		

END;
	}
	else
	{

		$latestactivity .= <<<END
		 
			<a href="genre.php?grid={$grid}">{$title}</a>{$g}
		

END;
	}
	
}

// Lägger till "lägg till vän" knapp om man är inne på en annan användares profil
$button = <<<END
	<form method="post">
	<button type="submit" name="keeperfr" value="Lägg till">Lägg till vän</button>
	</form>
END;

// Skickar in vänförfrågan i databasen
/*if(isset($_POST['keeperfr'])){

	$query = <<<END
	INSERT INTO keeperfriend(keeperid, keeperid2, accept) 
	VALUES ('{$keeperid}', '{$keeperid2}', '');
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

}*/

$sendmessage = <<<END
	<button><a href="chatcom.php?keeperid={$keeperid2}">Skicka meddelande</a></button>
END;
}







// Hämtar ut all information om ens egen profil
else
{

$query = <<< END

	
	SELECT picname, type, size, link
	FROM picture
	JOIN userpic
	ON userpic.picid = picture.picid
	WHERE keeperid = '{$keeperid}';
END;

	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	if($res->num_rows == 0)
	{
				$profil_bild = <<<END
			<img src="images/profil_bild.png">	
END;
			}
			else if($res->num_rows > 0)
				{
					if($row = $res->fetch_object())
					{
						$link = $row->link;

						if(file_exists($link))
						{
							$profil_bild = <<<END
						<img src="{$link}">
END;
			}
	

		}
	}
	
	$penbutton = <<<END
	<a href="#"><img src="images/pen.png" width="30px" id="pen" class="pull-right" title="Redigera"></a>
END;
	$penbutton2 = <<<END
	<a href="#"><img src="images/pen.png" width="30px" id="pen2" class="pull-right" title="Redigera"></a>
END;

	$formabout = <<<END

		<form action="profile.php" method="post" id="updateform">
			<textarea id="updateinfo" name="updateinfo" cols="60" row="10">{$profileabout}</textarea>
			<input type="submit" id="submit" name="update" value="Uppdatera info">
		</form>
END;

	$formother = <<<END

		<form action="profile.php" method="post" id="updateformother">
			<textarea id="updateother" name="updateother" cols="30" row="10">{$profileabout}</textarea>
			<input type="submit" id="submit" name="updateothers" value="Uppdatera info">
		</form>
END;

if(isset($_POST['update']))
{
	$about = $_POST['updateinfo'];
	$query = <<<END

		UPDATE user SET about ='$about'
		WHERE keeperid = '{$keeperid}'
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}
if(isset($_POST['updateothers']))
{
	$other = $_POST['updateother'];

	$query = <<<END

		UPDATE user SET other = '$other'
		WHERE keeperid = '{$keeperid}';
END;
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}
// Hämtar ut om användaren
$profileinfo = <<<END

	SELECT keepername, fname, lname, about, other
	FROM user
	WHERE keeperid = '{$keeperid}';
END;
	$res = $mysqli->query($profileinfo) or die();

	if($res->num_rows == 1)
	{
		$row = $res->fetch_object();
		$profilekeepername = $row->keepername;
		$profilename = $row->fname;
		$profilelastname = $row->lname;
		$profileabout = $row->about;
		$profileother = $row->other;

	}

// Hämtar ut senaste aktiviteterna för anvnändaren
$latestact = <<<END

	SELECT guidereviewinfo.grid, guidereviewinfo.title, guidereviewinfo.timestamp, guidereviewinfo.grade, userguidereview.grid
	FROM guidereviewinfo
	JOIN userguidereview
	ON guidereviewinfo.grid = userguidereview.grid
	WHERE keeperid = '{$keeperid}'
	ORDER BY timestamp DESC
	
END;
$res = $mysqli->query($latestact) or die();

while($row = $res->fetch_object())
{
	$keeperid = $_SESSION['keeperid'];
	$grid = $row->grid;
	$title = utf8_decode(htmlspecialchars($row->title));
	$grade = $row->grade;
	$timestamp = strtotime($row->timestamp);
	$timestamp = date("d M Y H:i", $timestamp);

	$r = "<span class=\"glyphicon glyphicon-edit pull-left\" aria-hidden=\"true\">&nbsp;</span>";
	$g = "<span class=\"glyphicon glyphicon-book pull-left\" aria-hidden=\"true\">&nbsp;</span>";
	
	if($grade > 0)
	{

		$latestactivity .= <<<END
		 
			{$r}<button class="btn btn-sm-span btn-default-span delete"><a href="delete.php?grid={$grid}">
			<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true">
			</span></a></button>
			
			<button class="btn btn-sm-span btn-default-span edit"><a href="guide_review_edit.php?grid={$grid}">
			<span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a></button>
			<a href="genre.php?grid={$grid}">{$title}</a>			
			</li><br><br>
			
END;
	}
	else
	{

		$latestactivity .= <<<END
		 
			{$g}<button class="btn btn-sm-span btn-default-span delete"><a href="delete.php?grid={$grid}">
			<span class="glyphicon glyphicon-remove pull-right pic-top" aria-hidden="true">
			</span></a></button>
			<button class="btn btn-sm-span btn-default-span edit"><a href="guide_review_edit.php?grid={$grid}">
			<span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a></button>
			<a href="genre.php?grid={$grid}">{$title}</a>		
			</li><br><br>
		
END;
	}
	
}
// FORTSÄTTNING FÖLJER!
$query = <<<END
	SELECT * FROM repchatcom
	JOIN replys
	ON replys.replyid = repchatcom.replyid
	JOIN chatcom
	ON chatcom.chatcomid = repchatcom.chatcomid
	WHERE repchatcom.keeperid = '{$keeperid}'
	OR repchatcom.keeperid2 = '{$keeperid}';
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
			while($row = $res->fetch_object())
			{

				$chatcomid = $row->chatcomid;
				$reply = $row->reply;
				$keeper = $row->keeperid;
				$keeper2 = $row->keeperid2;

				$chatmess = <<<END
					<a href="chatcom.php?chatcomid={$chatcomid}">{$reply}</a><br>
					
END;
				
				
			}
		
	
	}


}



$v = "<span class=\"glyphicon glyphicon-user pull-left pic-top\" aria-hidden=\"true\">&nbsp;</span>";
$k = "<span class=\"glyphicon glyphicon-comment pull-left pic-top\" aria-hidden=\"true\">&nbsp;</span>";

$content = <<<END

		

				<div class="row margin-top-100">
			
					<div class="col-md-3 col-sm-3 pull-left">

	  					<div class="row profil margin-left-profile">
	  					
	  						<div class="column-left-top">
								<br>
	  					
	  							<p class="text-center quicksand text-bold text-16px">Välkommen</p>
  	  					
  	  						</div>	  					
	  					
	  						<div class="column-left-center text-center profil_bild">	  							
								
	  							{$profil_bild}	  							

	  						
								<p class="text-bold">{$profilekeepername}</p>
	  							{$button}
	  							{$sendmessage}
								
	  						</div>

	  						<div class="column-left-bottom">
								<p class="text-center quicksand text-bold text-16px">Senaste inläggen</p>
		  						<div class="profileinformation text-left text-black">
									
		  								<p class="text-left">
											{$r} Recensioner <span class="badge pull-right">15</span><br>
											{$g} Guider <span class="badge pull-right">7</span><br>
											<div class="friends">
												{$v} Vänner <span class="badge pull-right">78</span><br>
											</div>
											<div class="latestmessage">
												{$k} <!-- insat chat har --> Chat konversation <span class="badge pull-right">5</span>	<br>
												{$chatmess}		
											</div>								
										</p>
		  						</div>


	  							<p class="text-center quicksand text-bold text-16px">Sociala Medier</p>
								
								<!-- Twitter -->
								<a href="https://twitter.com/skrivditttwitternamn" class="twitter-follow-button" data-show-count="false">
									Follow @skrivditttwitternamn
									
								</a>
								<script>
									!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
									if(!d.getElementById(id)){js=d.createElement(s);
									js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);
									}}(document, 'script', 'twitter-wjs');
								</script>
								
								<!-- facebook -->
								<div id="fb-root"></div>
								
								<script>
									(function(d, s, id) {
										var js, fjs = d.getElementsByTagName(s)[0];
										if (d.getElementById(id)) return;
										js = d.createElement(s); js.id = id;
										js.src = "//connect.facebook.net/da_DK/sdk.js#xfbml=1&version=v2.3";
										fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));
								</script>
								
								<div class="fb-follow" data-href="https://www.facebook.com/dinfb" data-colorscheme="dark" data-layout="button"
								data-show-faces="false">
								</div>
								
								<button>Twitch Följ</button>

	  						</div><!-- column left bottom -->
						
						</div><!-- row -->

						</div>
						
						<div class="col-md-6 col-sm-6 panel-width-550px panel panel-default pull-left">

	  					<div class="panel-heading panel-heading-560px">Om mig {$penbutton}</div>


		  					<div class="panel-body">

			  					<p>Namn: {$profilename} {$profilelastname}</p> 
			  					{$profileabout}
			  						
			  					{$formabout}


		  					</div><!-- panel body -->

						</div><!-- col md 6 -->

						<div class="col-md-3 col-sm-3 content-right pull-right">
							<div class="ads">
							<!-- Reklam karusel -->
		  						<img src="images/ad_req.jpg" class="ads pull-right" width="300px">
		  						<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

		  					
							</div><!-- reklam kolumn -->

						</div><!-- row -->
					

					<div class="col-md-3 col-sm-3 ovrigt panel panel-default pull-left">

	  					<div class="panel-heading ovrigt-heading">Övrigt {$penbutton2}</div>

		  					<div class="panel-body">
 								{$profileother}
 								{$formother}
		  					</div>
						
						</div><!-- panel heading -->

						<div class="col-md-3 col-sm-3 aktiviteter panel panel-default pull-left margin-left-25px">

	  					<div class="panel-heading aktiviteter-heading">Aktiviteter</div>

		  					<div class="panel-body margin-horizontal-zero">
 
		  						<a href class="text-primary">
								<span class="pic-top media">
								{$latestactivity}
								</span>
								</a>

		  					</div>
						
						</div><!-- panel heading -->



					
					</div><!-- kolumn 2 -->
					</div><!-- kolumn 2 -->

				</div><!-- row -->
<script>
$(document).ready(function(){
	$('#updateform').hide();
		$('#pen').click(function(){
			$('#updateform').show();
		});
});

</script>

<script>
$(document).ready(function(){
	$('#updateformother').hide();
		$('#pen2').click(function(){
			$('#updateformother').show();
		});
});

</script>
  
END;


echo $header;
echo $content;
echo $footer;
?>