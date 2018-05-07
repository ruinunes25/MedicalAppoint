<?php 

include("../../Controls/DB_Auxiliar.php");
session_start();
$Link ="http://".$_SERVER['HTTP_HOST']."/MedicalAppoint/Controls/";


$Clients=getPatients($_SESSION["UserDefaultClinic"]);
$json = json_decode($Clients);


$Clinicas=json_decode($_SESSION["user_clinicas"]); 
$clinicdropoptions="";
foreach($Clinicas->clinicas as $spec){
    $clinicdropoptions.="<option value='".$spec->id."'";
    if($spec->principal==1)
    {
        $clinicdropoptions.=" selected " ;
    }
    $clinicdropoptions.=">".$spec->name."</option>";
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
<title>Medical Appoint| Administração | Utentes</title>
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
<div id="heder" class="bgded overlay light" style="background-image:url('../images/demo/backgrounds/01.png');"> 
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
    <ul style="float:left;">
      <li><a href="../home.php">Home</a></li>
      <li><a href="#">Utentes</a></li>
      <!--<li><a href="#">Ipsum</a></li>
      <li><a href="#">Dolor</a></li>-->
    </ul>
    <!-- ################################################################################################ -->
    <div style="float:right;">
    	Clínica: <select id="Clinica_user" onchange="javascript:refreshGrid();">
    				<?php echo $clinicdropoptions;?>
    			</select>
    </div>
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div id="main" class="wrapper row3">
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
        <table id="tbl_Element"  class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Morada</th>  
              
              <th>Localidade</th>  
              <th>Código Postal</th> 
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
              <td><?php echo $special->morada;?></td> 
              <td><?php echo $special->localidade;?></td>
              <td><?php echo $special->codigopostal;?></td>
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


<div id="create" title="Novo Médico" style="display:none;">
  
  <form action="Form_Submit.php" method="post" accept-charset="UTF-8"> 
    <fieldset>
      <div style="margin-bottom:10px">
	  <label for="Name" class="lblmandatory">Nome</label>
      <input type="text" name="Name" id="Name" value="" class="mandatory" style="width:100%" class="text ui-widget-content ui-corner-all">
      <label for="NIF">NIF</label>
      <input type="text" name="NIF" id="NIF" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
       <label for="Morada" class="lblmandatory">Morada</label>
      <input type="text" name="Morada" id="Morada" value="" class="mandatory" style="width:100%" class="text ui-widget-content ui-corner-all">
      <label for="CodPostal">Codigo Postal</label>
      <input type="text" name="CodPostal" id="CodPostal" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
      <label for="localidade">Localidade</label>
      <input type="text" name="localidade" id="localidade" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
     
      <label for="tlm" class="lblmandatory">Tlm</label>
      <input type="text" name="tlm" id="tlm" value="" style="width:100%" class="mandatory" class="text ui-widget-content ui-corner-all">
       <label for="email">Email</label>
      <input type="text" name="email" id="email" value="" style="width:100%" class="text ui-widget-content ui-corner-all">
      
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
        		<table id="Patient_Clinics"  class="display" cellspacing="0" width="100%">
                  <thead>
                  	<th>ID</th>
                  	<th>Clinica</th>
                  </thead>
                </table>
            </div>
		</div>
		<div style="display:none;">
			<input type="text" name="idP" id="idP" value="">
		</div>
		<input type="hidden" name="op" id="DocOP" value="addPacient"/>
		<input type="hidden" name="Patient_ID" id="idPatient" value=""/> 
		<input type="hidden" name="Clinics" id="Doc_Clinic" value=""/>
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
       <input type="submit" id="add_final" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

<div class="hidden">
	<form action="Form_Submit.php" method="post">
	<input type="hidden" name="idPatient" id="idPatientInact" value=""/>
	<input type="hidden" name="op" value="InactivatePatient"/>
	<input type="hidden" name="status" id="statusid" value=""/>
	 <input type="submit" tabindex="-1" id="inact_final" style="position:absolute; top:-1000px">
	</form>
	
	<form action="Form_Submit.php" method="post">
	<input type="hidden" name="idPatient" id="idPatientDelete" value=""/>
	<input type="hidden" name="op" value="DeletePatient"/>
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
var table;	
var selectedLine; 
var selectedClinic; 
var PatientClinc=[]; 
var table_clinic;
$(document).ready(function() {
$("#main").height($(window).height()-$("#heder").height()-$("#copyright").height()-45);


table_clinic = $('#Patient_Clinics').DataTable();
table = $('#tbl_Element').DataTable();
ShowHideBtnsClinc();
startGrid();
    var dialog = $( "#create" ).dialog({
        autoOpen: false,
        height: 800,
        width: 550,
        modal: true,
        buttons: {
          "Aplicar": createPatient,
          Cancel: function() {
            dialog.dialog( "close" );
          }
        },
        close: function() { 
        	 dialog.dialog( "close" );
        }
      });
 
   $( "#add" ).button().on( "click", function() {
	   $("#DocOP").val("addPatient"); 
	   dialog.dialog("option","title","Novo paciente");
	   dialog.dialog( "open" );
	    }); 
   $( "#edit" ).button().on( "click", function() { 
	   $("#DocOP").val("editPatient");
  	   $("#idPatient").val(selectedLine); 
  	   cleanModal()
  	   $.ajax({
 		contentType: "application/json; charset=utf-8",
 		dataType: "json",
 		url: "../../Controls/Ajax.php", 
 		data:{op: "GetPatientInfo", idPatient:selectedLine},
 		success: function(result){ 
 			$.each(result, function(i,item){  
 				$("#Name").val(item.name);
 				$("#NIF").val(item.nif);
 				$("#Morada").val(item.morada);
 				$("#CodPostal").val(item.codpostal);
 				$("#localidade").val(item.localidade);
 				$("#tlm").val(item.tlm);
 				$("#email").val(item.email); 
 				$("#idP").val(item.id); 
 				$.each(item.Clicnics, function( i,spec ) 
				{
 					PatientClinc.push(spec.id);
					table_clinic.row.add([spec.id,spec.nome] ).draw( false );
				});
 			  dialog.dialog("option","title","Editar paciente");
 			  dialog.dialog( "open" );
 			}); 
 		}});  
  	   
	   
	    });
   
   $( "#inactivate" ).button().on( "click", function() {
	   $("#idPatientInact").val(selectedLine);
	   $("#inact_final").click();
	    });
   $( "#delete" ).button().on( "click", function() {
	   $("#idPatientDelete").val(selectedLine);
	   $("#dele_final").click();
	    });
 
   
 
	/* Area das clinicas*/
       $('#RemoveClinic').on('click', function () {
    	   PatientClinc.splice( $.inArray(selectedClinic, PatientClinc), 1 );
    	   table_clinic.row(selectedClinic)
    	    .remove()
    	    .draw();
       } );
       $('#RemoveAllClinic').on('click', function () {
    	   selectedClinic=null;
    	   ShowHideBtnsClinc();
    	   PatientClinc=[];
    	   table_clinic.clear()
    	    .draw();
      });

       $('#addClinic').on('click', function () { 
    	   var specid=$("#clinic").val(); alert($( "#clinic option:selected" ).text());
    	   if($.inArray(specid, PatientClinc )<0)
    	   {
    		   PatientClinc.push(specid);
    		   table_clinic.row.add([specid,$( "#clinic option:selected" ).text()] ).draw( false );
    	   }
    	   else{
    		alert('Este paciente já está associada a clinica seleccionada.');
    	   }
     
       });
       $('#Patient_Clinics tbody').on( 'click', 'tr', function () { 
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
    	    } )
   
} );

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

function cleanModal(){
	$("#Name").val('');
	$("#NIF").val('');
	$("#Morada").val('');
	$("#CodPostal").val('');
	$("#localidade").val('');
	$("#tlm").val('');
	$("#email").val(''); 
	 PatientClinc=[]; 
	$('#RemoveAllClinic').click();
}

function refreshGrid()
{
	table.clear().draw();
	table.destroy();
	var rows="";
	$.ajax({
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		url: "../../Controls/Ajax.php", 
		data:{op: "GetUtents", clinic:$("#Clinica_user").val()},
		success: function(result){ 
			$.each(result, function(i,item){  
				rows+='<tr id="'+item.id+'">'+
				  '<td>'+item.id+'</td>'+
	              '<td id="nome_'+item.id+'">'+item.nome+'</td>'+
	              '<td>'+item.morada+'</td>'+ 
	              '<td>'+item.localidade+'</td>'+
	              '<td>'+item.codigopostal+'</td>'+
	              '<td>'+item.estado+'</td>'+
	              '<td id="estado_'+item.id+'" class="hidden">'+item.nome+'status;?></td>'+  
	            '</tr>';
			});
			$('tbody', '#tbl_Element').html(rows);
			startGrid();
		}}); 
}

function startGrid(){
	  table = $('#tbl_Element').DataTable();
	    $('#tbl_Element tbody').on( 'click', 'tr', function () { 
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
	    });
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
function EditSpeciality(){
	$("#edit_final").click();
}
function createPatient(){
	var bErro=false;
	$(".mandatory").each(function( index ) {
		  if($.trim($(this).val())==''){
			  bErro=true;
			  return false;
		  }
	}); 
	if(!bErro)
	{
		//$("#idPatient").val(selectedLine); 
    	$("#Doc_Clinic").val(JSON.stringify(PatientClinc)); 
    	$("#add_final").click();
	}
	else
	{
		alert("Deve preencher os campos obrigatórios");
	}
	 
}
</script>
</body>
</html>