<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k121 = $_POST['k121'];
	$k122 = $_POST['k122'];
	$k123 = $_POST['k123'];
	$k124 = $_POST['k124'];
	
	if(k121==1){
		$ket121 = "";
	}
	else if(k121==0){
		$ket121 = $_POST['ket121'];
	}
	
	if(k122==1){
		$ket122 = "";
	}
	else if(k122==0){
		$ket122 = $_POST['ket122'];
	}
	
	if(k123==1){
		$ket123 = "";
	}
	else if(k123==0){
		$ket123 = $_POST['ket123'];
	}
	
	if(k124==1){
		$ket124 = "";
	}
	else if(k124==0){
		$ket124 = $_POST['ket124'];
	}
	
	$k12_total = $k121+$k122+$k123+$k124;
	$k12_rata = $k12_total/4;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk12 = $row_total['k12'];
	$originalTotal = $row_total['total'];
	
	if($k12_rata<=1 && $k12_rata>0.75){
		$newTotal = $originalTotal-$originalk12+4;
		mysql_query("UPDATE indikator_12 SET k121='$k121', k122='$k122', k123='$k123', k124='$k124', ket121='$ket121', ket122='$ket122', ket123='$ket123', ket124='$ket124', k12=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k12=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k12_rata<=0.75 && $k12_rata>0.5){
		$newTotal = $originalTotal-$originalk12+3;
		mysql_query("UPDATE indikator_12 SET k121='$k121', k122='$k122', k123='$k123', k124='$k124', ket121='$ket121', ket122='$ket122', ket123='$ket123', ket124='$ket124', k12=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k12=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k12_rata<=0.5 && $k12_rata>0.25){
		$newTotal = $originalTotal-$originalk12+2;
		mysql_query("UPDATE indikator_12 SET k121='$k121', k122='$k122', k123='$k123', k124='$k124', ket121='$ket121', ket122='$ket122', ket123='$ket123', ket124='$ket124', k12=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k12=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk12+1;
		mysql_query("UPDATE indikator_12 SET k121='$k121', k122='$k122', k123='$k123', k124='$k124', ket121='$ket121', ket122='$ket122', ket123='$ket123', ket124='$ket124', k12=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k12=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>