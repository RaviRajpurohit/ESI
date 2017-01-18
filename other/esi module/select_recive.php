<?PHP
	include('../connection/config.php');
	$department = $_GET['department'];
	if(isset($_GET['ans'])){
		$ans = $_GET['ans'];
	}
	echo $hello = 'helo bhai ji';
echo md5($hello);
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
	</head>
	<body >
		<center>
			<h1> Please write Reciving Product</h1><br><br>
			<?php echo'<form onchange="recive()" action="recived.php?department=\''.$department.'\' method="post">';?>
				<label><b>Reciving Product</b><br><br>
				Product Type: 
				<select>
					<option>--Select--</option>
					<!--?php 
						$sql =("SELECT `Type` FROM `product type`");
						$result = $db->query($sql) or die("Sql Error :".$db->error);
						while ($row = mysqli_fetch_array($result)) 
						{
							$Title=$row["Type"];
							echo "<option>$Title</option>";
						}
					?-->
				</select><br><br>
				Product Name: 
				<datalist id="r">
					<select>
						<!--?php 
							$sql =("SELECT `Name` FROM `product details`");
							$result = $db->query($sql) or die("Sql Error :".$db->error);
							while ($row = mysqli_fetch_array($result)) 
							{
								$Title=$row["Name"];
								echo "<option>$Title</option>";
							}
						?-->
					</select>
				</datalist>
				
				<input type="text" name="recived_product" placeholder="Reciving Product" list="r"></label><br><br><table>
	<tr>
		<th>Recived Vouchar No</th>
		<th>Date</th>
		<th>From Whom Recived</th>
		<th>Quantity</th>
		<th>Batch no</th>
		<th>Mfg Date</th>
		<th>Exp Date</th>
		<th>Rate Per Unit</th>
		<th>Total Rate</th>
	</tr>
	<!--?php
		$i=5;
		while($i>0){
			echo '<tr>
			<td><input class="table" type="text" id="'.$i.'" name="'.$i.'" value="'.$i.'"></td>
				<td><input class="table" type="date" id="'.$i.'" name="'.$i.'" value="'.$today.'"></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			</tr>';
			--$i;
		}
	?-->
	</table>
				<button type="submit">Record</button>
			</form><br><br><br>
			<!--?php 
				if(isset($ans)){
					echo "<h2 align='center' style='color:red;'>Please Enter one Product</h2>";
				}
			?-->
		</center>
	</body>
</html>

<?
echo $hello = 'helo bhai ji';
echo md5($hello);
?>