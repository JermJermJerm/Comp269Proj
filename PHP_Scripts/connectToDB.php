<?php
	$dsn = 'mysql:dbname=test;host=127.0.0.1';
	$user = 'root';
	$pass = '';
	
	
	$db = new PDO($dsn, $user, $password);
	
	//Use a try catch in the future to get connection success /errors

?>