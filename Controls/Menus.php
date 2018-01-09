<?php
$Link ="http://".$_SERVER['HTTP_HOST']."/medicalappoint/Content/";
?>
<nav class="sdb_holder">
        <ul>
          <li><a href="<?php echo $Link;?>home.php">Home</a></li>
          <li><a href="#"><?php echo utf8_encode("Administração");?></a>
            <ul>            
              <li><a href="<?php echo $Link;?>Admin/Admin_Especialidade.php"><?php echo utf8_encode("Especialidades");?></a></li>
              <li><a href="<?php echo $Link;?>Admin/Admin_medicos.php"><?php echo utf8_encode("Médicos");?></a></li>
              		<li><a href="#"><?php echo utf8_encode("Utilizadores");?></a></li>
            </ul>
          </li>
          <li><a href="#">Navigation - Level 1</a>
            <ul>
              <li><a href="#">Navigation - Level 2</a></li>
              <li><a href="#">Navigation - Level 2</a>
                <ul>
                  <li><a href="#">Navigation - Level 3</a></li>
                  <li><a href="#">Navigation - Level 3</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Navigation - Level 1</a></li>
        </ul>
      </nav>