<?php
session_start();
$logged=isset($_SESSION["userID"])?true:false;
if($logged)
{
	header('Location: '."Content/home.php");
}
else
{
header('Location: '."Content/Login.php");
}
?>