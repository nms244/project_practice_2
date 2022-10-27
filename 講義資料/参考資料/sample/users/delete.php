<?php
try{
include("../connect.php");
$count = 0;
$id = isset($_GET['id']) ? $_GET['id'] : '';
if(isset($_SESSION['id'])) {
	if($id){
		if($id == $_SESSION['id']){
			 $statement = $conn->prepare("DELETE FROM users WHERE id=:id");
			$ret = $statement -> execute(array(":id" => $id));
			$count = ($ret)? $statement->rowCount() : 0;
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>delete</title>
</head>
<body>
<?php
if($count == 1) {
	echo "id={$id} を削除しました。";
}else {
	echo "id={$id} 削除に失敗しました。";
}
?>
</body>
</html>
<?php
}catch(PDOException $e){
	die($e->getMessage());
}
