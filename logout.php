<?php
// Stänger sessionen och skickar användaren tillbaks till loginsidan
session_start();

$_SESSION = array();

session_unset();
session_destroy();

header("Location: login.php");
?>