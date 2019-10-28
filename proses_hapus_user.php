<?php
include 'lib/koneksi.php';

	mysql_query("DELETE FROM supervisor WHERE id = '$_GET[id]'");
	header("Location: daftar.php");
	exit;
?>