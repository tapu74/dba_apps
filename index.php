<?php
session_start();
 require_once('connection.php');


if( $_SESSION["username"] == "" ) 
{ 
?>
<script>
window.location="login.php";
</script>
<?php
}
 
?>
 
 <body>
<div id="container">


<?php
include("menu.php"); 
/*
$deleterecords = "TRUNCATE TABLE merit_score"; //empty the table of its current records
mysql_query($deleterecords);
*/

?>

</div>
</div>
</body>