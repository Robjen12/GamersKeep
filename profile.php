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
$profil_bild = <<<END
			<img src="images/profil_bild.png">	
END;
$yourfriends = "";
$getchatcomid = "";
$accept = "";
$friendsaccept = "";
//
if($_SESSION['roletype'] == 1)
{
	header("Location: admin.php");
}

if(!empty($_GET['keeperid']))
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
						<img src="{$link}">
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
		 
			{$r}<a href="genre.php?grid={$grid}">{$title}</a>
		

END;
	}
	else
	{

		$latestactivity .= <<<END
		 
			{$g}<a href="genre.php?grid={$grid}">{$title}</a>
		

END;
	}
	
}
// Skickar in vänförfrågan i databasen
if(isset($_POST['keeperfr'])){

	$query = <<<END
	INSERT INTO keeperfriend(keeperid, keeperid2, accept) 
	VALUES ('{$keeperid}', '{$keeperid2}', '');
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

}
// Visar om man är vänner eller behöver lägga till vän.
$query = <<<END
	SELECT *
			   FROM keeperfriend
			   WHERE keeperid = '{$keeperid}'
			   AND keeperid2 = '{$keeperid2}'
			   OR keeperid2 = '{$keeperid}'
			   AND keeperid = '{$keeperid2}';		   
END;

		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

		if($res->num_rows == 1)
		{
			while($row = $res->fetch_object())
			{
			
				$accept = $row->accept;

				if($accept == 0)
				{
					$button = <<<END
					<button class="success pull-right">Vänförfrågan har skickats</button><br>
END;
							
				}
				else
				{
					$button = <<<END
					
END;
				}
			}
		}
		else
		{		
				$button = <<<END

				<form action="profile.php?keeperid={$keeperid2}" method="post">
				<button type="submit" name="keeperfr" value="Lägg till">Lägg till vän</button><br>
				</form>
END;

		}

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

	if($res->num_rows > 0)
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
		 
			<button class="btn btn-sm-span btn-default-span delete"><a href="delete.php?grid={$grid}"><span class="glyphicon glyphicon-remove pen pull-right" aria-hidden="true"></span></a></button>
			<button class="btn btn-sm-span btn-default-span edit"><a href="guide_review_edit.php?grid={$grid}"><span class="glyphicon glyphicon-pencil pen pull-right" aria-hidden="true"></span></a></button>
			
			</li>{$r}
			
			<a href="genre.php?grid={$grid}">{$title}</a>
			<br><br>
			
			
END;
	}
	else
	{

		$latestactivity .= <<<END
		 
			
			<button class="btn btn-sm-span btn-default-span delete"><a href="delete.php?grid={$grid}"><span class="glyphicon glyphicon-remove pull-right pen" aria-hidden="true"></span></a></button>
			<button class="btn btn-sm-span btn-default-span edit"><a href="guide_review_edit.php?grid={$grid}"><span class="glyphicon glyphicon-pencil pull-right pen" aria-hidden="true"></span></a></button>
			</li>{$g}
			
			<a href="genre.php?grid={$grid}">{$title}</a>
			<br><br>
		
END;
	}
	
}

$query = <<<END
		SELECT *
			   FROM message
			   JOIN user
			   ON message.keeperid = user.keeperid
			   OR message.keeperid2 = user.keeperid
			   WHERE user.keeperid = '{$keeperid}'
			   GROUP BY keeperid2;
END;

		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		  " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{
			$keeperid1 = $row->keeperid;
			$keeperid2 = $row->keeperid2;

				if($keeperid == $row->keeperid)
				{
					$query = <<<END

						SELECT keeperid, keepername
						FROM user
						WHERE keeperid = '{$keeperid2}';

END;
				
					$res2 = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		 			 " : " . $mysqli->error);

					$row2 = $res2->fetch_object();
					$keepername2 = $row2->keepername;
					$keeper2 = $row->keeperid2;

					if(strtolower($keepername2) != strtolower($keepername) )
					{
					$chatmess .= <<<END
					<a href="chatcom.php?keeperid={$keeper2}">{$keepername2}</a><br>
END;
					}

				}
				else
				{
					$query = <<<END

						SELECT keepername, keeperid
						FROM user
						WHERE keeperid = '{$keeperid1}';
END;
				
					$res3 = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		 			 " : " . $mysqli->error);

					$row3 = $res3->fetch_object();
					$keepername1 = $row3->keepername;
					$keeper = $keeperid1;

					if(strtolower($keepername1) != strtolower($keepername))
					{
						$chatmess .= <<<END
						<a href="chatcom.php?keeperid={$keeper}">{$keepername1}</a><br>
END;
					}
				}

		}
							
			
		
	
	}
	if(isset($_POST['yes']))
 {

  $keeperfriendid1 = $_GET["keeperfriendid"];

  $query = <<<END
   UPDATE keeperfriend SET accept = 1
   WHERE keeperfriend.keeperfriendid = '{$keeperfriendid1}';
  
END;

  $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
          " : " . $mysqli->error);

  }
 if(isset($_POST['no']))
 {
  $keeperfriendid1 = $_GET["keeperfriendid"];

  $query = <<<END

   DELETE FROM keeperfriend 
   WHERE keeperfriend.keeperfriendid = '{$keeperfriendid1}';
END;
  $res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
           " : " . $mysqli->error);

 }


	$query = <<<END

	SELECT *
	FROM keeperfriend
	WHERE keeperfriend.keeperid2 = '{$keeperid}'
	AND accept = 0;

