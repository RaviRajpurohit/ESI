<?PHP
	$department = $_GET['department'];
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if($_POST['recived_product']!=Null){
			//header('Location: recived.php?department='.$department);
		}
		else{
			header('Location: select_recive.php?department='.$department.'&ans=false');
		}
	}
?>
<head>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
	</head>
	<body style="margin:40px;padding:10px;background-color: rgba(19, 46, 119, 0.85);">
	<form action="" method="post">
	<table>
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
	<?php
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
	?>
	</table><br><br>
	<button type="submit">Upload</button>
	</form>
</table>