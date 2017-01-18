<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');  
//setting header to json
header('Content-Type: application/json');
include('../../connection/config.php');
if($_POST['department']&&$_POST['name'])
{
	$department = $_POST['department'];
	$name = $_POST['name'];
	$sql = ("SELECT  `batchNo` as `Batch` ,  `mfgDate` as `Mfg` ,  `expDate` as `Exp`, `quantity`, `rate`
			FROM  `product_details` 
			WHERE `department` = '$department' AND `name` = '$name' 
			ORDER BY  `expDate` ASC");
	$result = $db->query($sql) or die("Sql Error :".$db->error);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	print json_encode($data);
}
?>