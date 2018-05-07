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

function getClicnicsByDoctir($doctor_id){
	$sql="select id,nome from clinica 
		 where status=1 and
		deleted_at is null
		and id in (select id_clinica 
					from medico_clinica
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
				"specs"=>getSpeciByDoctir($row["id"]),
		        "Clicnics"=>getClicnicsByDoctir($row["id"])
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
function Add_Medico($nome,$NIF,$Specs,$Clinics){
    $Specs=json_decode($Specs);
    $Clinics=json_decode($Clinics);
	$sql = "INSERT INTO medicos (nome, nif)
			VALUES ('$nome', '$NIF')"; 
	$conn=openConn();
	$conn->query($sql);
	$q = $conn->query("SELECT max(id) lastid FROM `medicos` ");
	$f = $q->fetch();
	$last_id = $f["lastid"]; 
		foreach ($Specs as $spc){
			$sql = "INSERT INTO medico_especialidade (id_medico ,id_especialidade)
			VALUES ($last_id, $spc)";
			$conn->query($sql);
		}
		foreach ($Clinics as $spc){
		    $sql = "INSERT INTO medico_clinica (id_medico ,id_clinica)
		         VALUES ($last_id, $spc)";
		    $conn->query($sql);
		}
	 
	closeConn($conn);
} 
function Edit_Medico($id,$nome,$NIF,$Specs,$Clinics){
    $Specs=json_decode($Specs);
    $Clinics=json_decode($Clinics);
    
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
	
	$conn->query("delete from medico_clinica where id_medico=$id");
	foreach ($Clinics as $spc){
	    $sql = "INSERT INTO medico_clinica (id_medico ,id_clinica)
		         VALUES ($id, $spc)";
	    $conn->query($sql);
	}
	closeConn($conn);
} 
function Inactivate_Medico($id,$status)
{
    $sql="update `medicos` set status=$status, updated_at=CURRENT_TIMESTAMP() where id=$id";
    $conn=openConn();
    $conn->query($sql);
    closeConn($conn);
}

function Delete_Medico($id)
{
    $sql="update `medicos` set status=3, updated_at=CURRENT_TIMESTAMP(), deleted_at=CURRENT_TIMESTAMP() where id=$id";
    $conn=openConn();
    $conn->query($sql);
    closeConn($conn);
}


function getUsers(){
    $sql="seLECT id, username, CONCAT(firstname, ' ', lastname) as nome,firstname, lastname,status, email,
            (case when status=1 then 'Activo' when status=2 then 'Inactivo' else 'N.A' end) as estado 
          FROM `users` where deleted_at is null ";
    $conn=openConn();
    $result=array();
    
    foreach ($conn->query($sql) as $row) {
        array_push($result,array("id"=>$row["id"],
            "nome"=>$row["nome"],
            "estado"=>$row["estado"],
            "username"=>$row["username"],
            "firstname"=>$row["firstname"],
            "email"=>$row["email"],
            "lastname"=>$row["lastname"],
            "status"=>$row["status"], 
            "Clicnics"=>getClicnicsByUser($row["id"])
        ));
    }
    
    
    closeConn($conn);
    return json_encode($result);
}

function getClicnicsByUser($userid){
    $sql="select id,nome from clinica
		 where status=1 and
		deleted_at is null
		and id in (select id_clinica
					from user_clinica
					where status=1 and
					deleted_at is null
					and id_user=$userid)";
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


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz#%&ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*Region for Users*/
function Add_User($firstname,$lastname,$user,$email,$Clinics){ 
    $Clinics=json_decode($Clinics);
    $pass=generateRandomString(10);
    $encPass=md5($pass);
    $sql = "INSERT INTO users (firstname,lastname,username,email,password)
			VALUES ('$firstname', '$lastname','$user','$email','$encPass')";
    $conn=openConn();
    $conn->query($sql);
    $q = $conn->query("SELECT max(id) lastid FROM `users` ");
    $f = $q->fetch();
    $last_id = $f["lastid"]; 
    
    foreach ($Clinics as $spc){
        $sql = "INSERT INTO user_clinica (id_user ,id_clinica)
		         VALUES ($last_id, $spc)";
        $conn->query($sql);
    }
    
    mail($email, "Medical Appoint | criaçao de utilizador", "Foi criado o utilizador na aplicação.<br/> O seus dados de acesso são :<br/>
                                                                  <ul><li>user:$user</li><li>$pass</li></ul>");
    
}

function Edit_User($id,$firstname,$lastname,$user,$email,$Clinics){ 
    $Clinics=json_decode($Clinics); 
    $sql = "update users set
            firstname='$firstname',
            lastname='$lastname',
            username='$user',
            email ='$email'
            where id=$id ";
    $conn=openConn();
    $conn->query($sql);
    
    $last_id = $id; 
    
    $conn->query("delete from user_clinica where id_user=$id");
    foreach ($Clinics as $spc){
        $sql = "INSERT INTO user_clinica (id_user ,id_clinica)
		         VALUES ($last_id, $spc)";
        $conn->query($sql);
    }
     
}
function Inactivate_User($id,$status)
{
    $sql="update `users` set status=$status, updated_at=CURRENT_TIMESTAMP() where id=$id";
    $conn=openConn();
    $conn->query($sql);
    closeConn($conn);
}

function Delete_User($id)
{
    $sql="update `users` set status=3, updated_at=CURRENT_TIMESTAMP(), deleted_at=CURRENT_TIMESTAMP() where id=$id";
    $conn=openConn();
    $conn->query($sql);
    closeConn($conn);
}

function getPatients($idClinica){
    
    $sql="seLECT id, nome,morada, nif,status, codigopostal,localidade,status,
            (case when status=1 then 'Activo' when status=2 then 'Inactivo' else 'N.A' end) as estado
          FROM `paciente` where deleted_at is null
            and  id in (select id_paciente from paciente_clinica where id_clinica=$idClinica);";
    $conn=openConn();
    $result=array();
    
    foreach ($conn->query($sql) as $row) {
        array_push($result,array("id"=>$row["id"],
            "nome"=>$row["nome"],
            "estado"=>$row["estado"],
            "morada"=>$row["morada"],
            "nif"=>$row["nif"],
            "codigopostal"=>$row["codigopostal"], 
            "status"=>$row["status"],
            "localidade"=>$row["localidade"]
        ));
    }
    
    
    closeConn($conn);
    return json_encode($result);
    
}


/*Region Patients*/
function add_Patient($name,$nif,$morada,$codpostal,$localidade,$tlm,$email,$clinics){
    $Clinics=json_decode($clinics);
    
    $sql = "INSERT INTO paciente (nome,nif,morada,codigopostal,localidade,telemovel,email)
			VALUES ('$name', '$nif','$morada','$codpostal','$localidade','$tlm','$email')";
    $conn=openConn();
    $conn->query($sql);
    $q = $conn->query("SELECT max(id) lastid FROM paciente ");
    $f = $q->fetch();
    $last_id = $f["lastid"];
    
    foreach ($Clinics as $spc){
        $sql = "INSERT INTO paciente_clinica (id_paciente ,id_clinica)
		         VALUES ($last_id, $spc)";
        $conn->query($sql);
    }
} 
function Edit_Patient($id,$name,$nif,$morada,$codpostal,$localidade,$tlm,$email,$clinics){
    $Clinics=json_decode($clinics);
    
    $sql = "Update paciente 
            set nome='$name',
                nif='$nif',
                morada='$morada',
                codigopostal='$codpostal',
                localidade='$localidade',
                telemovel='$tlm',
                email='$email'
            where id=$id"; 
    
    $conn=openConn();
    $conn->query($sql); 
    
    $sql = "delete from paciente_clinica where id_paciente=$id";
    $conn->query($sql); 
    
    foreach ($Clinics as $spc){
        $sql = "INSERT INTO paciente_clinica (id_paciente ,id_clinica)
		         VALUES ($id, $spc)";
        $conn->query($sql);
    }
} 

function Inactivate_Patient($id,$status)
{
    $sql="update paciente set status=$status, updated_at=CURRENT_TIMESTAMP() where id=$id";
    $conn=openConn();
    $conn->query($sql);
    closeConn($conn);
}

function Delete_Patient($id)
{
    $sql="update `paciente set status=3, updated_at=CURRENT_TIMESTAMP(), deleted_at=CURRENT_TIMESTAMP() where id=$id";
    $conn=openConn();
    $conn->query($sql);
    closeConn($conn);
}


function getPatient($id){
    $sql="select id, nome , nif, morada,codigopostal,localidade,telemovel,email 
        from paciente
        where id=$id";
    $conn=openConn();
    $result=array();
     
    foreach ($conn->query($sql) as $row) {
        array_push($result,array("id"=>$row["id"],
            "name"=>$row["nome"],
            "nif"=>$row["nif"],
            "morada"=>$row["morada"],
            "codpostal"=>$row["codigopostal"],
            "email"=>$row["email"],
            "localidade"=>$row["localidade"],
            "tlm"=>$row["telemovel"],
            "email"=>$row["email"],
            "Clicnics"=>getClicnicsByPatient($id)
        ));
    }
    
    
    closeConn($conn);
    return json_encode($result);
}
function getClicnicsByPatient($id){
    $sql="select id,nome from clinica
		 where status=1 and
		deleted_at is null
		and id in (select id_clinica
					from paciente_clinica
					where status=1 and
					deleted_at is null
					and id_paciente=$id)";
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


?>