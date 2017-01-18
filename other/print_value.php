<?php	
	include('../connection/config.php');
	include('../connection/session.php');
	$department = $_SESSION['department'];
	$today = date('20y-m-d');
	$from_date=date('20y-m-01');
	$to_date=$today;
	$t_ladger='To Whom Issued';
?>
<html>
	<head>
		<link rel="stylesheet" href="../css/print_value.css">
		<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
		<script>var department ='<?=$department;?>'</script>
		<style>
			body{
				padding:2%;
				margin:0px;
			}
		</style>
	</head>
	<body>
		<div class="search" id="search_div">
			<h2 align="center"> Search you details with inquery</h2>
			<?php
				if($department=='Main Store'){
				?>
					<label class="search">Department: 
						<select class="search" id="department">
							<option value="All">All</option>';
							<option value="Main Store" selected>Main Store</option>
							<option value="Injection OPD">Injection OPD</option>
							<option value="Dispensary OPD">Dispensary OPD</option>
							<option value="Dressing OPD">Dressing OPD</option>
						</select>
					</label><?php			}
			?>
			<label class="search">Ladger Type: 
				<select class="search" id="ladger">
					<option >Issued</option>
					<option >Recived</option>
				</select>
			</label><br>
			<label class="search">Product Name: <input type="text" id="name" list="name_list"></label>	
			<label class="search">Voucher No.: <input type="text" id="voucher" list="voucher_list"></label>
			<label class="search">Batch No.: <input type="text" id="batch" list="batch_list"></label><br><br>
			<label class="search">Date Duration: 
				From: <input type="date" class="search" id="from"><input type="hidden" id="fromDate" value="<?=$from_date?>">
				To: <input type="date" class="search" id="to" value="<?php echo $today?>"><input type="hidden" id="toDate" value="<?=$today;?>">
			</label>
		</div><br>
		<button id="print_div">Print Ladger</button>
		<div id="report">
			<h2 align="center">Department: <label id="report_department"><?=$department;?></label></h2>
			<pre align="center" id="report_ladger">Ladger: Issued</pre>
			<pre><label id="report_name"></label>	<label id="report_voucher"></label>	<label id="report_batch"></label> </pre><br>
			<table id="report_table">
				<thead>
				<tr>
					<th>#</th>
					<th class="t_department">Department</th>
					<th class="t_name">Artical Name</th>
					<th>Date</th>
					<th class="t_voucher">Voucher No</th>
					<th id="head_ladger"><?php echo $t_ladger;?></th>
					<th>Quantity</td>
					<th class="t_batch">Batch No</th>
					<th>Mfg Date</th>
					<th>Exp Date</th>
					<th>Rate</th>
				</tr>
				</thead>
				<tbody>
					<?php
						$table_name='issued_detail';
						$table_voucher='issue_voucher_no';
						$table_ladger='toWhomIssued';
						$sql="SELECT * FROM `$table_name` WHERE (`department` REGEXP '$department') AND `date` BETWEEN '$from_date' AND '$to_date'";
						$result = $db->query($sql) or die('Sql Error: '.$db->error);
						$i=1;
						while($row = mysqli_fetch_array($result)){
							echo '<tr>
									<td>'.$i.'</td>
									<td class="t_department">'.$row['department'].'</td>
									<td class="t_name">'.$row['name'].'</td>
									<td>'.$row['date'].'</td>
									<td class="t_voucher">'.$row[$table_vaoucher].'</td>
									<td id="head_ladger">'.$row[$table_ladger].'</td>
									<td>'.$row['quantity'].'</td>
									<td class="t_batch">'.$row['batchNo'].'</td>
									<td>'.$row['mfgDate'].'</td>
									<td>'.$row['expDate'].'</td>
									<td>'.$row['rate'].'</td>
								</tr>
							';
							$i++;
						}
					?>
				</tbody>
			</table>
		<div>
		<img align="center" src="../img/loading.gif" id="loading" height="90px">
		<script type="text/javascript" src="../js/print_value.js"></script>
	</body>
</html>

<datalist id="name_list">
<select>
<?php
	$sql =("SELECT `name` FROM `recived_detail` GROUP BY `name`");
	$result = $db->query($sql) or die("Sql Error :".$db->error);
	while ($row = mysqli_fetch_array($result)) 
	{
		$Title=$row["name"];
		echo "<option>$Title</option>";
	}
?>
</select>
</datalist>
<datalist id="from_whom_recived">
	<select>
	<?php
	{
		$sql = ("SELECT `name` FROM `issuer_receiver`");
		$result = $db->query($sql) or die("Sql Error :" . $db->error);
		while ($row = mysqli_fetch_array($result)) 
		{
			$Title=$row["name"];
			echo "<option>$Title</option>";
		}
	}
	?>
	</select>
</datalist>
<datalist id="voucher_list">
	<select>
	<?php
	{
		$sql = ("SELECT `recived_voucher_no` FROM `recived_detail` GROUP BY `recived_voucher_no`");
		$result = $db->query($sql) or die("Sql Error :" . $db->error);
		while ($row = mysqli_fetch_array($result)) 
		{
			$Title=$row["recived_voucher_no"];
			echo "<option>$Title</option>";
		}
	}
	?>
	</select>
</datalist>
<datalist id="batch_list">
	<select>
	<?php
	{
		$sql = ("SELECT `batchNo` FROM `recived_detail` GROUP BY `batchNo`");
		$result = $db->query($sql) or die("Sql Error :" . $db->error);
		while ($row = mysqli_fetch_array($result)) 
		{
			$Title=$row["batchNo"];
			echo "<option>$Title</option>";
		}
	}
	?>
	</select>
</datalist>