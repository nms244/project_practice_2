<?php
include("../connect.php");
$keyword = $_POST['keyword'];
$result = FALSE;
if($keyword != '') {
	$result = $conn->prepare(
		"SELECT * FROM users WHERE name LIKE :keyword ");
	$result->execute(array(":keyword" => "%{$keyword}%") );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>search</title>
</head>
<body>
<?php
if(isset($_SESSION['name'])) {
	echo 'こんにちは'.$_SESSION['name'].'さん<br>';
?>
<form action="../login/logout.php" action="POST">
<button>ログアウト</button>
</form>
<?php
}
?>
[ <a href="create.php">新規作成</a> ]
<form method="POST">
キーワード：<input type="text" name="keyword"><button>検索</button>
</form>
<?php
if($result != FALSE) {
	
?>
<table>
	<tr><th>id</th><th>name</th></tr>
<?php
foreach($result as $r) {
	echo "<tr>";
	echo "<th><a href='read.php?id={$r["id"]}' >";
	echo $r['id'];
	echo "</a>";
	echo "</th>";
	echo "<th>".$r['name']."</th>";
	echo "</tr>";
}
?>
</table>
<?php
}
?>
</body>
</html>