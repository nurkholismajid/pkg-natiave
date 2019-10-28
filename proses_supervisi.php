<?php
include 'lib/koneksi.php';
	
	$id=$_GET['id'];
	$ids=$_GET['ids'];
	
	//echo $id , "<br>";
	//echo $ids;
	
	$sql=mysql_query("SELECT * FROM guru WHERE id='$id'");
	$row=mysql_fetch_array($sql);
	$id_supervisor = $row['id_supervisor'];
	
	if($id_supervisor==0){
		mysql_query("UPDATE guru SET id_supervisor='$ids' WHERE id='$id'");
		header("Location: daftar_supervisi.php?id=$ids");
	}
	else{
		mysql_query("UPDATE guru SET id_supervisor=0 WHERE id='$id'");
		header("Location: daftar_supervisi.php?id=$ids");
	}
?>