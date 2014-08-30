<?php 
error_reporting(E_ALL^E_NOTICE^E_WARNING);
session_start();


if( $_SESSION["username"] != "" ) 
{ 
?>
<script>
window.location="index.php";
</script>
<?php
}


 include("connection.php");

 //error_reporting(E_ALL);
 ?>
 <?
//------------------------------------------IP------------------------------------------------------------//
function get_client_ip() {
     $ipaddress = '';
     if ($_SERVER['HTTP_CLIENT_IP'])
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if($_SERVER['HTTP_X_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if($_SERVER['HTTP_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if($_SERVER['HTTP_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if($_SERVER['REMOTE_ADDR'])
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}

//------------------------------------------------END IP-----------------------------------------------------------//





//--------------------------------------------------MAC-----------------------------------------------------------//
 

//--------------------------------------------------END MAC-----------------------------------------------------------//


//--------------------------------------------------HOST NAME----------------------------------------------------------//
$host_name =  gethostbyaddr($_SERVER['REMOTE_ADDR']);

 

//-------------------------------------------------END HOST NAME-----------------------------------------------------//
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Database Apps@Premier Bank</title>
	<link rel="stylesheet" href="menu/main-style.css" type="text/css" charset="utf-8" />
	
</head>

<body>
  <div id="wrapper" style="left: 0px; top: 0px; ">
     <div id="header">
	   <div id="innerbox">
   </div>
   

   
   <table style="width: 100%">
	<tr height="50">
		<!-- <td style="width: 343px">&nbsp;</td>-->
		<td  ALIGN="center"><font size="3"><strong>Database Apps - The Premier Bank Ltd</strong></font></td>
		<!-- <td align="right"><a style="text-decoration:none; color:white;" href="http://www.premierbankltd.com"> Home</a>&nbsp;</td> -->
	</tr>
	</table>
   
   </div>
   <div id="innerbox1">
   <br />
   <?php
 
ob_start(); // Turn on output buffering
system('ipconfig /all'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

$findme = "Physical";
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$mac=substr($mycom,($pmac+36),17); // Get Physical Address
  
?>
<?

$local_ip = get_client_ip();

$con = connect();
 putenv("TZ=Asia/Dacca");
 //$date = date('Y/m/d H:i:s');
  $pc_date=date('Y-m-d'); 
 
  $pc_time=date('H:i:s a');
 
//$pc_time= add_time(date("H:i:s",time()),360);  
//$pc_date = date("Y-m-d",strtotime(add_time(date("H:i:s",time()),360)));

?>
<br />
</div>
<form id="login" method="post" action="login_auth.php">	


  <!-- <div id="wrapper" style="left: 0px; top: 0px; ">  -->
 
    

     <div id="innerbox1">
   <br>
    <table style="width: 100%" cellpadding="0">
	<tr><td>
	 <div>
                            	 
						<?php //class='".$msg["status"]."' 
						echo "<span style='background-color:red'>".$msg["msg"]."</span>";?>
                   
                            </div>
	</td></tr>
		<tr>
			<td style="width: 29px">&nbsp;</td>
			<td style="width: 95px">User Name:</td>
			<td style="width: 131px">
			<input type="text" name="username" style="height: 15px; width: 144px" class="field required" title="Please provide your username"></td>
			<td style="width: 474px">&nbsp; <br>
			</td>
			<td rowspan="3">&nbsp;			</td>
		</tr>
		<tr>
			<td style="width: 29px; height: 17px;"></td>
			<td style="width: 95px; height: 17px;">Password:</td>
			<td style="width: 131px; height: 17px;">
			<input type="password" name="password" style="height: 15px; width: 144px" class="field required" title="Password is required" ></td>
			<td style="width: 474px; height: 17px;">&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 29px">&nbsp;</td>
			<td style="width: 95px">&nbsp;</td>
			<td style="width: 131px">&nbsp;			</td>
			<td style="width: 474px">&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 29px">&nbsp;</td>
			<td style="width: 95px" align="right">&nbsp;</td>
			<td style="width: 131px">
			<input type="submit" value="Login" name="submit"></td>
			<td style="width: 474px">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
		
		</table>
   
    </div>

<div id="footer" style="height:100px">
  <hr>Copyright © 2014 The Premier Bank Limited, All Rights Reserved.<br>Powered by: Information Technology Division <hr></div>

  </div>
  </form>
</body>
</html>
