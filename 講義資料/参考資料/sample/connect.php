<?php
session_start();
try {	
$option = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );
$conn = new PDO(
	"mysql:host=localhost;dbname=test;charset=utf8;", 
	"root", "", $option );

}catch(PDOException $e){
  die($e->getMessage());
}

?>