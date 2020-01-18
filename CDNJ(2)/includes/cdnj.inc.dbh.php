<?php
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'cdnj_reservation';

	$server = '127.0.0.1;port=3306';
	$database = 'cdnj_reservation';
	$username = 'root';
	$password = 'Shrldud63#';

	// $server = '127.0.0.1;port=3307';
	// $database = 'cdnj_reservation';
	// $username = 'cdnj_user';
	// $password = '3uzC7zILuawzLLpG';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
