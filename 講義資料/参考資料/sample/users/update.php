<?php
try{
include("../connect.php");
$count = 0;
$id = isset($_GET['id']) ? $_GET['id'] : '';
if(isset($_POST['id'])) {
	// POST送信なので2段階目 UPDATE実行
	$id = $_POST['id'];
	$userID = $_POST['userID'];
	$password = $_POST['password'];
	$name = $_POST['name'];

	$statement = $conn->prepare("UPDATE users 
		SET userID=:userID , password=:password , name=:name WHERE id=:id");
	$ret = $statement->execute(
		array(":id" => $id,
			":userID" => $userID,
			":password" => $password,
			":name" => $name)
	);
	$count = ($ret)? $statement->rowCount() : 0;
}
// GET送信なので1段階目
if($id) {
	$result = $conn->prepare("SELECT * FROM users WHERE id=:id");
	$result->execute(array(":id" => $id));
	$r = $result->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>update</title>
</head>
<body>
<?php
	if($count == 1) {
		echo '更新しました<br>';
	}

?>
<form method="POST">
<input type="hidden" name="id"
 value="<?php echo $id; ?>" >
userID:
<input type="text" name="userID"
 value="<?php echo $r['userID']; ?>"><br>
password:
<input type="password" name="password"
 value="<?php echo $r['password']; ?>"><br>
name:
<input type="text" name="name"
 value="<?php echo $r['name']; ?>"><br>
<button>変更</button>
</form>

[<a href="read.php?id=<?php echo $r['id'];?>">表示へ戻る</a>]


</body>
</html>
<?php
}catch(PDOException $e){
	die($e->getMessage());
}
