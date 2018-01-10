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
	Add_Medico($_POST["name"],$_POST["NIF"],$_POST["Specs"]); 
}
function editMedico(){
    
    Edit_Medico($_POST["iddoc"],$_POST["name"],$_POST["NIF"],$_POST["Specs"]); 
}
?>