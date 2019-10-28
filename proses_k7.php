<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k71 = $_POST['k71'];
	$k72 = $_POST['k72'];
	$k73 = $_POST['k73'];
	$k74 = $_POST['k74'];
	$k75 = $_POST['k75'];
	$k76 = $_POST['k76'];
	
	if(k71==1){
		$ket71 = "";
	}
	else if(k71==0){
		$ket71 = $_POST['ket71'];
	}
	
	if(k72==1){
		$ket72 = "";
	}
	else if(k72==0){
		$ket72 = $_POST['ket72'];
	}
	
	if(k73==1){
		$ket73 = "";
	}
	else if(k73==0){
		$ket73 = $_POST['ket73'];
	}
	
	if(k74==1){
		$ket74 = "";
	}
	else if(k74==0){
		$ket74 = $_POST['ket74'];
	}
	
	if(k75==1){
		$ket75 = "";
	}
	else if(k75==0){
		$ket75 = $_POST['ket75'];
	}
	
	if(k76==1){
		$ket76 = "";
	}
	else if(k76==0){
		$ket76 = $_POST['ket76'];
	}
	
	$k7_total = $k71+$k72+$k73+$k74+$k75+$k76;
	$k7_rata = $k7_total/6;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk7 = $row_total['k7'];
	$originalTotal = $row_total['total'];
	
	if($k7_rata<=1 && $k7_rata>0.75){
		$newTotal = $originalTotal-$originalk7+4;
		mysql_query("UPDATE indikator_7 SET k71='$k71', k72='$k72', k73='$k73', k74='$k74', k75='$k75', k76='$k76', ket71='$ket71', ket72='$ket72', ket73='$ket73', ket74='$ket74', ket75='$ket75', ket76='$ket76', k7=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k7=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k7_rata<=0.75 && $k7_rata>0.5){
		$newTotal = $originalTotal-$originalk7+3;
		mysql_query("UPDATE indikator_7 SET k71='$k71', k72='$k72', k73='$k73', k74='$k74', k75='$k75', k76='$k76', ket71='$ket71', ket72='$ket72', ket73='$ket73', ket74='$ket74', ket75='$ket75', ket76='$ket76', k7=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k7=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k7_rata<=0.5 && $k7_rata>0.25){
		$newTotal = $originalTotal-$originalk7+2;
		mysql_query("UPDATE indikator_7 SET k71='$k71', k72='$k72', k73='$k73', k74='$k74', k75='$k75', k76='$k76', ket71='$ket71', ket72='$ket72', ket73='$ket73', ket74='$ket74', ket75='$ket75', ket76='$ket76', k7=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k7=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk7+1;
		mysql_query("UPDATE indikator_7 SET k71='$k71', k72='$k72', k73='$k73', k74='$k74', k75='$k75', k76='$k76', ket71='$ket71', ket72='$ket72', ket73='$ket73', ket74='$ket74', ket75='$ket75', ket76='$ket76', k7=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k7=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>