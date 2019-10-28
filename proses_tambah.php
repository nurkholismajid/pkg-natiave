<?php
include 'lib/koneksi.php';

	$nama = $_POST['nama'];
	$nip = $_POST['nip'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tempat = $_POST['tempat'];
	$originalDate = $_POST['tanggal'];
	$pendidikan = $_POST['pendidikan'];
	
	$newDate = date("Y-m-d", strtotime($originalDate));
	
	mysql_query("INSERT INTO guru VALUES('',0,0,'$nip','$nama', '$tempat', '$newDate', '$jenis_kelamin', '$pendidikan')");
	mysql_query("INSERT INTO nilai VALUES('', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_1 VALUES('', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_2 VALUES('', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_3 VALUES('', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_4 VALUES('', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_5 VALUES('', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_6 VALUES('', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_7 VALUES('', '0', '0', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_8 VALUES('', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_9 VALUES('', '0', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_10 VALUES('', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_11 VALUES('', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_12 VALUES('', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_13 VALUES('', '0', '0', '0', '0', '0')");
	mysql_query("INSERT INTO indikator_14 VALUES('', '0', '0', '0', '0', '0')");
	header("Location: daftar.php");
?>