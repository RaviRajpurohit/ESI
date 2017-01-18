<?php
include('../../connection/config.php');
if($_POST['type']&&$_POST['department'])
{
	$type = $_POST['type'];
	$department = $_POST['department'];
	$sql = ("SELECT `Name` FROM `product details` WHERE `Type` = '$type' AND `Department` = '$department' GROUP BY Name");
	$result = $db->query($sql) or die("Sql Error :".$db->error);
	?><option selected="selected">Select:</option><?php
	while ($row = mysqli_fetch_array($result))
	{
		?>
        	<option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
        <?php
	}
}
?>