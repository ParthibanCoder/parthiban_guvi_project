<?php 

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk = new MongoDB\Driver\BulkWrite;



$data = $_POST['data'];
$bulk->insert($data);
$result = $manager->executeBulkWrite('mydb.mycollection',$bulk);

echo json_encode(['success' => 'Profile data updated successfully']); exit;
