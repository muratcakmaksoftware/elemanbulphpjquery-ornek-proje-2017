<?php
	@header('Content-Type: text/html; charset=utf-8');	
	global $db;
	$db = new PDO('mysql:host=localhost;dbname=elemanbul', 'root', '');
	if(!$db)
		echo "Database Connect Error!";
	
	
	$db->exec('SET NAMES UTF8'); 
	$db->exec("SET CHARACTER SET utf8"); 
	$db->exec("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");  
	
?>