<?php
	include('../../connection/config.php');
	$department = $_GET['department'];
	
	function check_quantity($name, $whom_issued, $batch_no, $mfg, $exp, $db){
		$rcv_q = ("SELECT `quantity` FROM `product_details` WHERE `department`='$whom_issued' AND `name`='$name' AND `batchNo`='$batch_no' AND `mfgDate`='$mfg' AND `expDate`='$exp'");
		$result = $db->query($rcv_q) or die("Sql Error :".$db->error);
		$row = mysqli_fetch_array($result);
		if(isset($row['quantity'])){
			
			return $row['quantity'];
		}
		else{
			return 0-1;
		}
	}
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$result;
		$i=$_POST['upload_record'];
		while($i>0){
			$name=$_POST[$i.'_name'];
			$date=$_POST[$i.'_date'];
			$voucher=$_POST[$i.'_voucher_no'];
			$fromWhomRecived=$_POST[$i.'_whom_recived'];
			$batch=$_POST[$i.'_batchNo'];
			$mfg=$_POST[$i.'_mfg'];
			$exp=$_POST[$i.'_exp'];
			$rate=$_POST[$i.'_rate'];
			$quantity=$_POST[$i.'_recived_quantity'];	
			
			$recive_detail= ("INSERT INTO `recived_detail`(`department`, `name`, `date`, `recived_voucher_no`, `fromWhomRecived`, `quantity`, `batchNo`, `mfgDate`, `expDate`, `rate`) VALUES('$department', '$name', '$date', '$voucher', '$fromWhomRecived', '$quantity', '$batch', '$mfg', '$exp', '$rate')");
			$rs_recive_detail=$db->query($recive_detail) or die("Sql Error:".$db->error);
			
			$reciver_quantity = check_quantity($name, $department, $batch, $mfg, $exp, $db);
			if($reciver_quantity == 0-1){
				$update_reciver = ("INSERT INTO `product_details`(`department`, `name`, `quantity`, `rate`, `batchNo`, `mfgDate`, `expDate`) VALUES ('$department', '$name', '$quantity', '$rate', '$batch', '$mfg', '$exp')");
			}
			else{
				$reciver_quantity = $quantity + $reciver_quantity;
				$update_reciver = ("UPDATE `product_details` 
					SET `quantity` = '$reciver_quantity'
					WHERE `department`='$department' AND `name`='$name' AND `batchNo`='$batch' AND `mfgDate`='$mfg' AND `expDate`='$exp'");
			}
			$rs_update_reciver = $db->query($update_reciver) or die("Sql Error:".$db->error);
			
			$issuer_reciver = ("INSERT INTO `issuer_receiver` SELECT '$fromWhomRecived' FROM DUAL WHERE NOT EXISTS( SELECT * FROM `issuer_receiver` WHERE name = '$fromWhomRecived')");
			$rs_issue_recive = $db->query($issuer_reciver) or die("Sql Error:".$db->error);
			$result=$rs_issue_recive;
			$i--;
		}
		if($result){
			header('Location: ../home.php?reciver=true');
		}
	}
?>