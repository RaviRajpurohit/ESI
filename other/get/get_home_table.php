<?php
	include('../../connection/config.php');
	if(isset($_POST['department'])&&isset($_POST['name'])&&!isset($_POST['batch'])){
		$department=$_POST['department'];
		$name=$_POST['name'];
		$name = '^'.$name.'[a-zA-Z0-9]*';
		$sql="SELECT * FROM `product_details` WHERE `department`='$department' AND `quantity`>0 AND (`name` REGEXP '$name') ORDER BY  `expDate` ASC";
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
	}
	else if(isset($_POST['department'])&&!isset($_POST['name'])&&isset($_POST['batch'])){
		$department=$_POST['department'];
		$batch=$_POST['batch'];
		$batch = '^'.$batch.'[a-zA-Z0-9]*';
		$sql = "SELECT * FROM `product_details` WHERE `department`='$department' AND `quantity`>0 AND (`batchNo` REGEXP '$batch') ORDER BY `expDate` ASC";
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
	}
	else if(isset($_POST['department'])&&isset($_POST['name'])&&isset($_POST['batch'])){
		$department=$_POST['department'];
		$name=$_POST['name'];
		$name = '^'.$name.'[a-zA-Z0-9]*';
		$batch=$_POST['batch'];
		$batch = '^'.$batch.'[a-zA-Z0-9]*';
		$sql = "SELECT * FROM `product_details` WHERE `department`='$department' AND `quantity`>0 AND (`name` REGEXP '$name') AND (`batchNo` REGEXP '$batch') ORDER BY `expDate` ASC";
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
	}
	else{
		$department=$_POST['department'];
		$sql = "SELECT * FROM `product_details` WHERE `department`='$department' AND `quantity`>0 ORDER BY `expDate` ASC";
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
	}
?>