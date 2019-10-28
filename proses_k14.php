<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k141 = $_POST['k141'];
	$k142 = $_POST['k142'];
	$k143 = $_POST['k143'];
	$k144 = $_POST['k144'];
	
	if(k141==1){
		$ket141 = "";
	}
	else if(k141==0){
		$ket141 = $_POST['ket141'];
	}
	
	if(k142==1){
		$ket142 = "";
	}
	else if(k142==0){
		$ket142 = $_POST['ket142'];
	}
	
	if(k143==1){
		$ket143 = "";
	}
	else if(k143==0){
		$ket143 = $_POST['ket143'];
	}
	
	if(k144==1){
		$ket144 = "";
	}
	else if(k144==0){
		$ket144 = $_POST['ket144'];
	}
	
	$k14_total = $k141+$k142+$k143+$k144;
	$k14_rata = $k14_total/4;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk14 = $row_total['k14'];
	$originalTotal = $row_total['total'];
	
	if($k14_rata<=1 && $k14_rata>0.75){
		$newTotal = $originalTotal-$originalk14+4;
		mysql_query("UPDATE indikator_14 SET k141='$k141', k142='$k142', k143='$k143', k144='$k144', ket141='$ket141', ket142='$ket142', ket143='$ket143', ket144='$ket144', k14=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k14=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k14_rata<=0.75 && $k14_rata>0.5){
		$newTotal = $originalTotal-$originalk14+3;
		mysql_query("UPDATE indikator_14 SET k141='$k141', k142='$k142', k143='$k143', k144='$k144', ket141='$ket141', ket142='$ket142', ket143='$ket143', ket144='$ket144', k14=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k14=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k14_rata<=0.5 && $k14_rata>0.25){
		$newTotal = $originalTotal-$originalk14+2;
		mysql_query("UPDATE indikator_14 SET k141='$k141', k142='$k142', k143='$k143', k144='$k144', ket141='$ket141', ket142='$ket142', ket143='$ket143', ket144='$ket144', k14=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k14=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk14+1;
		mysql_query("UPDATE indikator_14 SET k141='$k141', k142='$k142', k143='$k143', k144='$k144', ket141='$ket141', ket142='$ket142', ket143='$ket143', ket144='$ket144', k14=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k14=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>