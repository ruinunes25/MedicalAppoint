<?php
	
	include("DataBase.php");
	include("querys.php");
	session_start();
	$conn=openConn();
	$user=$_POST["username"];
	$pass=$_POST["password"];
	//echo $pass;
	$sql=loginQuery($user,$pass);
	$hasResults=false;
	echo $sql;
	foreach ($conn->query($sql) as $row) {
		$userid= $row['id']; 
		$name= $row['name'];
		$hasResults=true;
	}
	closeConn($conn);
//	exit();
	if($hasResults){
		$_SESSION["userID"]=$userid;
		$_SESSION["User_Name"]=$name;
		$_SESSION["Username"]=$user;
		
		$sqlQuery=getClinicasByUser($userid);
		$Arr=Array();
		foreach ($conn->query($sqlQuery) as $row) {
		    if($row['principal']==1){ 
		        $_SESSION["UserDefaultClinic"]=$row['id'];
		    }
			array_push($Arr,Array("id"=>$row['id'],
							"principal"=>$row['principal'],
							"name"=>$row["nome"]));
		}
		$_SESSION["user_clinicas"]=json_encode(Array("clinicas"=>$Arr));
		header('Location: '."../Content/home.php");
	}
	else {
		header('Location: '."../Content/Login.php?Error=1");
	}
	
	 
?>