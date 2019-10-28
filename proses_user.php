<?php
include 'lib/koneksi.php';

	$id = $_GET['id'];
	$nama = $_GET['nama'];
	$supervisor = $_GET['supervisor'];
	
	if($supervisor==1){
		mysql_query("INSERT INTO supervisor VALUES('$id', 'supervisor', '$nama', '$nama')");
		header("Location: daftar.php");
	}
	else{
		mysql_query("INSERT INTO supervisor VALUES('$id', 'guru', '$nama', '$nama')");
		header("Location: daftar.php");
	}
?>