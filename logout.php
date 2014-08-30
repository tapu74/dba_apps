<?php
 session_start();
 include("connection.php");
$con = connect();
 $_SESSION["username"]	;
$insert_id=$_SESSION["insert_id"];
putenv("TZ=Asia/Dacca");
 $pc_date=date('Y-m-d'); 
 
 $pc_time=date('H:i:s');
  
  $sql=mysql_query("update login_history_db set logout_time='".$pc_time."',logout_date='".$pc_date."' ,login_status=0
  where id=".$insert_id."");
  disconnect($con);
  session_destroy();

  header('Location: login.php');
exit;
  
  
?>