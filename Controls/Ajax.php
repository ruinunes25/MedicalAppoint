<?php
include("../Controls/DB_Auxiliar.php");
session_start();

$op=isset($_GET["op"])?$_GET["op"]:$_POST["op"];

switch ($op) {
    case "GetUtents":
        GetUtents(); 
        break;
    case "GetPatientInfo":
        GetPatientInfo(); 
        break;
}

function GetUtents(){
    $clinic=isset($_GET["clinic"])?$_GET["clinic"]:$_POST["clinic"];
     
    $Clients=getPatients($clinic);
    
    echo $Clients; 
}
function GetPatientInfo( ){
    $id=isset($_GET["idPatient"])?$_GET["idPatient"]:$_POST["idPatient"];
    
     $Patient=getPatient($id);
    
     echo $Patient; 
}