END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		  " : " . $mysqli->error);

	if($res->num_rows > 0)
	{

		while($row = $res->fetch_object())
		{
			$friendkeeperfriendid = $row->keeperfriendid;
			$friendkeeperid = $row->keeperid;
			$friendkeeperid2 = $row->keeperid2;
			$friendaccept = $row->accept;

			if($keeperid == $friendkeeperid2)
			{

				$query = <<<END

					SELECT keeperid, keepername FROM user
					WHERE keeperid = '{$friendkeeperid}';
END;
				$res2 = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

				$row2 = $res2->fetch_object();
				$friendkeepername = $row2->keepername;
				

					if($friendkeepername != $keepername)
					{
						
							$friendsaccept .= <<<END

								
								<form action="profile.php?keeperfriendid={$friendkeeperfriendid}" method="post">
								
								<a href="profile.php?keeperid={$friendkeeperid}"><span class="glyphicon glyphicon-user pull-left" aria-hidden="true">&nbsp;</span>{$friendkeepername}</a>
									<button type="submit" class="btn btn-sm-span span-color-green" name="yes" value=""><span class="glyphicon glyphicon-ok pull-left" aria-hidden="true"></span></button>
									&nbsp;
									<button type="submit" class="btn btn-sm-span span-color-red" name="no" value=""><span class="glyphicon glyphicon-remove pull-left" aria-hidden="true"></span></button>
								</form>
								<br>
END;
	
					}
			

			}
			
		}
	}

$query = <<<END

			   SELECT *
			   FROM keeperfriend
			   
				WHERE (keeperid = '{$keeperid}'
					OR keeperid2 = '{$keeperid}')
			   AND accept = 1

END;

	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		  " : " . $mysqli->error);

	$friend_count = 0;

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{
			$keeperid1 = $row->keeperid;
			$keeperid2 = $row->keeperid2;
			$accept = $row->accept;

				if($keeperid == $keeperid1)
				{
					$query = <<<END

						SELECT keeperid, keepername
						FROM user
						WHERE keeperid = '{$keeperid2}';

END;
				
					$res2 = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		 			 " : " . $mysqli->error);

					$row2 = $res2->fetch_object();
					$keepername2 = $row2->keepername;
					$keeper2 = $row->keeperid2;

					if($keepername2 != $keepername)
					{
						$friend_count++;
							$yourfriends .= <<<END
							<a href="profile.php?keeperid={$keeper2}">{$keepername2}</a><br>
END;
						
					}

				}
				else 
				{
					$query = <<<END

						SELECT keepername, keeperid
						FROM user
						WHERE keeperid = '{$keeperid1}';
END;
				
					$res3 = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		 			 " : " . $mysqli->error);

					$row3 = $res3->fetch_object();
					$keepername1 = $row3->keepername;
					$keeper = $keeperid1;

					if($keepername1 != $keepername)
					{
						$friend_count++;
						$yourfriends .= <<<END
						<a href="profile.php?keeperid={$keeper}">{$keepername1}</a><br>
END;
					}
				}



		}
							
			
		
	
	}


}


$v = "<span class=\"glyphicon glyphicon-user pull-left\" aria-hidden=\"true\">&nbsp;</span>";
$k = "<span class=\"glyphicon glyphicon-comment pull-left\" aria-hidden=\"true\">&nbsp;</span>";

$content = <<<END

		

				<div class="row margin-top-100 profile-page">
			
					<div class="profile-tower pull-left">

	  					<div class="row profil margin-left-profile">
	  					
	  						<div class="column-left-top">
								<br>
	  					
	  							<p class="text-center quicksand text-bold text-16px">Välkommen</p>
  	  					
  	  						</div><!-- left top -->				
	  					
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
											{$r} Recensioner <span class="badge badge-info pull-right">15</span><br>
											{$g} Guider <span class="badge primary pull-right">7</span><br>

											<div class="almostfriends">

												{$v} Vänförfrågan <span class="badge badge-warning pull-right"></span><br>
										
												{$friendsaccept}
											</div>

											<div class="friends">

												{$v} Vänner <span class="badge badge-warning pull-right">78</span><br>
												{$yourfriends}
											</div>
									
								
											<div class="latestmessage">
												{$k} <!-- insat chat har --> Chat konversation <span class="badge badge-success pull-right">5</span>	<br>
												{$chatmess}		
											</div>								
										</p>
		  						


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
							
							</div><!-- column left bottom2 -->
						
						</div><!-- row -->

						</div>
						
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-12 col-sm-12 panel-width-550px panel panel-default pull-left">

			  					<div class="panel-heading panel-heading-560px">Om mig {$penbutton}</div>


				  					<div class="panel-body">

					  					<p>Namn: {$profilename} {$profilelastname}</p> 
					  					{$profileabout}
					  						
					  					{$formabout}


				  					</div><!-- panel body -->

								</div><!-- col md 12 -->

								<div class="col-md-6 col-sm-6 ovrigt panel panel-default pull-left">

				  					<div class="panel-heading ovrigt-heading">Övrigt {$penbutton2}</div>

					  					<div class="panel-body">
			 								{$profileother}
			 								{$formother}
					  					</div>
									
									</div><!-- panel heading -->

									<div class="col-md-3 col-sm-3 aktiviteter panel panel-default pull-left margin-left-25px">

					  					<div class="panel-heading aktiviteter-heading">Aktiviteter</div>

						  					<div class="panel-body margin-horizontal-zero">
				 
						  						<a href class="text-primary">{$latestactivity}</a>

						  					</div>
										
										</div><!-- panel heading -->



								
									</div><!-- kolumn 2 -->
								</div><!-- kolumn 2 -->
							</div>
						</div>

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