<?php
try {	
include("../connect.php");
$u = $_POST['userID'];
$p = $_POST['password'];
$result = $conn->prepare(
	"SELECT * FROM users WHERE userID=:userID");
$result -> execute(array(":userID" => $u));
$r = $result->fetch(); 
	// $rはuserIDが$uの値であるレコード（配列）
$conn = null; 

// 以下，$r['password']と$pとを比較して，ログインの
// 可否を判断する。
// ※ユーザIDが存在しない場合は $r == FALSEとなる
if( $r != FALSE && $p == $r['password'] ):
	$_SESSION['id']=$r['id'];
	$_SESSION['name']=$r['name'];
	// ログイン成功
	header("Location: ../users/search.php");
else:
	// ログイン失敗
	header("Location:failure.html");
endif;

}catch(PDOException $e){
  die($e->getMessage());
}
?>