<?php
include 'lib/koneksi.php';
	
	$id=$_GET['id'];
	
	$sql=mysql_query("SELECT * FROM guru WHERE id='$id'");
	$row=mysql_fetch_array($sql);
	$supervisor = $row['supervisor'];
	
	if($supervisor==0){
		mysql_query("UPDATE guru SET supervisor=1 WHERE id='$id'");
		header("Location: daftar.php");
	}
	else{
		mysql_query("UPDATE guru SET id_supervisor=0 WHERE id_supervisor='$id'");
		mysql_query("UPDATE guru SET supervisor=0 WHERE id='$id'");
		mysql_query("UPDATE supervisor SET kategori='guru' WHERE id='$id'");
		header("Location: daftar.php");
	}
	
?>