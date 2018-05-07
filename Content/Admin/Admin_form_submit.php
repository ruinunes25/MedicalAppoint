<?php
include("../../Controls/DB_Auxiliar.php");

$op=$_POST["op"];

//echo $op.'---'.$_POST["idEspecialidade"].'--'.$_POST["name"];

$Link ="http://".$_SERVER['HTTP_HOST']."/MedicalAppoint/Content/";

switch ($op) {
	case "addEspecialidade":
		addEspecialidade();
		header('Location: '.$Link."Admin/Admin_Especialidade.php"); 
		break;
	case "InactivateEspecialidade":
		InactivateEspecialidade();
		header('Location: '.$Link."Admin/Admin_Especialidade.php"); 
		break;
	case "DeleteEspecialidade":
		DeleteEspecialidade();
		header('Location: '.$Link."Admin/Admin_Especialidade.php"); 
		break;
	case "editEspecialidade":
		EditEspecialidade();
		header('Location: '.$Link."Admin/Admin_Especialidade.php"); 
		break;
	case "addMedico":
		addMedico();
		header('Location: '.$Link."Admin/Admin_medicos.php");
		break;
	case "editMedico":
	    editMedico();
	    header('Location: '.$Link."Admin/Admin_medicos.php");
	    break;
	case "InactivateMedico":
	    InactivateMedico();
	    header('Location: '.$Link."Admin/Admin_medicos.php");
	    break;
	case "DeleteMedico":
	    DeleteMedico();
	    header('Location: '.$Link."Admin/Admin_medicos.php");
	    break;
	case "addUser":
	    addUser();
	    header('Location: '.$Link."Admin/Admin_users.php");
	    break;
	case "editUser":
	    editUser();
	    header('Location: '.$Link."Admin/Admin_users.php");
	    break;
	case "InactivateUser":
	    InactivateUser();
	    header('Location: '.$Link."Admin/Admin_users.php");
	    break;
	case "DeleteUser":
	    DeleteUser();
	    header('Location: '.$Link."Admin/Admin_users.php");
	    break;
}

function addEspecialidade(){
	Add_Especialidade($_POST["name"]);
}
function InactivateEspecialidade(){
	Inactivate_Especialidade($_POST["idEspecialidade"],$_POST["status"]); 
}
function DeleteEspecialidade(){
	Delete_Especialidade($_POST["idEspecialidade"]); 
}
function EditEspecialidade(){ 
	Edit_Especialidade($_POST["idEspecialidade"],$_POST["name"]); 
}
function addMedico(){
	Add_Medico($_POST["name"],$_POST["NIF"],$_POST["Specs"],$_POST["Clinics"]); 
}
function editMedico(){
    
    Edit_Medico($_POST["iddoc"],$_POST["name"],$_POST["NIF"],$_POST["Specs"],$_POST["Clinics"]); 
}
function InactivateMedico()
{
    Inactivate_Medico($_POST["idDoc"],$_POST["status"]); 
}  
function DeleteMedico()
{
    Delete_Medico($_POST["idDoc"]);
} 


function addUser(){
    Add_User($_POST["firstname"],$_POST["lastname"],$_POST["username"],$_POST["email"],$_POST["Clinics"]); 
}
function editUser(){
    Edit_User($_POST["iduser"],$_POST["firstname"],$_POST["lastname"],$_POST["username"],$_POST["email"],$_POST["Clinics"]);
}
function InactivateUser(){
    Inactivate_User($_POST["iduser"],$_POST["status"]);
}
function DeleteUser(){
    Delete_User($_POST["iduser"]);
}  

?>