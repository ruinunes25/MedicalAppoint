<?php

include("../../Controls/DB_Auxiliar.php");
session_start();


$Especialidades=getSpeci();
$json = json_decode($Especialidades);
?>

<!DOCTYPE html>
<!--
Template Name: Skaxis
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<title>Medical Appoint| Administração | Especialidades</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../../JavaScript/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all">


<link href="../../CSS/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="../../CSS/style.css" rel="stylesheet" type="text/css" media="all">

<!-- JAVASCRIPTS -->
<script src="../../JavaScript/jquery.min.js"></script>
<script src="../../JavaScript/jquery.backtotop.js"></script>
<script src="../../JavaScript/jquery.mobilemenu.js"></script>
<script src="../../JavaScript/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../DataTables/datatables.min.css"/> 
<script type="text/javascript" src="../../DataTables/datatables.min.js"></script>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay light" style="background-image:url('../images/demo/backgrounds/01.png');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="index.php">Medical Appoint</a></h1>
      </div>
      <nav id="mainav" class="fl_right">
        <ul class="clear"> 
          <li><a class="drop" href="#">Ol&aacute; <?php echo $_SESSION["User_Name"];?></a>
          	<ul>
          		<li><a href="../../Controls/logout.php">Log out</a></li>
          	</ul>
          </li> 
        </ul> 
      </nav>
      <!-- ################################################################################################ -->
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="breadcrumb" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul>
      <li><a href="../home.php">Home</a></li>
      <li><a href="#">Especialidades</a></li>
      <!--<li><a href="#">Ipsum</a></li>
      <li><a href="#">Dolor</a></li>-->
    </ul>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
   <div class="sidebar one_quarter first"> 
      <!-- ################################################################################################ -->
      <h6>Menu</h6>
      <?php include("../../Controls/Menus.php")?>
     
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="content three_quarter">  
      <div class="scrollable">
       <div id="buttons">
      	<input type="button" value="Adicionar" id="add" class="Btn"> 
      	<input type="button" value="Editar" id="edit" class="Btn hidden">
      	<input type="button" value="Inactivar" id="inactivate" class="Btn hidden">
      	<input type="button" value="Eliminar" id="delete" class="Btn hidden">
      </div>
        <table id="Specialities"  class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Código</th>
              <th>Especialidade></th>
              <th>Estado</th>  
              <th class="hidden"></th>
            </tr>
          </thead>
          <tbody>
          <?php 
          foreach ($json as $special)
          	{
          ?>
            <tr id="<?php echo $special->id;?>"> 
              <td><?php echo $special->id;?></td>
              <td id="nome_<?php echo $special->id;?>"><?php echo $special->nome;?></td>
              <td><?php echo $special->estado;?></td>
              <td id="estado_<?php echo $special->id;?>" class="hidden"><?php echo $special->status;?></td>  
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<div id="create" title="Nova Especialidade"> 
  <form action="Admin_form_submit.php" method="post">
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">
     
     <input type="hidden" name="op" value="addEspecialidade"/>
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" id="add_final" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
<div id="Edit_elm" title="Editar Especialidade"> 
  <form action="Admin_form_submit.php" method="post">
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name_edit" value="" class="text ui-widget-content ui-corner-all">
     
	 <input type="hidden" name="idEspecialidade" id="idEspecialidade_edit" value=""/>
     <input type="hidden" name="op" value="editEspecialidade"/>
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" id="edit_final" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

<div class="hidden">
	<form action="Admin_form_submit.php" method="post">
	<input type="hidden" name="idEspecialidade" id="idEspecialidade_in" value=""/>
	<input type="hidden" name="op" value="InactivateEspecialidade"/>
	<input type="hidden" name="status" id="statusid" value=""/>
	 <input type="submit" tabindex="-1" id="inact_final" style="position:absolute; top:-1000px">
	</form>
	
	<form action="Admin_form_submit.php" method="post">
	<input type="hidden" name="idEspecialidade" id="idEspecialidade_del" value=""/>
	<input type="hidden" name="op" value="DeleteEspecialidade"/>
	 <input type="submit" tabindex="-1" id="dele_final" style="position:absolute; top:-1000px">
	</form>
</div>


<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php 
include ('../../Controls/footer.php');
?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<script type="text/javascript">
var selectedLine;
$(document).ready(function() {
	var table = $('#Specialities').DataTable();
    $('#Specialities tbody').on( 'click', 'tr', function () { 
    if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
        selectedLine=null;
    }
    else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        selectedLine=$(this).attr('id'); 
    }
    ShowHideBtns();
    } );
    var dialog = $( "#create" ).dialog({
        autoOpen: false,
        height: 200,
        width: 350,
        modal: true,
        buttons: {
          "Criar": createSpeciality,
          Cancel: function() {
            dialog.dialog( "close" );
          }
        },
        close: function() { 
        	 dialog.dialog( "close" );
        }
      });

    var dialogEdit = $( "#Edit_elm" ).dialog({
        autoOpen: false,
        height: 200,
        width: 350,
        modal: true,
        buttons: {
          "Ok": EditSpeciality,
          Cancel: function() {
        	  dialogEdit.dialog( "close" );
          }
        },
        close: function() { 
        	dialogEdit.dialog( "close" );
        }
      });

   $( "#add" ).button().on( "click", function() {
	      dialog.dialog( "open" );
	    }); 
   $( "#edit" ).button().on( "click", function() { 
  	   $("#idEspecialidade_edit").val(selectedLine);
	   $("#name_edit").val($("#nome_"+selectedLine).html());
	   dialogEdit.dialog( "open" );
	    });
   $( "#inactivate" ).button().on( "click", function() {
	   $("#idEspecialidade_in").val(selectedLine);
	   $("#inact_final").click();
	    });
   $( "#delete" ).button().on( "click", function() {
	   $("#idEspecialidade_del").val(selectedLine);
	   $("#dele_final").click();
	    });
} );

function ShowHideBtns(){ 
	if(selectedLine)
	{
		$("#inactivate").val("Inativar");
		$("#statusid").val('2');
		if($("#estado_"+selectedLine).html()=="2"){
			$("#inactivate").val("Ativar");
			$("#statusid").val('1');
		}
		$("#inactivate").removeClass("hidden");
		$("#edit").removeClass("hidden");
		$("#delete").removeClass("hidden");
	}
	else
	{
		$("#inactivate").addClass("hidden");
		$("#edit").addClass("hidden");
		$("#delete").addClass("hidden");		
	}
}
function EditSpeciality(){
	$("#edit_final").click();
}
function createSpeciality(){
	$("#add_final").click();
}
</script>
</body>
</html>