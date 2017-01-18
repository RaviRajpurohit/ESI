<?PHP
	include('../connection/config.php');
	$department = $_GET['department'];
	$today = date('20y-m-d');
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
	</head>
	<body style="margin-left:40px;">
		<br><br>
		<form action="issued.php?department=<?php echo $department;?>" method="post">
			<label>Date(mm/dd/yyyy): </label>
			<input type="date" name="date" value="<?php echo $today?>"><br><br>
			<label>Name of Article: </label>
			<select id="name" name="name">
				<option>--select--</option>
			<?php
				$sql =("SELECT `Name` FROM `product details` WHERE `Department` = '$department' AND `Quantity`>'0' GROUP BY `Name`");
				$result = $db->query($sql) or die("Sql Error :".$db->error);
				while ($row = mysqli_fetch_array($result)) 
				{
					$Title=$row["Name"];
					echo "<option>$Title</option>";
				}
			?>
			</select><br><br>
			<label>Issue Voucher No: </label>
			<input type="text" id="voucher_no" name="voucher_no"><br><br>
			<label>To Whom Issued: </label>
			<datalist id="to_whom_issued">
				<select>
				<?php
				{
					$sql = ("SELECT `Name` FROM `issuer_receiver`");
					$result = $db->query($sql) or die("Sql Error :" . $db->error);
					while ($row = mysqli_fetch_array($result)) 
					{
						$Title=$row["Name"];
						echo "<option>$Title</option>";
					}
				}
				?>
				</select>
			</datalist>
			<input type="text" id="whom_issued" name="whom_issued" list="to_whom_issued" ><br><br>
			<label>Batch no: </label>
			<select id="batch_no" name="batch_no">
				<option>--select--</option>
			</select><br><br>
			<label>Mfg Date(mm/dd/yyyy): </label>
			<input type="date" id="mfg" name="mfg" readonly><br><br>
			<label>Exp Date(mm/dd/yyyy): </label>
			<input type="date" id="exp" name="exp" readonly><br><br>
			<input type="hidden" id="present_quantity" name="present_quantity">
			<label>Rate: </label>
			<input type="text" id="rate" name="rate" readonly><br><br>
			<label>Quantity: </label>
			<input type="number" id="issue_quantity" name="issue_quantity" >
			<div id="insufficient"><h3 style="color:red;">You have insufficient Quantity</h3></div>
			<br><br><button id="button" type='submit' readonly>Upload Record</button>
		</form>
	</body>
</html>
<script>
	$(document).ready(function()
	{
		var arr=[];
		var i;
		$('#insufficient').hide();
		$("#name").change(function()
		{
			var name = $(this).val();console.log(name);
			$('#batch_no').find('option').remove();
			var dataString = 'department=<?php echo $department;?>&name='+name;
			$.ajax
			({
				type: "POST",
				url: "get_batch_mfg_exp.php",
				data: dataString,
				cache: false,
				success: function(data)
				{	
					for(i in data){
						arr[i]=[];
						arr[i][0] = data[i].Batch;
						arr[i][1] = data[i].Mfg;
						arr[i][2] = data[i].Exp;
						arr[i][3] = data[i].Quantity;
						arr[i][4] = data[i].Rate;
					}
					var j=0;
					$('#batch_no').append('<option>Select: </option>');
					while(j<=i){
						html = '<option>'+arr[j][0]+'</option>';
						$('#batch_no').append(html);
						j++;
					}					
				}
			});
		});
		$('#batch_no').change(function()
		{
			var j=0;
			for(j=0; j<=i; j++){
				if(arr[j][0]==$(this).val()){
					break
				}
			}
			$('#mfg').val(arr[j][1]);
			$('#exp').val(arr[j][2]);
			$('#present_quantity').val(arr[j][3]);
			$('#rate').val(arr[j][4]);
		});
		$('#issue_quantity').change(function()
		{
			if((+$(this).val())>(+$('#present_quantity').val())){
				$('#insufficient').show();
				$('#button').hide();
			}
			else{
				$('#insufficient').hide();
				$('#button').show();
			}
		});
	});
</script>
