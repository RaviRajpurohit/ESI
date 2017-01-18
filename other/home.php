<?php
	include('../connection/session.php');
	include('../connection/config.php');
	$department = $_SESSION['department'];
	if(isset($_GET['reciver'])){
		echo '<h2 align="center">Data Uploaded Successfully</h2>';
	}
	if(isset($_GET['update'])){
		echo '<h2 align="center">'.$_GET['sql'].'Your Profile Update Successfully</h2>';
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="../css/main.css">
		<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
		<style>
			body{
				padding:2%;
				margin:0px;
			}
		</style>
	</head>
	<body >
		<center>
			<h2>Your Stock</h2><br>
			<div>
				<b>Search Product<b><br>
				<label>By Name: <input type="text" id="name" list="name_list"></label><br><br>
				<datalist id="name_list">
					<select id="name_option">
					<?php
						$sql = "SELECT `name` FROM `product_details` WHERE `department`='$department' AND `quantity`>0 GROUP BY `name` ORDER BY `expDate` ASC";
						$result = $db->query($sql) or die('Sql Error: '.$db->error);
						$i=1;
						while($row = mysqli_fetch_array($result)){
							echo '<option>'.$row['name'].'</option>';
						}
					?>
					</select>
				</datalist>
				<label>By Batch No: <input type="text" id="batch" list="batch_list"></label><br><br>
				<datalist id="batch_list">
					<select id="batch_option">
					<?php
						$sql = "SELECT `batchNo` FROM `product_details` WHERE `department`='$department' AND `quantity`>0 GROUP BY `batchNo` ORDER BY `expDate` ASC";
						$result = $db->query($sql) or die('Sql Error: '.$db->error);
						$i=1;
						while($row = mysqli_fetch_array($result)){
							echo '<option>'.$row['batchNo'].'</option>';
						}
					?>
					</select>
				</datalist>
			</div>
			<div id="table">
				<table id="n">
					<thead>
					<tr>
						<th>Sr.No.</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Batch No</th>
						<th>Mfg Date</th>
						<th>Exp Date</th>
						<th>Rate</th>
					</tr>
					<thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM `product_details` WHERE `department`='$department' AND `quantity`>0 ORDER BY  `expDate` ASC";
						$result = $db->query($sql) or die('Sql Error: '.$db->error);
						$i=1;
						while($row = mysqli_fetch_array($result)){
							echo "<tr class='j'>
								<td>".$i."</th>
								<td>".$row['name']."</td>
								<td>".$row['quantity']."</td>
								<td>".$row['batchNo']."</td>
								<td>".$row['mfgDate']."</td>
								<td>".$row['expDate']."</td>
								<td>".$row['rate']."</td>
							</tr>";
							$i++;
						}
					?>
					</tbody>
				</table>
				<img align="center" src="../img/loading.gif" id="loading" height="90px">
			</div>
			<script type="text/javascript" src="../js/home.js"></script>
			<script>var department = "<?php echo $_SESSION['department'];?>";</script>
		</center>
	</body>
</html>
