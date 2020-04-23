<?php  
	$host = 'localhost';
	$db = 'dmiscb';
	$user = 'root';
	$pass = 'root';
	$charset = 'utf8mb4';
	$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
	];

	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	try {
		$pdo = new PDO($dsn, $user, $pass, $options);
	} catch (PDOException $e) {
		var_dump($e);
	}

?>