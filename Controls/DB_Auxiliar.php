<?php
include("DataBase.php");
include("querys.php");

function getSpeci(){ 
	$sql=getSpecialities();
	$conn=openConn();
	$result=array();
	
	foreach ($conn->query($sql) as $row) {
		array_push($result,array("id"=>$row["id"],
				"nome"=>utf8_encode($row["nome"]),
								"estado"=>$row["estado"],
				"status"=>$row["status"]
		));
	}
	closeConn($conn);
 
	return json_encode($result);
}
function getActiveClinics(){
    $sql="SELECT id, nome  FROM `clinica`
						where deleted_at is null
						and status=1";
    $conn=openConn();
    $result=array();
    
    foreach ($conn->query($sql) as $row) {
        array_push($result,array("id"=>$row["id"],
            "nome"=>utf8_encode($row["nome"])
        ));
    }
    closeConn($conn);
    
    return json_encode($result);
}

function getActiveSpeci(){ 
	$sql=getActiveSpeciSQL();
	$conn=openConn();
	$result=array();
	
	foreach ($conn->query($sql) as $row) {
		array_push($result,array("id"=>$row["id"],
				"nome"=>utf8_encode($row["nome"])
		));
	}
	closeConn($conn);
 
	return json_encode($result);
}
function getSpeciByDoctir($doctor_id){
	$sql="select id,nome from especialidade 
		 where status=1 and
		deleted_at is null
		and id in (select id_especialidade 
					from medico_especialidade 
					where status=1 and
					deleted_at is null
					and id_medico=$doctor_id)";
	$conn=openConn();
	$result=array();
 
	foreach ($conn->query($sql) as $row) {
		array_push($result,array("id"=>$row["id"],
				"nome"=>utf8_encode($row["nome"])
		));
	}
	 
	closeConn($conn);
	
	return $result;
}

function getDoctors(){
	$sql=getDoctorsQuerys(); 
	$conn=openConn();
	$result=array();
	 
	foreach ($conn->query($sql) as $row) {
		array_push($result,array("id"=>$row["id"],
				"nome"=>$row["nome"],
				"estado"=>$row["estado"],
				"nif"=>$row["nif"],
				"status"=>$row["status"],
				"specs"=>getSpeciByDoctir($row["id"])
		));
	}
	 
	 
	closeConn($conn);  
	return json_encode($result);
}
function Add_Especialidade($name){
	$sql=addEspecialidadeSQL($name);
	$conn=openConn(); 
	$conn->query($sql); 
	closeConn($conn); 
}
function Inactivate_Especialidade($id,$status){
	$sql=InactivateEspecialidadeSQL($id,$status);
	$conn=openConn();
	$conn->query($sql);
	closeConn($conn);
}
function Delete_Especialidade($id){
	$sql=DeleteEspecialidadeSQL($id);
	$conn=openConn();
	$conn->query($sql);
	closeConn($conn);
}

function Edit_Especialidade($id,$name_){
	$sql=EditEspecialidadeSQL($id,$name_);
	 
	$conn=openConn();
	$conn->query($sql);
	closeConn($conn);
}
function Add_Medico($nome,$NIF,$Specs){
    $Specs=json_decode($Specs);
    
	$sql = "INSERT INTO medicos (nome, nif)
			VALUES ('$nome', '$NIF')"; 
	$conn=openConn();
	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		foreach ($Specs as $spc){
			$sql = "INSERT INTO medico_especialidade (id_medico ,id_especialidade)
			VALUES ($last_id, $spc)";
			$conn->query($sql);
		}
	} else {
		 
	}
	closeConn($conn);
} 
function Edit_Medico($id,$nome,$NIF,$Specs){
    $Specs=json_decode($Specs);
    
	$sql = "update medicos 
            set nome='$nome', 
            nif='$NIF',
            updated_at=CURRENT_TIMESTAMP() 
			where id=$id"; 
	
	 
	$conn=openConn();
	$conn->query($sql);
    $conn->query("delete from medico_especialidade where id_medico=$id");
	foreach ($Specs as $spc){ 
		$sql = "INSERT INTO medico_especialidade (id_medico ,id_especialidade)
		         VALUES ($id, $spc)";
		$conn->query($sql);
	}
	closeConn($conn);
} 
?>