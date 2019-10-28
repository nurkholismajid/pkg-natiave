<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k41 = $_POST['k41'];
	$k42 = $_POST['k42'];
	$k43 = $_POST['k43'];
	
	if(k41==1){
		$ket41 = "";
	}
	else if(k41==0){
		$ket41 = $_POST['ket41'];
	}
	
	if(k42==1){
		$ket42 = "";
	}
	else if(k42==0){
		$ket42 = $_POST['ket42'];
	}
	
	if(k43==1){
		$ket43 = "";
	}
	else if(k43==0){
		$ket43 = $_POST['ket43'];
	}
	
	$k4_total = $k41+$k42+$k43;
	$k4_rata = $k4_total/3;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk4 = $row_total['k4'];
	$originalTotal = $row_total['total'];
	
	if($k4_rata<=1 && $k4_rata>0.75){
		$newTotal = $originalTotal-$originalk4+4;
		mysql_query("UPDATE indikator_4 SET k41='$k41', k42='$k42', k43='$k43', ket41='$ket41', ket42='$ket42', ket43='$ket43', k4=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k4=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k4_rata<=0.75 && $k4_rata>0.5){
		$newTotal = $originalTotal-$originalk4+3;
		mysql_query("UPDATE indikator_4 SET k41='$k41', k42='$k42', k43='$k43', ket41='$ket41', ket42='$ket42', ket43='$ket43', k4=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k4=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k4_rata<=0.5 && $k4_rata>0.25){
		$newTotal = $originalTotal-$originalk4+2;
		mysql_query("UPDATE indikator_4 SET k41='$k41', k42='$k42', k43='$k43', ket41='$ket41', ket42='$ket42', ket43='$ket43', k4=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k4=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk4+1;
		mysql_query("UPDATE indikator_4 SET k41='$k41', k42='$k42', k43='$k43', ket41='$ket41', ket42='$ket42', ket43='$ket43', k4=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k4=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>