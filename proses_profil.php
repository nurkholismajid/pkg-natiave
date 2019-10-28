<?php
include 'lib/koneksi.php';
	
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$nip = $_POST['nip'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tempat = $_POST['tempat'];
	$originalDate = $_POST['tanggal'];
	$pendidikan = $_POST['pendidikan'];
	
	$newDate = date("Y-m-d", strtotime($originalDate));
	
	mysql_query("UPDATE guru SET nama='$nama', nip='$nip', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat', tanggal_lahir='$newDate', pendidikan='$pendidikan' WHERE id ='$id'");
	header("Location: profil.php");
?>