<?php

include("../../Controls/DB_Auxiliar.php");
session_start();



$data=getUsers();
$json = json_decode($data);

$Clinicas=json_decode(getActiveClinics());
$clinicdropoptions="";
foreach($Clinicas as $spec){
    $clinicdropoptions.="<option value='".$spec->id."'>".$spec->nome."</option>";
}
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
<link rel="icon" type="image/png" href="../../Images/favicon.ico" />
<title>Medical Appoint| Administração | Médicos</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
        <h1><a href="../../index.php">Medical Appoint</a></h1>
      </div>
      <nav id="mainav" class="fl_right">
        <ul class="clear"> 
          <li><a class="drop" href="#">Ol&aacute; <?php echo $_SESSION["User_Name"];?></a>
          	<ul>
          		<li><a href="../../controls/logout.php">Log out</a></li>
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
      <li><a href="#"> Utilizadores </a></li>
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
        <table id="Userstbl"  class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Código</th>
              <th>User</th>
              <th>Nome</th>
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
               <td><?php echo $special->username;?></td>
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

<div id="create-Medico" title="Novo Médico" style="display:none;">
  
  <form action="Admin_form_submit.php" method="post" accept-charset="UTF-8"> 
    <fieldset>
      <div style="margin-bottom:10px">
	  <label for="firstname">Primeiro Nome</label>
      <input type="text" name="firstname" id="firstname" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
      <label for="lastname">Último Nome</label>
      <input type="text" name="lastname" id="lastname" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
       <label for="email">Email</label>
      <input type="text" name="email" id="email" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
     
      <label for="username">User</label>
      <input type="text" name="username" id="username" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
      
      </div>
      <div id="accordion" > 
            <h3>Clinicas</h3>
            <div> 
                <select id="clinic" style="float:left;">
    	    		<?php echo $clinicdropoptions;?> 
    	    	</select>
    	    	<input type="button" id="addClinic" class="Btn" value="Adicionar">
        	 
            	<input type="button" id="RemoveClinic" class="Btn hidden"  value="Remover">
            	<input type="button" id="RemoveAllClinic" class="Btn"  value="Limpar">
        		<table id="users_Clinics"  class="display" cellspacing="0" width="100%">
                  <thead>
                  	<th>ID</th>
                  	<th>Clinica</th>
                  </thead>
                </table>
            </div>
		</div>
		<input type="hidden" name="op" id="DocOP" value="addUser"/>
		<input type="hidden" name="iduser" id="iduser" value=""/> 
		<input type="hidden" name="Clinics" id="Doc_Clinic" value=""/>
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
       <input type="submit" id="add_final" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 
<div class="hidden">
	<form action="Admin_form_submit.php" method="post">
	<input type="hidden" name="iduser" id="iduser_in" value=""/>
	<input type="hidden" name="op" value="InactivateUser"/>
	<input type="hidden" name="status" id="statusid" value=""/>
	 <input type="submit" tabindex="-1" id="inact_final" style="position:absolute; top:-1000px">
	</form> 
	<form action="Admin_form_submit.php" method="post">
	<input type="hidden" name="iduser" id="iduser_del" value=""/>
	<input type="hidden" name="op" value="DeleteUser"/>
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
var selectedClinic; 
var arrClinc=[]; 
var table_clinic;

$(document).ready(function() {
	var table = $('#Userstbl').DataTable(); 
	table_clinic = $('#users_Clinics').DataTable();
    $( "#accordion" ).accordion({
        collapsible: true,
        heightStyle: "content"
      });
	
    $('#Userstbl tbody').on( 'click', 'tr', function () { 
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
    $('#users_Clinics tbody').on( 'click', 'tr', function () { 
 	    if ( $(this).hasClass('selected') ) {
 	            $(this).removeClass('selected');
 	            selectedClinic=null; 
 	        }
 	        else {
 	        	table_clinic.$('tr.selected').removeClass('selected');
 	            $(this).addClass('selected');
 	           selectedClinic=$(this); 
 	        }
 	         
 	        ShowHideBtnsClinc();
 	    } );

    var dialog = $( "#create-Medico" ).dialog({
        autoOpen: false,
        height: 700,
        width: 650,
        modal: true,
        buttons: {
          "Guardar": createUser,
          "Cancelar": function() {
            dialog.dialog( "close" );
          }
        },
        close: function() { 
        	 dialog.dialog( "close" );
        }
      });
  
   $( "#add" ).button().on( "click", function() {
	   cleanModal(); 
	   $("#DocOP").val("addUser"); 
	   dialog.dialog("option","title","Novo utilizador");
	   dialog.dialog( "open" );
   });
   $( "#edit" ).button().on( "click", function() {
	   var docID=selectedLine;
	   $("#iduser").val(docID);
	   cleanModal();
	   $("#DocOP").val("editUser"); 
	   var elems=<?php echo $data;?>; 
	   $.each(elems, function( i,doc ) 
	   {
			if(docID==doc.id){
				DrawDoctor(doc);
				return false; 
			}
	   });
 
	   dialog.dialog("option","title","Editar utilizador");
	      dialog.dialog( "open" );
	    });
   $( "#inactivate" ).button().on( "click", function() {
	   $("#iduser_in").val(selectedLine);
	   $("#inact_final").click();
	    });
   $( "#delete" ).button().on( "click", function() {
	   $("#iduser_del").val(selectedLine);
	   $("#dele_final").click();
	    });


   $('#addClinic').on('click', function () { 
	   var specid=$("#clinic").val();
	   if($.inArray(specid, arrClinc )<0)
	   {
		   arrClinc.push(specid);
		   table_clinic.row.add([specid,$( "#clinic option:selected" ).text()] ).draw( false );
	   }
	   else{
		alert('Este médico já está associada a clinica seleccionada.');
	   }
 
   }); 
   $('#RemoveClinic').on('click', function () {
	   arrClinc.splice( $.inArray(selectedClinic, arrClinc), 1 );
	   table_clinic.row(selectedClinic)
	    .remove()
	    .draw();
   } );
   $('#RemoveAllClinic').on('click', function () {
	   selectedClinic=null;
	   ShowHideBtnsClinc();
	   arrClinc=[];
	   table_clinic.clear()
	    .draw();
  } );

});
function cleanModal(){
	$("#firstname").val('');
	$("#lastname").val('');
	$("#username").val('');
	$("#email").val('');
	arrClinc=[];   
	$('#RemoveAllClinic').click();
}
function DrawDoctor(Doctor){
	//$("#name").val(Doctor.nome);
	$("#firstname").val(Doctor.firstname);
	$("#lastname").val(Doctor.lastname);
	$("#username").val(Doctor.username); 
	$("#email").val(Doctor.email);
	$.each(Doctor.Clicnics, function( i,spec ) 
	{
		arrClinc.push(spec.id);
		table_clinic.row.add([spec.id,spec.nome] ).draw( false );
	});
}
function createUser(){ 
	var bErro=false;
	$(".text").each(function( index ) {
		  if($.trim($(this).val())==''){
			  bErro=true;
			  return false;
		  }
	});
	if(!bErro)
	{
    	$("#Doc_Clinic").val(JSON.stringify(arrClinc)); 
    	$("#add_final").click();
	}
	else
	{
		alert("Deve preencher todos os campos");
	}
}
function ShowHideBtnsClinc()
{
	if(selectedClinic)
	{
		$("#RemoveClinic").removeClass("hidden");  
	}
	else
	{
		$("#RemoveClinic").addClass("hidden"); 	 	
	}
}
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
</script>



