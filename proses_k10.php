<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k101 = $_POST['k101'];
	$k102 = $_POST['k102'];
	$k103 = $_POST['k103'];
	
	if(k101==1){
		$ket101 = "";
	}
	else if(k101==0){
		$ket101 = $_POST['ket101'];
	}
	
	if(k102==1){
		$ket102 = "";
	}
	else if(k102==0){
		$ket102 = $_POST['ket102'];
	}
	
	if(k103==1){
		$ket103 = "";
	}
	else if(k103==0){
		$ket103 = $_POST['ket103'];
	}
	
	$k10_total = $k101+$k102+$k103;
	$k10_rata = $k10_total/3;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk10 = $row_total['k10'];
	$originalTotal = $row_total['total'];
	
	if($k10_rata<=1 && $k10_rata>0.75){
		$newTotal = $originalTotal-$originalk10+4;
		mysql_query("UPDATE indikator_10 SET k101='$k101', k102='$k102', k103='$k103', ket101='$ket101', ket102='$ket102', ket103='$ket103', k10=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k10=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k10_rata<=0.75 && $k10_rata>0.5){
		$newTotal = $originalTotal-$originalk10+3;
		mysql_query("UPDATE indikator_10 SET k101='$k101', k102='$k102', k103='$k103', ket101='$ket101', ket102='$ket102', ket103='$ket103', k10=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k10=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k10_rata<=0.5 && $k10_rata>0.25){
		$newTotal = $originalTotal-$originalk10+2;
		mysql_query("UPDATE indikator_10 SET k101='$k101', k102='$k102', k103='$k103', ket101='$ket101', ket102='$ket102', ket103='$ket103', k10=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k10=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk10+1;
		mysql_query("UPDATE indikator_10 SET k101='$k101', k102='$k102', k103='$k103', ket101='$ket101', ket102='$ket102', ket103='$ket103', k10=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k10=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>