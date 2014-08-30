<?php
session_start();

if( $_SESSION["username"] == "" ) 
{ 
?>
<script>
window.location="login.php";
</script>
<?php
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Info</title>
	<link href="menu/table-style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" media="all" href="js/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>

<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>



<script type="text/javascript">

function Validate(){
	var valid = true;
	var message = '';
	var server_ip = document.getElementById("server_ip");
	var db_name = document.getElementById("db_name");
	
	if(server_ip.value.trim() == ''){
		valid = false;
		message = message + '*Server IP is required' + '\n';
	}
	if(db_name.value.trim() == ''){
		valid = false;
		message = message + '*Database Name is required';
	}
	
	if (valid == false){
		alert(message);
		return false;
	}
}

function GotoHome(){
	window.location = 'view.php?';
}

</script>
</head>
<body>

<?php
if(!isset($gresult))
{
include("menu.php");
}

	?>

	<div class="wrapper">
		<div class="content" style="width: 500px !important;">
			
			<div>
			<form id="frmContact" method="POST" action="view.php" 		
					onSubmit="return Validate();">
				<input type="hidden" name="id" 
				value="<?php echo (isset($gresult) ? $gresult["id"] :  ''); ?>" />
				<table>
					<tr>
						<td>
							<label for="fname">Server IP: </label>
						</td>
						<td>
							<input type="text" name="server_ip" 
							value="<?php echo (isset($gresult) ? $gresult["server_ip"] :  ''); ?>" 
							id="server_ip" class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Database Name: </label>
						</td>
						<td>
							<input type="text" name="db_name" 
							value="<?php echo (isset($gresult) ? $gresult["db_name"] :  ''); ?>" 
							id="db_name" class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Purpose: </label>
						</td>
						<td>
							<input type="text" name="purpose" 
							value="<?php echo (isset($gresult) ? $gresult["purpose"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fname">Date Engaged: </label>
						</td>
						<!-- id="datepicker"  -->
						<td> 
							<input type="text" name="date_engaged" id="inputField"  
							value="<?php echo (isset($gresult) ? $gresult["date_engaged"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
						<tr>
						<td>
							<label for="fname">Status: </label>
						</td>
						<td>
							<input type="text" name="status" 
							value="<?php echo (isset($gresult) ? $gresult["status"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
						<tr>
						<td>
							<label for="fname">Comments: </label>
						</td>
						<td>
							<input type="text" name="comments" 
							value="<?php echo (isset($gresult) ? $gresult["comments"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
						<tr>
						<td>
							<label for="fname">Apps URL: </label>
						</td>
						<td>
							<input type="text" name="apps_url" 
							value="<?php echo (isset($gresult) ? $gresult["apps_url"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
					</tr>
				
				</table>
				<input type="hidden" name="action_type" value="<?php echo (isset($gresult) ? 'edit' :  'add');?>"/>
				<div style="text-align: center; padding-top: 30px;">
					<input class="btn" type="submit" name="save" id="save" value="Save" />
					<input class="btn" type="submit" name="save" id="cancel" value="Cancel" 
					onclick=" return GotoHome();"/>
				</div>
			</form>
			</div>
		</div>
	</div>
</body>
</html>