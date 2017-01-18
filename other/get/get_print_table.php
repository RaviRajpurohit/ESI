<?php
	$sql;
	include('../../connection/config.php');
	include('../../connection/session.php');
	$department = $_SESSION['department'];
	$name=null;
	$voucher=null;
	$batch=null;
	$table_voucher;
	$t_head;
	$table_ladger;
	$d_check=false;
	$n_check=false;
	$v_check=false;
	$b_check=false;
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$department=$_POST['department'];
		if($department=='All'){
			$department='[a-zA-Z]*';
			$d_check=false;
		}
		else{
			$d_check=true;
		}
		$ladger=$_POST['ladger'];
		$name=$_POST['name'];
		if($name!=null){
			$n_check=true;
		}
		$name='^'.$name.'[0-9a-zA-Z]*';
		$voucher=$_POST['voucher'];
		if($voucher!=null){
			$v_check=true;
		}
		$voucher='^'.$voucher.'[0-9a-zA-Z]*';
		$batch=$_POST['batch'];
		if($batch!=null){
			$b_check=true;
		}
		$batch = '^'.$batch.'[0-9a-zA-Z]*';
		$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];
		if($ladger=='Issued'){
			$table_name='issued_detail';
			$table_voucher='issue_voucher_no';
			$t_ladger='To Whom Issued';
			$table_ladger='toWhomIssued';
		}
		else{
			$table_name='recived_detail';
			$table_voucher='recived_voucher_no';
			$t_ladger='From Whom Recived';
			$table_ladger='fromWhomRecived';
		}
		$sql="SELECT * FROM `$table_name` WHERE (`department` REGEXP '$department') AND (`name` REGEXP '$name') AND (`batchNo` REGEXP '$batch') AND (`$table_voucher` REGEXP '$voucher') AND `date` BETWEEN '$from_date' AND '$to_date'";
	}
	?>
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
			$result = $db->query($sql) or die('Sql Error: '.$db->error);
			$i=1;
			while($row = mysqli_fetch_array($result)){
				echo '<tr><td>'.$i.'</td>
					<td class="t_department">'.$row['department'].'</td>
					<td class="t_name">'.$row['name'].'</td>
					<td>'.$row['date'].'</td>
					<td class="t_voucher">'.$row[$table_vaoucher].'</td>
					<td id="head_ladger">'.$row[$table_ladger].'</td>
					<td>'.$row['quantity'].'</td>
					<td class="t_batch">'.$row['batchNo'].'</td>
					<td>'.$row['mfgDate'].'</td>
					<td>'.$row['expDate'].'</td>
					<td>'.$row['rate'].'</td></tr>
				';
				$i++;
			}
		?>
	</tbody>
<script>
$(document).ready(function(){
	var r = '<?php echo $department."%".$name."%".$voucher."%".$batch;?>';
	console.log(r);

<?php 	if($d_check){echo "$('.t_department').hide();";}?>
<?php	if($n_check){echo "$('.t_name').hide();";}?>
<?php	if($v_check){echo "$('.t_voucher').hide();";}?>
<?php	if($b_check){echo "$('.t_batch').hide();";}
?>
});
</script>
