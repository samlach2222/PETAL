<?php
	try
	{
		$pdo = new PDO('mysql:host=localhost;dbname=petal_db;charset=utf8','root', 'root');    
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
?>
