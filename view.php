<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
session_start();

if( $_SESSION["username"] == "" ) 
{ 
?>
<script>
window.location="login.php";
</script>
<?php
}
 
require('connection.php');
require_once('functions.php');
$con = connect();

ob_start();
?>
 <body>
<div id="container">

<?php
require("menu.php"); 
?>

<?php
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$row_id = mysql_real_escape_string(strip_tags($_POST['id']),$con);
		echo "row ".$row_id;
		$server_ip = mysql_real_escape_string(strip_tags($_POST['server_ip']),$con);
		$db_name = mysql_real_escape_string(strip_tags($_POST['db_name']),$con);
		$purpose = mysql_real_escape_string(strip_tags($_POST['purpose']),$con);
		$date_engaged = mysql_real_escape_string(strip_tags($_POST['date_engaged']),$con);
		$status = mysql_real_escape_string(strip_tags($_POST['status']),$con);
		$comments = mysql_real_escape_string(strip_tags($_POST['comments']),$con);
		$apps_url = mysql_real_escape_string(strip_tags($_POST['apps_url']),$con);
		$user_name = mysql_real_escape_string(strip_tags($_SESSION['username']),$con);
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into checks set 
					user_name = '$user_name',
					server_ip = '$server_ip',
					db_name = '$db_name',
					purpose = '$purpose',
					date_engaged = '$date_engaged',
					status = '$status',
					comments = '$comments',
					apps_url = '$apps_url',
					created_date = now()";
		}else{
			$sql = "update checks set 
					user_name = '$user_name',
					server_ip = '$server_ip',
					db_name = '$db_name',
					purpose = '$purpose',
					date_engaged = '$date_engaged',
					status = '$status',
					comments = '$comments',
					apps_url = '$apps_url',
					created_date = now()
					where id = '$row_id'";
		}
		
		
		if (!mysql_query( $sql,$con))
		{
			echo 'Error Saving Data. ' . mysql_error($con);
			exit();	
		}
	}
	header('Location: viewdetails.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "select * from checks 
			where id = $id";

	$result = mysql_query( $sql,$con);

	if(!$result)
	{
		echo mysql_error($con);
		exit();
	}
	
	$gresult = mysql_fetch_array($result);
	
	include 'update.php';

	//header('Location: update.php');
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from checks 
			where id = $id";

	$result = mysql_query( $sql,$con);

	if(!$result)
	{
		echo mysql_error($con);
		exit();
	}
	
}
//End Delete Contact



$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
 
$per_page = 20; // Set how many records do you want to display per page.
 
$startpoint = ($page * $per_page) - $per_page;
 
$statement = "`checks` ORDER BY `date_engaged` DESC"; // Change table name according to your database table.
 
$result = mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}",$con);



//Read contact information from database

/*
$sql = "select id,branch_id, account_no,
		customer_id, group_id, 
		user_name, created_date from elite_customer";
$result = mysql_query($sql,$con);
*/



if(!$result)
{
	 echo "No records are found.";
	//echo mysql_error($con);
	exit();
}
//Loo through each row on array and store the data to $contact_list[]
while($rows = mysql_fetch_array($result))
{
	$data_list[] = array('id' => $rows['id'], 
							'user_name' => $rows['user_name'], 
							'server_ip' => $rows['server_ip'],
							'db_name' => $rows['db_name'],
							'purpose' => $rows['purpose'],
							'date_engaged' => $rows['date_engaged'],
							'status' => $rows['status'],
							'comments' => $rows['comments'],
							'apps_url' => $rows['apps_url']
							);
}
include 'viewdetails.php';
exit();


?>

</div>
</body>