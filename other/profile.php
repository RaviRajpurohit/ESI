<?php
	include('../connection/session.php');
	include('../connection/config.php');
	$department = $_SESSION['department'];
	$sql = "SELECT * FROM users WHERE `department`='$department'";
	$result = $db->query($sql) or die('Sql Error: '.$db->error);
	$row = mysqli_fetch_array($result);
?>
<html>
	<head>
		<title>LogIn Page</title>
		<link rel="stylesheet" href="../css/index.css">
		<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
		<style>
			.login1{
				background-color: #c1c0bb;
				padding: 20px;
				border: 10px ridge #585454;
				border-radius: 10px;
			}
			#notice{
				color:#35351d;
				font-family:arial b;
				font-size:largeer;
			}
		</style>
	</head>
	<body>
		<form action="push/profile_update.php?department=<?php echo $department;?>" method="post" onkeypress="return event.keyCode != 13;">
		<center class="login1">
			<h1>Department <?php echo $department;?></h1>
			<b>
			<div>
				<label>Officer:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="contactPerson" value="<?php echo $row['contactPerson'];?>"></label>
			</div><br>
			<div>
				<label>Mobile No:&nbsp; <input type="number" name="mobile" value="<?php echo $row['mobileNo'];?>"></label>
			</div><br>
			<div>
				<label>Username:&nbsp; <input type="text" id="username" name="username" placeholder="USERNAME" ></label>
				<h4 id="error">Enter Other USERNAME</h4>
			</div><br>
			<div>
				<label>Password:&nbsp; <input type="password" name="password" placeholder="PASSWORD" ></label>
			</div><br><br>
			<div>
				<button type="submit" id="submit" value="">UPDATE</button>
				<input type="hidden" id="check" name="check" value="0">
			</div>
			</b> 
			<div><pre title="notice" id="notice"><b>Notice:</b> When you update your USERNAME or PASSWORD account will be logout automatically</pre></div>
		</center>
		</form>
	</body>
</html>
<script>
	$(document).ready(function(){
		$('#error').hide();
		$('#username').bind('change keyup', function(){
			$('#submit').hide();
			
			var username = $(this).val();
			var dataString = 'new_name='+username;
			$.ajax
			({
				type: "POST",
				url: "get/check_username.php",
				data: dataString,
				cache: false,
				success: function(data)
				{	
					$('#error').show();
					if(data!=1){
						$('#error').hide();
						$('#submit').show();
					}
				}
			});	
		});
		$('#submit').click(function(){
			if(($('#check').val()!=$('#username').val())||($('#password').val()!='')){
				$('#check').val(1);
			}
		});
	});
</script>