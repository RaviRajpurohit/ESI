<?PHP
	include('../connection/config.php');
	include('../connection/session.php');
	$department = $_SESSION['department'];
	$today = date('20y-m-d');
	
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
	</head>
	<body style="margin-left:40px;">
		<br><br>
		<center><form action="push/recive_update.php?department=<?php echo $department;?>" method="POST" onkeypress="return event.keyCode != 13;">
			<table id="n">
			<thead>
			<tr>
				<th>#</th>
				<th>Date(mm/dd/yyyy)</th>
				<th>Name of Article</th>
				<th>Recived Voucher No</th>
				<th>From Whom Recived</th>
				<th>Batch no</th>
				<th>Mfg Date(mm/dd/yyyy)</th>
				<th>Exp Date(mm/dd/yyyy)</th>
				<th>Rate</th>
				<th>Quantity</th>
			</tr>
			</thead>
			<tbody>
			<tr id="1">
				<td>1</td>
				<td><input type="date" id="1_date" name="1_date" value="<?php echo $today?>"></td>
				<td><input type="text" id="1_name" name="1_name" list="name_list"></td>
				<td><input type="text" id="1_voucher_no" name="1_voucher_no"></td>
				<td><input type="text" id="1_whom_recived" name="1_whom_recived" list="from_whom_recived" ></td>
				<td><input type="text" id="1_batchNo" name="1_batchNo"></td>
				<td><input type="date" id="1_mfg" name="1_mfg"></td>
				<td><input type="date" id="1_exp" name="1_exp"></td>
				<td><input type="text" id="1_rate" name="1_rate"></td>
				<td><input type="number" id="1_recived_quantity" name="1_recived_quantity" ></td>
			</tr>
			</tbody>
			</table>
			<input type="hidden" id="upload_record" name="upload_record" value="1">
			<br><br><button id="button" type='submit' readonly>Upload Record</button>
		</form></center>
		<button id="add" type="submit">Add Row</button>  <button id="remove" type="submit">Remove Row</button>
		<datalist id="name_list">
			<select>
			<?php
				$sql =("SELECT `name` FROM `product_details` WHERE `department`='$department' AND `quantity`>'0' GROUP BY `name`");
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
		
	</body>
</html>
<script>
	$(document).ready(function()
	{	
		var count=1;
		$('#add').click(function(){
			
			var date = $('#'+count+'_date').val();
			var name = $('#'+count+'_name').val();
			var voucher_no = $('#'+count+'_voucher_no').val();
			var fromm_whom_recived = $('#'+count+'_from_whom_recived').val();
			var batch_no = $('#'+count+'_batchNo').val();
			count++;
			html = '<tr id="'+count+'"><td>'+count+'</td>'+
				'<td><input type="date" id="'+count+'_date" name="'+count+'_date" ></td>'+
				'<td><input type="text" id="'+count+'_name" name="'+count+'_name" list="name_list"></td>'+
				'<td><input type="text" id="'+count+'_voucher_no" name="'+count+'_voucher_no"></td>'+
				'<td><input type="text" id="'+count+'_whom_recived" name="'+count+'_whom_recived" list="from_whom_recived" ></td>'+
				'<td><input type="text" id="'+count+'_batchNo" name="'+count+'_batchNo"></td>'+
				'<td><input type="date" id="'+count+'_mfg" name="'+count+'_mfg"></td>'+
				'<td><input type="date" id="'+count+'_exp" name="'+count+'_exp"></td>'+
				'<td><input type="text" id="'+count+'_rate" name="'+count+'_rate"></td>'+
				'<td><input type="number" id="'+count+'_recived_quantity" name="'+count+'_recived_quantity" ></td>'+
			'</tr>';
			$('#n').append(html);
			$('#upload_record').val(count);
			$('#'+count+'_date').val(date);
			$('#'+count+'_name').val(name);
			$('#'+count+'_voucher_no').val(voucher_no);
			$('#'+count+'_from_whom_recived').val(from_whom_recived);
			$('#'+count+'_batchNo').val(batch_no);
		});
		$('#remove').click(function(){
			$('#'+count).remove();
			count--;
			$('#upload_record').val(count);
		});
		$("#cancel_btn").click(function(){
			window.location.href = '../index.php';
		});
	});
</script>