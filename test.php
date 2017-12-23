<?php
include 'db.php';
//session_start();

$Directory = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
$rs = mysqli_query($conn, "SELECT * FROM members WHERE myreferral='' or myreferral IS NULL");
while($rst = mysqli_fetch_assoc($rs)){
	$MyReferral = "";
	for($i=1;$i<=8;$i++){
		$MyReferral .= substr($Directory, rand(0,strlen($Directory)), 1);
	}
	mysqli_query($conn, "UPDATE members SET myreferral='".$MyReferral."' WHERE id='".$rst["id"]."'");
}
exit();

function f1($ks)
{
    $str = "(";
    foreach ($ks as $v) {
        $str .= $v . ",";
    }
    return substr($str, 0, -1) . ")";
}

function f2($ks, $vs)
{
    $str = "(";
    foreach ($ks as $v) {
        $str .= $vs[$v] . ",";
    }
    return substr($str, 0, -1) . ")";
}

function findReferral($memid, $referral, $level){
	global $conn;
	
	$sql = "SELECT * FROM members WHERE myreferral='" . $referral . "'";
	$rs = mysqli_query($conn, $sql);
	while($rst = mysqli_fetch_assoc($rs)){
		if($rst["referral"] != "" && $level<13){
			$referral_sql = findReferral($memid, $rst["referral"], $level+1);
		}
	}
	
	return $referral_sql .
						"INSERT INTO recommendmap(memid, referral, leveldiff, addtime, updatetime) 
						 VALUES('".$memid."','".$referral."','".($level)."',NOW(),NOW());";
}

for($i=1;$i<=13;$i++){
	$id = "test" . $i;
	$myreferral = $id;
	
	if($i>1){
		$referral = "test".($i-1);
	}
	
	$insertData = [
		'id' => "\"zjttw_" . $id . "\"",
		"password" => "\"" . password_hash("test".$i, PASSWORD_DEFAULT) . "\"",
		"name" => "\"test".$i."\"",
		"gender" => "\"M\"",
		"level" => "\"\"",
		"myreferral" => "\"".$myreferral."\"",
		"referral" => "\"". $referral ."\"",
		"birthday" => "\"\"",
		"email" => "\"test".$i."@mail.com\"",
		"phone" => "\"\"",
		"mobile" => "\"\"",
		"company_no" => "\"\"",
		"invoice_title" => "\"\"",
		"city" => "\"\"",
		"area" => "\"\"",
		"address" => "\"\"",
		"constore" => "\"\"",
		"regtime" => "\"" . date("Y-m-d H:i:s", time()) . "\"",
		"verifycode" => "\"\"",
		"verifytime" => "\"0\"",
		"type" => "\"1\"",
		"status" => "\"1\""
	];
	
	$keys = array_keys($insertData);

	$sqlSetStr = f1($keys);

	$sqlValueStr = f2($keys, $insertData);

	$sql = 'INSERT INTO members ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';

	//$result = mysqli_query($conn, $sql);
	
	//推薦表
	//echo $sql = "INSERT INTO recommendmap(memid, referral, leveldiff, addtime, updatetime) VALUES('".$id."','".$referral."','".($i-1)."',NOW(),NOW())";
	if($referral!=""){
		foreach(explode(";",findReferral("zjttw_".$id, $referral, 1)) as $sql){
			$result = mysqli_query($conn, $sql);
		}
	}
	
	echo "<hr>";
}

?>
Done!
