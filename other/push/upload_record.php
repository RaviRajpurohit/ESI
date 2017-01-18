<?php
	include('../../connection/config.php');
	$department = $_GET['department'];
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$date = $_POST['date'];
		$name = $_POST['name'];
		$vouchar_no = $_POST['voucher_no'];
		$whom_issued = $_POST['whom_issued'];
		$batch_no = $_POST['batch_no'];
		$mfg = $_POST['mfg'];
		$exp = $_POST['exp'];
		$rate = $_POST['rate'];
		$quantity = $_POST['issue_quantity'];
		$present_quantity = $_POST['present_quantity'];
		
		
		function check_quantity($name, $whom_issued, $batch_no, $mfg, $exp, $db){
			$rcv_q = ("SELECT `quantity` FROM `product_details` WHERE `department`='$whom_issued'AND `name`='$name'AND `batchNo`='$batch_no'AND`mfgDate`='$mfg'AND`expDate`='$exp'");
			$result = $db->query($rcv_q) or die("Sql Error :".$db->error);
			$row = mysqli_fetch_array($result);
			if(isset($row['quantity'])){
				
				return $row['quantity'];
			}
			else{
				return 0-1;
			}
		}
		$issue_insert = ("INSERT INTO `issued_detail`(`department`, `name`, `date`, `issue_voucher_no`, `toWhomIssued`, `quantity`, `batchNo`, `mfgDate`, `expDate`, `rate`) VALUES ('$department', '$name', '$date', '$vouchar_no', '$whom_issued', '$quantity', '$batch_no', '$mfg', '$exp', '$rate')");
		
		
		$recive_insert = ("INSERT INTO `recived_detail`(`department`, `name`, `date`, `recived_voucher_no`, `fromWhomRecived`, `quantity`, `batchNo`, `mfgDate`, `expDate`, `rate`) VALUES ('$whom_issued', '$name', '$date', '$vouchar_no', '$department', '$quantity', '$batch_no', '$mfg', '$exp', '$rate')");
		
		
		$issuer_reciver = ("INSERT INTO `issuer_receiver` SELECT '$whom_issued' FROM DUAL WHERE NOT EXISTS( SELECT * FROM `issuer_receiver` WHERE name = '$whom_issued')");
		
		$available = ($present_quantity - $quantity);
		$update_issuer = ("UPDATE `product_details` SET `quantity`='$available' WHERE `department`='$department' AND `name`='$name' AND `batchNo`='$batch_no' AND `mfgDate`='$mfg' AND `expDate`='$exp'");
		
		
		$reciver_quantity = check_quantity($name, $whom_issued, $batch_no, $mfg, $exp, $db);
		if($reciver_quantity == 0-1){
			$update_reciver = ("INSERT INTO `product_details`(`department`, `name`, `quantity`, `rate`, `batchNo`, `mfgDate`, `expDate`) VALUES ('$whom_issued', '$name', '$quantity', '$rate', '$batch_no', '$mfg', '$exp')");
		}
		else{
			$reciver_quantity = $quantity + $reciver_quantity;
			$update_reciver = ("UPDATE `product_details` 
				SET `quantity` = '$reciver_quantity'
				WHERE `department`='$whom_issued'AND `name`='$name'AND `batchNo`='$batch_no'AND`mfgDate`='$mfg'AND`expDate`='$exp'");
		}
		
		
		$rs_issue = $db->query($issue_insert) or die("Sql Error :".$db->error);
		$rs_recive = $db->query($recive_insert) or die("Sql Error:".$db->error);
		$rs_issue_recive = $db->query($issuer_reciver) or die("Sql Error:".$db->error);
		$rs_update_issuer = $db->query($update_issuer) or die("Sql Error:".$db->error);
		$rs_update_reciver = $db->query($update_reciver) or die("Sql Error:".$db->error);
		
		
		if($rs_issue and $rs_recive and $rs_issue_recive and $rs_update_issuer and $rs_update_reciver)
		{
			echo '<br><br><div width=100% align="center" class="login"><h2 style="color:wheat">Submited Record</h2></div>
			<br><br><center><button id="button" onclick="window.location = \'../issued_page.php\'">Back</button></center>';
		}
		
		
		
	}
?>