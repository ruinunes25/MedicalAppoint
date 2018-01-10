<?php

 
function openConn()
{
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$DataBase = "medicalappoint";
	$conn=null;
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$DataBase;charset=utf8", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully";
		return $conn;
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
}
function closeConn($conn)
{
	$conn=null;
}
?>