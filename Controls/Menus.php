<?php
 
$Link ="http://".$_SERVER['HTTP_HOST']."/MedicalAppoint/Content/";
?>
  <div class="sidebar  first" style="width:100%;float:left;"> 
      <!-- ################################################################################################ -->
      <h6>Menu</h6>
		<nav class="sdb_holder">
        <ul>
          <li><a href="<?php echo $Link;?>home.php">Home</a></li>
          <li><a href="#">Administração</a>
            <ul>            
              <li><a href="<?php echo $Link;?>Admin/Admin_Especialidade.php">Especialidades</a></li>
              <li><a href="<?php echo $Link;?>Admin/Admin_medicos.php">Médicos</a></li>
              		<li><a href="<?php echo $Link;?>Admin/Admin_users.php">Utilizadores</a></li>
            </ul>
          </li>
          <li><a href="<?php echo $Link;?>Paciente/list.php">Pacientes</a>
            <ul>
              <li><a href="<?php echo $Link;?>Paciente/list.php">Listagem</a></li> 
            </ul>
          </li>
           <li><a href="<?php echo $Link;?>Scheduling/Sched.php">Marcações</a></li>
        </ul>
      </nav>
      
      
      <!-- ################################################################################################ -->
    </div>