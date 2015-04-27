<?php
include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeperid = $_SESSION['keeperid'];

$uploadDir = 'pictures/';

if(isset($_POST['upload']))
{
$fileName = $_FILES['userfile']['name'];
$tmpName = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

// get the file extension first
$ext = substr(strrchr($fileName, "."), 1); 

// make the random file name
$randName = md5(rand() * time());

$filePath = $uploadDir . $randName . '.' . $ext;

$result = move_uploaded_file($tmpName, $filePath);
if (!$result) {
echo "Error uploading file";
exit;
}

if(!get_magic_quotes_gpc())
{
$fileName = addslashes($fileName);
$filePath = addslashes($filePath);
}

$query = <<<END
	INSERT INTO picture (picname, size, type, link )
	VALUES ('$fileName', '$fileSize', '$fileType', '$filePath');
END;
 	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
 $query = <<<END
 	INSERT INTO userpic(picid, keeperid)
 	VALUES (LAST_INSERT_ID(), '{$keeperid}');
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);



echo "<br>Files uploaded<br>";
header("Location: profile.php");
}
?>