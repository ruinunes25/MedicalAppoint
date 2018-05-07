<?php

include("../../Controls/DB_Auxiliar.php");
session_start();

$logged=isset($_SESSION["userID"])?true:false;
if(!$logged){
    header('Location: '."../../Content/Login.php");
}

$Link ="http://".$_SERVER['HTTP_HOST']."/MedicalAppoint/Controls/";
 
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

$businessHours_Start=8;
$businessHours_End=21;
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
<title>Medical Appoint| Agendamento</title>
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
 
 
 <script src="../..//daypilot/scripts/daypilot-all.min.js" type="text/javascript"></script>
<!-- <script src="../../calendar/jquery.calendar.js"></script>
<link rel="stylesheet" href="../../calendar/jquery.calendar.css">
-->

<style>
#calendar {
    position: absolute;
    top: 190px;
    /*left: 26%;*/
    right: 10px;
    bottom: 80px;
    border: 1px solid #bbb;
}

.ui-cal-week .ui-cal-timeline, .ui-cal-week .ui-cal-wrapper{ top: 0; }
.ui-cal-week .ui-cal-dateline, .ui-cal-week .ui-cal-dateline-fill{ display: none; }
 

#date_head{
position: absolute;
right: 200px;
margin: auto;
text-align: center;
left: 200px;
}

#controls{
position: relative;
top: 0px;
height: 23px;
left: 0px;
right: 50px;
margin: 0;
padding: 0;
}

#controls ol{
list-style-type: none;
margin: 0;
padding: 0;
border: 1px solid #B3B3B3;
border-radius: 2px;
overflow: hidden;
-moz-background-clip: padding;     /* Firefox 3.6 */
-webkit-background-clip: padding;  /* Safari 4? Chrome 6? */
background-clip: padding-box;      /* Firefox 4, Safari 5, Opera 10, IE 9 */
height: 21px;
}

#controls ol li{
display: inline-block;
float: left;
height: 100%;
padding: 0;
margin: 0;
border: 0;
background: #CACACA url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAUCAYAAABMDlehAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlJREFUeNp0y6sNACAAxNALBs0ArM9QbMEnJKiD4jEvNZXtEiRVEBg2LJgwoEN7pbtlSBBBX44AAwARiCdWebcYiAAAAABJRU5ErkJggg==) repeat-x 0 0; /* Old browsers */
text-shadow: rgba(255, 255, 255, 0.5) 0px 1px 0px;
color: #333;
}

#controls ol li:hover{
background-color: #C0C0C0;
color: #000;
}

#controls ol li.on{
background: #C4C4C4;
color: #555;
}

#controls ol li button{
margin: 0;
background: transparent;
border: 0;
border-left: 1px solid #B3B3B3;
height: 100%;
padding: 0 10px;
color: inherit;
text-shadow: inherit;
cursor: pointer;
}

#controls ol li:first-child button{
border-left: 0;
}

#cals{
float: left;
}
</style>
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
      <?php include("../../Controls/Menus.php")?>
    </div> 
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="content three_quarter" style="float:left;">  
      <div class="scrollable">
      <!-- <div id="controls">
        	<ol id="cals">
        		<li class="on"><button name="day">Day</button></li>
        		<li><button name="week">Week</button></li>
        		<li><button name="month">Month</button></li>
        		<li><button name="year">Year</button></li>
        	</ol>
        	<h1 id="date_head"></h1>
        	<ol id="nav">
        		<li><button name="prev">Previous</button></li>
        		<li class="on"><button name="today">Today</button></li>
        		<li><button name="next">Next</button></li>
        	</ol>
        </div> -->
        <div style="float:left; top:20px; width: 160px;">
          <div id="nav"></div>
        </div>
       <div id="calendar">
       
      </div>
     </div>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
 
 
 <div id="dialog-form" title="Create new user" style="display:none;">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
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

$(document).ready(function() {
	var dialog, form,      name = $( "#name" ),
    email = $( "#email" ),
    password = $( "#password" ),
    allFields = $( [] ).add( name ).add( email ).add( password );
	var h =$(window).height()-$("#heder").height()-$("#copyright").height()-45;
	$("#main").height(h);
	 
	

	  
	 var dp = new DayPilot.Calendar("calendar");
	  dp.viewType = "Week";
	  dp.locale = "pt-pt";
	  //dp.cellDuration = 15;
	  dp.cellHeight = 20;
	   
	  dp.allDayEventHeight = 0;
	  dp.dayBeginsHour = 7;
	  dp.dayEndsHour = 22;
	  dp.businessBeginsHour=<?php  echo $businessHours_Start;?>;
	  dp.businessEndsHour=<?php  echo $businessHours_End;?>;
	  dp.init();


	 var nav = new DayPilot.Navigator("nav");
	  nav.showMonths = 3;
	  nav.skipMonths = 3;
	  nav.selectMode = "week";
	  nav.onTimeRangeSelected = function(args) {
	        dp.startDate = args.start;
	        dp.update();
	    };
	    
	  nav.init();
	   
		$('#calendar').width($(".content").width()-205);
		$('#calendar').css("left",$(".sidebar").width()+$("#nav").width()+175).css("position","absolute");

		dp.onTimeRangeSelected = function (args) {
			  var name = dialog.dialog( "open" );// prompt("New event name:", "Event");
			  dp.clearSelection();
			  //if (!name) return;
			  var e = new DayPilot.Event({
			      start: args.start,
			      end: args.end,
			      id: DayPilot.guid(),
			      resource: args.resource,
			      text: "www",
			      backColor: "#ddeedd",
			      toolTip: "my tooltip"
			  });
			  dp.events.add(e); 
		};
		dp.onEventClicked = function(args) {
			  alert("clicked: " + args.e.id());
			  var name = dialog.dialog( "open" );// prompt("New event name:", "Event");
			  dp.clearSelection();
			};

		dp.onEventDeleted= function (args) {
				    this.message("Event deleted.");
				  },
	
	    dialog = $( "#dialog-form" ).dialog({
	        autoOpen: false,
	        height: 400,
	        width: 350,
	        modal: true,
	        buttons: {
	          "Create an account": addUser,
	          Cancel: function() {
	            dialog.dialog( "close" );
	          }
	        },
	        close: function() {
	          form[ 0 ].reset();
	          allFields.removeClass( "ui-state-error" );
	        }
	      });
	   
	      form = dialog.find( "form" ).on( "submit", function( event ) {
	        event.preventDefault();
	        addUser();
	      });
});

function addUser(){

}
 
</script>
</body>
</html>