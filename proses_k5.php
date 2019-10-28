<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k51 = $_POST['k51'];
	$k52 = $_POST['k52'];
	
	if(k51==1){
		$ket51 = "";
	}
	else if(k51==0){
		$ket51 = $_POST['ket51'];
	}
	
	if(k52==1){
		$ket52 = "";
	}
	else if(k52==0){
		$ket52 = $_POST['ket52'];
	}
		
	$k5_total = $k51+$k52;
	$k5_rata = $k5_total/2;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk5 = $row_total['k5'];
	$originalTotal = $row_total['total'];
	
	if($k5_rata<=1 && $k5_rata>0.75){
		$newTotal = $originalTotal-$originalk5+4;
		mysql_query("UPDATE indikator_5 SET k51='$k51', k52='$k52', ket51='$ket51', ket52='$ket52', k5=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k5=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k5_rata<=0.75 && $k5_rata>0.5){
		$newTotal = $originalTotal-$originalk5+3;
		mysql_query("UPDATE indikator_5 SET k51='$k51', k52='$k52', ket51='$ket51', ket52='$ket52', k5=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k5=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k5_rata<=0.5 && $k5_rata>0.25){
		$newTotal = $originalTotal-$originalk5+2;
		mysql_query("UPDATE indikator_5 SET k51='$k51', k52='$k52', ket51='$ket51', ket52='$ket52', k5=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k5=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk5+1;
		mysql_query("UPDATE indikator_5 SET k51='$k51', k52='$k52', ket51='$ket51', ket52='$ket52', k5=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k5=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>