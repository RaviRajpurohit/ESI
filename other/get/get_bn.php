<?php
	include('../../connection/config.php');
	if(isset($_POST['department'])&&isset($_POST['name'])&&!isset($_POST['batch'])){
		$department=$_POST['department'];
		$name=$_POST['name'];
		$name = '^'.$name.'[a-zA-Z0-9]*';
		$sql = "SELECT `batchNo` FROM `product_details` WHERE `department`='$department' AND (`name` REGEXP '$name') AND `quantity`>0 GROUP BY `batchNo` ORDER BY `expDate` ASC";
		$result = $db->query($sql) or die('Sql Error: '.$db->error);
		$i=1;
		while($row = mysqli_fetch_array($result)){
			echo '<option>'.$row['batchNo'].'</option>';
		}
	}
	else if(isset($_POST['department'])&&!isset($_POST['name'])&&isset($_POST['batch'])){
		$department=$_POST['department'];
		$batch=$_POST['batch'];
		$batch = '^'.$batch.'[a-zA-Z0-9]*';
		$sql = "SELECT `name` FROM `product_details` WHERE `department`='$department' AND `quantity`>0 AND (`batchNo` REGEXP '$batch') GROUP BY `name` ORDER BY `expDate` ASC";
		$result = $db->query($sql) or die('Sql Error: '.$db->error);
		$i=1;
		while($row = mysqli_fetch_array($result)){
			echo '<option>'.$row['name'].'</option>';
		}
	}
	else{}
?>