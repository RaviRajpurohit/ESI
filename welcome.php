<?php
	include('connection/config.php');
	include('connection/session.php');
	$department = $_SESSION['department'];
?>
<html>

	<head>
		<title>Welcome </title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
	</head>

	<body>
		<div id="top">
			<div id="top1" >
				<b>ESI Dispensary</b>
				<a href = "connection/logout.php">
					<img align="right" style=""id ="logout" alter="logout" src="img/logout.png">
				</a>
			</div>
			<div id="top2" >		
				<button type="submit" onclick="window.location = 'welcome.php'" class="left">HOME</button>|
				<button type="submit" onclick="return issued_page()" class="left">ISSUED DETAIL</button>|
				<?php
					if ($_SESSION['department'] == "Main Store")
					{
						echo "<button type=\"submit\" onclick=\"return recieved_page()\" class=\"left\">RECIVED DETAIL</button>|";
					}
				?>
				<button type="submit" onclick="return print_values()" class="left">PRINT</button>|
				<button type="submit" onclick="return update_profile()" class="left">UPDATE PROFILE</button>
			</div>
		</div>
        <div id="main">
            <iframe id="mainIframe" style="border:0px solid;" src="other/home.php" >Welcome</iframe>
        </div>
        <script type="text/javascript" src="js/function.js"></script>
	</body>
	<script>var department = "<?php echo $_SESSION['department'];?>";</script>
</html>
