<?php
	include('connection/config.php');
	$error = null;
	if(isset($_GET['error'])){
		$error = "Your Username or Password is invalid";
	}
	if(isset($_GET['permission'])){
		echo '<br><br><center><h3 align="center" style="color:yellow">You have not permission</h3></center>"';
	}
	if(isset($_GET['add'])){
		echo '<br><br><center><h3 align="center" style="color:yellow">Given product added to your account successfully</h3></center>"';
	}
	if(isset($_GET['updated'])){
		echo '<h3 align="center" style="color:yellow;">Updated your profile</h3>';
	}
	session_start();
	if(isset($_SESSION['department'])){
		header('Location: welcome.php?session');
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']); 
		$password = md5($password);

		$sql = "SELECT `department` FROM users WHERE username = '$username' and password = '$password'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result);

		$count = mysqli_num_rows($result);

		if($count == 1) {
			$_SESSION['department']= $row['department'];
            header("Location: welcome.php");
		}
		else {
			header("Location: index.php?error=true");
		}
	}
?>
<html>
	<head>
		<title>LogIn Page</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<form action="" method="post">
		<center class="login">
			<h1>ESI Medicine Inventory</h1>
			<h3>Login</h3>
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
			<h3 id="error"><?php echo $error;?></h3> 
			<label>To opening balance <a href="opening.php">Click Here</a></label>
		</center>
		</form>
	</body>
</html>