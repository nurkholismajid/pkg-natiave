<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k61 = $_POST['k61'];
	$k62 = $_POST['k62'];
	$k63 = $_POST['k63'];
	$k64 = $_POST['k64'];
	
	if(k61==1){
		$ket61 = "";
	}
	else if(k61==0){
		$ket61 = $_POST['ket61'];
	}
	
	if(k62==1){
		$ket62 = "";
	}
	else if(k62==0){
		$ket62 = $_POST['ket62'];
	}
	
	if(k63==1){
		$ket63 = "";
	}
	else if(k63==0){
		$ket63 = $_POST['ket63'];
	}
	
	if(k64==1){
		$ket64 = "";
	}
	else if(k64==0){
		$ket64 = $_POST['ket64'];
	}
	
	$k6_total = $k61+$k62+$k63+$k64;
	$k6_rata = $k6_total/4;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk6 = $row_total['k6'];
	$originalTotal = $row_total['total'];
	
	if($k6_rata<=1 && $k6_rata>0.75){
		$newTotal = $originalTotal-$originalk6+4;
		mysql_query("UPDATE indikator_6 SET k61='$k61', k62='$k62', k63='$k63', k64='$k64', ket61='$ket61', ket62='$ket62', ket63='$ket63', ket64='$ket64', k6=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k6=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k6_rata<=0.75 && $k6_rata>0.5){
		$newTotal = $originalTotal-$originalk6+3;
		mysql_query("UPDATE indikator_6 SET k61='$k61', k62='$k62', k63='$k63', k64='$k64', ket61='$ket61', ket62='$ket62', ket63='$ket63', ket64='$ket64', k6=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k6=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k6_rata<=0.5 && $k6_rata>0.25){
		$newTotal = $originalTotal-$originalk6+2;
		mysql_query("UPDATE indikator_6 SET k61='$k61', k62='$k62', k63='$k63', k64='$k64', ket61='$ket61', ket62='$ket62', ket63='$ket63', ket64='$ket64', k6=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k6=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk6+1;
		mysql_query("UPDATE indikator_6 SET k61='$k61', k62='$k62', k63='$k63', k64='$k64', ket61='$ket61', ket62='$ket62', ket63='$ket63', ket64='$ket64', k6=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k6=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>