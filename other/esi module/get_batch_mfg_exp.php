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
	$sql = ("SELECT  `Batch No` as `Batch` ,  `Mfg Date` as `Mfg` ,  `Exp Date` as `Exp`, `Quantity`, `Rate`
			FROM  `product details` 
			WHERE `Department` = '$department' AND `Name` = '$name' 
			ORDER BY  `Exp Date` ASC");
	$result = $db->query($sql) or die("Sql Error :".$db->error);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	print json_encode($data);
}
?>