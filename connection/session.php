<?php
	include('config.php');
	session_start();
	$department = $_SESSION['department'];
	$result = mysqli_query($db,"SELECT `department` FROM `USERS` WHERE `department`='$department'");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$login_session = $row['department'];
	if(!isset($_SESSION['department'])){
		header("location:index.php?session");
	}
?>