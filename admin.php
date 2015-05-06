<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");
$grid = isset($_GET['grid']) ? $_GET['grid'] : "";
$commentid = isset($_GET['commentid']) ? $_GET['commentid'] : "";
$gr_flag = "";
$comment_flag = "";
$commentids = "";
$admit = "";

// Sätter flaggan till noll om innehållet inte är olämpligt
if(isset($_POST['ok']))
{
	$admit = <<<END
		UPDATE guidereviewinfo SET flag = 0
		WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($admit) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}
// Hämtar ut allt i guidereviewinfo som har status 1 i posten flag
$query = <<<END

	SELECT * FROM guidereviewinfo
	WHERE flag = 1;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{

			$grid = $row->grid;
			$title = utf8_decode(htmlspecialchars($row->title));

			$gr_flag .= <<<END
				
				<form action="admin.php?grid={$grid}" method="post">
				<a href="genre.php?grid={$grid}">{$title}</a>
					<button type="submit" name="ok" value="">V</button>
					<button class="delete"><a href="delete.php?grid={$grid}">X</a></button>
				</form>
				
				
				

END;
		}
	}


if(isset($_POST['okcomment']))
{
	$admit = <<<END
		UPDATE comment SET flag = 0
		WHERE commentid = '{$commentid}';
END;
	$res = $mysqli->query($admit) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}
// Hämtar ut allt i comment som har status 1 i posten flag
$query = <<<END

	SELECT * FROM comment
	WHERE flag = 1;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{
			$commentgrid = $row->grid;
			$commentids = $row->commentid;
			$comment = utf8_decode(htmlspecialchars($row->comment));

			$comment_flag .= <<<END
				
				<form action="admin.php?commentid={$commentids}" method="post">
				<a href="genre.php?grid={$commentgrid}">{$comment}</a>
				
					<button type="submit" class="btn-sm-span" name="okcomment" value="">
						<span class="glyphicon glyphicon-ok text-success pull-left" aria-hidden="true"></span>
					</button>
														
					<button class="btn-sm-span delete"><a href="delete.php?commentid={$commentids}">
						<span class="glyphicon glyphicon-remove text-danger pull-left" aria-hidden="true"></span>
					</a></button>
					<br>
					<br>
				</form>
END;
		}
	}
			//<button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
			//<button class="admit"><a href="admin.php?grid={$grid}">V</a></button><br><br>

	$content = <<<END
	<div class="row margin-top-100">
			
		<div class="col-md-12 panel panel-default panel-guide-review height-410px">
			
			<div class="panel-heading panel-heading-guide-review">
			
				Admin Profil
				
			</div><!-- panel heading -->
			
			<div class="panel-body ">
				<h4 class="quicksand text-bold">Guider och recensioner</h4>
				<p class="droid text-bold">
				{$gr_flag}<br>
				<h4 class="quicksand text-bold">Kommentarer</h4>
				{$comment_flag}<br>
				</p>
			</div><!-- panel body -->

		</div><!-- col md 12 -->
		
	</div><!-- row margin top 100 -->

	<script>
		$(document).ready(function(){
			$(.admit).click(function(){
				{$admit}
			});

		})

	</script>
END;

echo $header;
echo $content;
echo $footer;
?>