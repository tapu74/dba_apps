<?php 
include_once 'view.php';
include_once('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>DATABASE Checking ..</title>
	<link href="menu/table-style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ConfirmDelete(){
	var d = confirm('Do you really want to delete data?');
	if(d == false){
		return false;
	}
}
</script>
</head>
<body>
	<div class="wrapper">
		<div class="content" style="width: 900px;">
			<a href="update.php" class="link-btn" align="left">Add New Entry</a> 

			<br/><br/>
			
			<table class="pbtable">
				<thead>
					<tr>
						<th>
							Serial
						</th>
						<th>
							User Name
						</th>
						<th>
							Server IP
						</th>
						<th>
							DB Name
						</th>
						<th>
							Purpose
						</th>
						<th>
							Date engaged
						</th>
						<th>
							Status
						</th>
						
						<th>
							Apps URL
						</th>
						<th>
							Comments
						</th>
						 
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					foreach($data_list as $data) : ?>
						<tr>
							<td>
								<?php //echo $i; ?>
                                <span style="float:left;">
						<form method="post" action="view.php">
									<input type="hidden" name="ci" 
									value="<?php echo $data["id"]; ?>" />
									<input type="hidden" name="action" value="edit" />
<!--	<input type="submit" value="Edit" /> -->
<input type=image src=js/img/edit.png alt="Edit feedback" />
								</form> 
							</span>
							<span style="float:right;">
								<form method="POST" action="view.php" 
								onSubmit="return ConfirmDelete();">
									<input type="hidden" name="ci" 
									value="<?php echo $data["id"]; ?>" />
									<input type="hidden" name="action" value="delete" />
									<!--<input type="submit" value="Delete" />-->									<input type=image src=js/img/delete.png alt="Delete feedback" />
								</form>
								</span>
							</td>

							<td>
								<?php echo $data["user_name"]; ?>
							</td>
							<td>
								<?php echo $data["server_ip"]; ?>
							</td>
							<td>
								<?php echo $data["db_name"]; ?>
							</td>
							<td>
								<?php echo $data["purpose"]; ?>
							</td>
							<td>
								<?php echo $data["date_engaged"]; ?>
							</td>
							<td>
								<?php echo $data["status"]; ?>
							</td>
							
							<td>
								<?php echo $data["apps_url"]; ?>
								
							</td>
							<td>
								<?php echo $data["comments"]; ?>
							</td>
							
						<tr>
					<?php 
					$i++; 
					endforeach; ?>
				</tbody>
			</table>
			<?php

			echo pagination($statement,$per_page,$page);
			?>
		</div>
	</div>
</body>
</html>