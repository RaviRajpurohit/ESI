<?php
	include('../../connection/config.php');
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = mysqli_real_escape_string($db,$_POST['new_name']);

		$sql = "SELECT `department` FROM users WHERE username = '$username'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result);

		$count = mysqli_num_rows($result);
		
		echo $count;
	}
?>