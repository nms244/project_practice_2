<?php
include("../connect.php");
$id = $_GET['id'];
$statement = $conn->prepare("SELECT * FROM users WHERE id=:id");
$statement->execute(array(":id" => $id));
$r = $statement->fetch(); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>read</title>
</head>
<body>
<?php
if($r == FALSE) {
	echo '存在しません';
} else {
	echo '<table>';
	echo '<tr><th>id</th>     <td>'. $r['id']    .'</td></tr>';
	echo '<tr><th>userID</th> <td>'. $r['userID'].'</td></tr>';
	echo '<tr><th>name</th>   <td>'. $r['name']  .'</td></tr>';
	echo '<tr><th>操作</th>   <td>
		<a href="update.php?id='. $r['id']  .'">編集</a>
		<a href="delete.php?id='. $r['id']  .'">削除</a>
		</td></tr>';
	echo '</table>';
}
?>
</body>
</html>