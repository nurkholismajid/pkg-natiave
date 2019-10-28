<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k31 = $_POST['k31'];
	$k32 = $_POST['k32'];
	$k33 = $_POST['k33'];
	$k34 = $_POST['k34'];
	
	if(k31==1){
		$ket31 = "";
	}
	else if(k31==0){
		$ket31 = $_POST['ket31'];
	}
	
	if(k32==1){
		$ket32 = "";
	}
	else if(k32==0){
		$ket32 = $_POST['ket32'];
	}
	
	if(k33==1){
		$ket33 = "";
	}
	else if(k33==0){
		$ket33 = $_POST['ket33'];
	}
	
	if(k34==1){
		$ket34 = "";
	}
	else if(k34==0){
		$ket34 = $_POST['ket34'];
	}
	
	$k3_total = $k31+$k32+$k33+$k34;
	$k3_rata = $k3_total/4;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalK3 = $row_total['k3'];
	$originalTotal = $row_total['total'];
	
	if($k3_rata<=1 && $k3_rata>0.75){
		$newTotal = $originalTotal-$originalK3+4;
		mysql_query("UPDATE indikator_3 SET k31='$k31', k32='$k32', k33='$k33', k34='$k34', ket31='$ket31', ket32='$ket32', ket33='$ket33', ket34='$ket34', k3=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k3=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k3_rata<=0.75 && $k3_rata>0.5){
		$newTotal = $originalTotal-$originalK3+3;
		mysql_query("UPDATE indikator_3 SET k31='$k31', k32='$k32', k33='$k33', k34='$k34', ket31='$ket31', ket32='$ket32', ket33='$ket33', ket34='$ket34', k3=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k3=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k3_rata<=0.5 && $k3_rata>0.25){
		$newTotal = $originalTotal-$originalK3+2;
		mysql_query("UPDATE indikator_3 SET k31='$k31', k32='$k32', k33='$k33', k34='$k34', ket31='$ket31', ket32='$ket32', ket33='$ket33', ket34='$ket34', k3=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k3=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalK3+1;
		mysql_query("UPDATE indikator_3 SET k31='$k31', k32='$k32', k33='$k33', k34='$k34', ket31='$ket31', ket32='$ket32', ket33='$ket33', ket34='$ket34', k3=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k3=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>