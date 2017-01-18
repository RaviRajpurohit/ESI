<?php
	include('connection/config.php');
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']); 
		$password = md5($password);

		$sql = "SELECT `department` FROM users WHERE username = '$username' and password = '$password'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result);

		$count = mysqli_num_rows($result);

		if($count == 1) {
            header("Location: other/open.php?department=".$row['department']);
		}
		else {
			header("Location: index.php?permission=true");
		}
	}
?>
<html>
	<head>
		<title>Opening Balance</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<form action="" method="post">
		<center class="login">
			<h1>ESI Medicine Inventory</h1>
			<h3>Login for opening balance</h3>
			<b>
			<div>
				<label>USERNAME: <input type="text" name="username" placeholder="USERNAME" required></label>
			</div><br>
			<div>
				<label>PASSWORD: <input type="password" name="password" placeholder="PASSWORD" required></label>
			</div><br><br>
			<div>
				<button type="submit" id="submit" value="">Let me in.</button>
			</div>
			</b>
		</center>
		</form>
	</body>
</html>