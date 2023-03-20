<?php

if($_POST['mobile']) {
  $mob = intval($_POST['mobile']);
  if (strcmp($mob, $_POST['mobile']) !== 0) {
    echo json_encode(["error" => 'Invalid phone no']); exit;
   }
}

require_once('db.php');

$stmt = mysqli_prepare($conn, 'SELECT * FROM users WHERE mobile = ? AND password = ?');
mysqli_stmt_bind_param($stmt, 'ss', $_POST['mobile'], $_POST['password']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$res = ["error" => 'Invalid credencials'];
if (count($row) > 0) {
 // $redis = new Redis();
  //$redis->connect('localhost', 6379);
  $res = ["success" => $row['userid']];
  //$redis->set('user_session_'.$row['userid'], json_encode($row));
}
mysqli_stmt_close($stmt);
$conn->close();

echo json_encode($res); exit;