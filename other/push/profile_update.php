<?php
	include('../../connection/config.php');
	$department = $_GET['department'];
if($_SERVER['REQUEST_METHOD']=='POST'){
	$check=false;
	$contactPerson = $_POST['contactPerson'];
	$mobile = $_POST['mobile'];
	$sql = ("UPDATE `users` SET `contactPerson`='$contactPerson',`mobileNo`='$mobile' WHERE `department`='$department'");
	if($_POST['check']==1){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);
		$check = true;
		if(($username!='')&&($_POST['password']!='')){
			$sql = ("UPDATE `users` SET `username`='$username',`password`='$password',`contactPerson`='$contactPerson',`mobileNo`='$mobile' WHERE `department`='$department'");
		}
		else if(($username!='')&&($_POST['password']=='')){
			$sql = ("UPDATE `users` SET `username`='$username', `contactPerson`='$contactPerson',`mobileNo`='$mobile' WHERE `department`='$department'");
		}
		else if(($username=='')&&($_POST['password']!='')){
			$sql = ("UPDATE `users` SET `password`='$password', `contactPerson`='$contactPerson',`mobileNo`='$mobile' WHERE `department`='$department'");
		}
	}
	$result = $db->query($sql) or die("Sql Error :" . $db->error);
	if($result&&!$check){
		header('Location: ../home.php?update=true&sql='.$sql);
    }
	else if($result&&$check){
		header('Location: ../../connection/logout.php?updated=updated');
    }
}
?>