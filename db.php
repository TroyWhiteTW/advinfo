<?php
// mysql connect error
//$conn = @mysqli_connect('localhost','foxking','b31209','bradchao') or die("Server Busy");
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'root';
$dbName = 'bradchao';

$conn = @mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName) or die("Server Busy");

// if (mysqli_connect_errno()){
// 	$return = array('result' => '-2' );
// 	echo "error";
// 	return;
// }
mysqli_set_charset($conn, "UTF8");

// 以下為連接範例
// $sql = "select * from proclass where parent = 0 order by no";
// $resultset = mysqli_query($conn, $sql);
// if (mysqli_num_rows($resultset) > 0){
// 	while ($row = mysqli_fetch_assoc($resultset)){
// 		$proclass[] = array(
// 				'no' => "{$row['no']}",
// 				'pcname' => "{$row['pcname']}"
// 		);
// 	}
// }else{
// 	// 錯誤 查詢結果
// 	return;
// }
?>