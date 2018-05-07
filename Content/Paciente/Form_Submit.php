<?php
include("../../Controls/DB_Auxiliar.php");

$op=$_POST["op"];
 
$Link ="http://".$_SERVER['HTTP_HOST']."/MedicalAppoint/Content/";

switch ($op) {
    case "addPatient":
        addPatient();
        header('Location: '.$Link."Paciente/list.php");
        break;
    case "InactivatePatient":
        InactivatePatient();
        header('Location: '.$Link."Paciente/list.php");
        break;
    case "DeletePatient":
        DeletePatient();
        header('Location: '.$Link."Paciente/list.php");
        break;
    case "editPatient":
        EditPatient();
        header('Location: '.$Link."Paciente/list.php");
        break;
}

function addPatient(){ 
    add_Patient($_POST["Name"],$_POST["NIF"],$_POST["Morada"],$_POST["CodPostal"],$_POST["localidade"],$_POST["tlm"],$_POST["email"],$_POST["Clinics"]);
} 
function EditPatient(){  
    Edit_Patient($_POST["idP"],$_POST["Name"],$_POST["NIF"],$_POST["Morada"],$_POST["CodPostal"],$_POST["localidade"],$_POST["tlm"],$_POST["email"],$_POST["Clinics"]);
} 
function InactivatePatient(){  
    Inactivate_Patient($_POST["idPatient"],$_POST["status"]);
} 
function DeletePatient(){  
    Delete_Patient($_POST["idPatient"]);
} 