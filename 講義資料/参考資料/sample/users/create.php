<?php
include("../connect.php");
$userID = isset($_POST['userID'])? $_POST['userID']:'';
$name = $_POST['name'];
$password = $_POST['password'];
$id = -1;
if(isset($userID,$name,$password)){
	if($userID!='' && $name!='' && $password!='') {
		$result = $conn->prepare(
			"INSERT INTO users 
			(id , userID, password , name ) 
			VALUES(NULL, :userID  , :password , :name )");
		$ret = $result -> execute(
				array(":userID" => $userID,
				":name" => $name,
				":password" => $password));
		$count = ($ret)? $result->rowCount() : 0;
		if($count == 1) {
			$id = $conn->lastInsertId();
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>create</title>
</head>
<body>
<?php
	if($id!= -1) {
		echo "ユーザを追加しました。ID:<a href='read.php?id={$id}'>{$id}</a><br>";
	}
?>
ユーザ追加：
<form method="POST">
userID: <input type="text" name="userID"><br>
name: <input type="text" name="name"><br>
password: <input type="password" name="password"><br>
<button>登録</button>
</form>
</body>
</html>
