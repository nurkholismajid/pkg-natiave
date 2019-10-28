<?php
include 'lib/koneksi.php';

	mysql_query("DELETE FROM guru WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM nilai WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_1 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_2 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_3 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_4 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_5 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_6 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_7 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_8 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_9 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_10 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_11 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_12 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_13 WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM indikator_14 WHERE id = '$_GET[id]'");
	header("Location: daftar.php");
	exit;
?>