<?php

	function loginQuery($user,$pass){
		return "SELECT id,username, CONCAT(firstname, ' ', lastname) as name FROM `users` 
		WHERE username='$user' and password='".md5($pass)."' and status=1  ";
	}
	
	function getClinicasByUser($userid){
		return "SELECT a.principal,b.id,b.nome from user_clinica a, clinica b 
				where a.id_clinica=b.id and a.id_user=$userid and a.status=1 ";
	}
	
	function getSpecialities(){
		return "SELECT id, nome,status, case when status=1 then 'Activo' 
									  when status=2 then 'Inactivo' 
									  else 'N.A' end as estado 
									FROM `especialidade`
									where deleted_at is null";
	}
	function getActiveSpeciSQL(){
		return "SELECT id, nome 
									FROM `especialidade`
									where deleted_at is null
						and status=1";
	}
	function getDoctorsQuerys(){
		return "SELECT id, nome,status,nif, (case when status=1 then 'Activo' 
									  when status=2 then 'Inactivo' 
									  else 'N.A' end) as estado FROM `medicos`";
	}
	
	function addEspecialidadeSQL($name){
		return "insert into `especialidade` (nome) values('$name')";
	}
	function InactivateEspecialidadeSQL($id,$status){
		return "update `especialidade` set status=$status, updated_at=CURRENT_TIMESTAMP() where id=$id";
	}
	
	
	function EditEspecialidadeSQL($id,$name){
		return "update `especialidade` set nome='$name', updated_at=CURRENT_TIMESTAMP() where id=$id";
	}
	
	
	function DeleteEspecialidadeSQL($id){
		return "update `especialidade` set status=3, updated_at=CURRENT_TIMESTAMP(), deleted_at=CURRENT_TIMESTAMP() where id=$id";
	}
	
?>