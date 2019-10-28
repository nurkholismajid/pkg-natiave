<?php
include 'lib/koneksi.php';
	
	$id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	mysql_query("UPDATE supervisor SET username='$username', password='$password' WHERE id ='$id'");
	header("Location: daftar.php");
?>