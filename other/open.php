<?php
	include('../connection/config.php');
	$department=$_GET['department'];
	$result;
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$i = $_POST['upload_record'];
		while($i>0){
			$name=$_POST[$i.'_name'];
			$quantity=$_POST[$i.'_quantity'];
			$batchNo=$_POST[$i.'_batchNo'];
			$mfg=$_POST[$i.'_mfgDate'];
			$exp=$_POST[$i.'_expDate'];
			$rate=$_POST[$i.'_rate'];
			echo $sql="INSERT INTO `product_details`(`department`, `name`, `quantity`, `batchNo`, `mfgDate`, `expDate`, `rate`) VALUES('$department', '$name', '$quantity', '$batchNo', '$mfg', '$exp', '$rate')";
			$result = mysqli_query($db,$sql);
			$i--;
		}
		if($result){
			header('Location: ../index.php?add=true');
		}
	}
?>
<html>
	<head>
		<title>Opening Balance</title>
		<link rel="shortcut icon" href="../img/favicon.ico" />
		<link rel="stylesheet" href="../css/main.css">
		<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
		<style>
			body{
				padding:2%;
				margin:0px;
			}
		</style>
	</head>
	<body>
		<center>
		<h2>Write information to open your balance</h2><br><Br>
		<form action="" method="POST" onkeypress="return event.keyCode != 13;">
		<table id="n">
			<thead>
			<tr>
				<th>Name</th>
				<th>Quantity</th>
				<th>Batch No</th>
				<th>Mfg Date</th>
				<th>Exp Date</th>
				<th>Rate</th>
			</tr>
			<thead>
			<tbody>
			<tr class='j'>
				<td><input type="text" name="1_name" required></td>
				<td><input type="number" name="1_quantity" required></td>
				<td><input type="text" name="1_batchNo" required></td>
				<td><input type="date" name="1_mfgDate" required></td>
				<td><input type="date" name="1_expDate" required></td>
				<td><input type="text" name="1_rate" required></td>
			</tr>
			</tbody>
		</table><br><br>
		<input type="hidden" id="upload_record" name="upload_record" value="1">
		<button id="upload" type="submit">open balance</button>
		</form>
		</center>
		<button id="add" type="submit">Add Row</button>   
		<button id="cancel_btn" type="submit">Cancel</button>
	</body>
</html>
<script>
var count=1;
		$('#add').click(function(){
		
			count++;
			html = '<tr class="js"><td><input type="text" name="'+count+'_name"></td>'+
				'<td><input type="number" name="'+count+'_quantity"></td>'+
				'<td><input type="text" name="'+count+'_batchNo"></td>'+
				'<td><input type="date" name="'+count+'_mfgDate"></td>'+
				'<td><input type="date" name="'+count+'_expDate"></td>'+
				'<td><input type="text" name="'+count+'_rate"></td></tr>';
			$('#n').append(html);
			$('#loading').hide();
			$('#upload_record').val(count);
		});
		$("#cancel_btn").click(function(){
			window.location.href = '../index.php';
		});
</script>