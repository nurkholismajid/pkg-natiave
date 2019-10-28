<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k21 = $_POST['k21'];
	$k22 = $_POST['k22'];
	$k23 = $_POST['k23'];
	$k24 = $_POST['k24'];
	
	if(k21==1){
		$ket21 = "";
	}
	else if(k21==0){
		$ket21 = $_POST['ket21'];
	}
	
	if(k22==1){
		$ket22 = "";
	}
	else if(k22==0){
		$ket22 = $_POST['ket22'];
	}
	
	if(k23==1){
		$ket23 = "";
	}
	else if(k23==0){
		$ket23 = $_POST['ket23'];
	}
	
	if(k24==1){
		$ket24 = "";
	}
	else if(k24==0){
		$ket24 = $_POST['ket24'];
	}
	
	$k2_total = $k21+$k22+$k23+$k24;
	$k2_rata = $k2_total/4;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalK2 = $row_total['k2'];
	$originalTotal = $row_total['total'];
	
	if($k2_rata<=1 && $k2_rata>0.75){
		$newTotal = $originalTotal-$originalK2+4;
		mysql_query("UPDATE indikator_2 SET k21='$k21', k22='$k22', k23='$k23', k24='$k24', ket21='$ket21', ket22='$ket22', ket23='$ket23', ket24='$ket24', k2=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k2=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k2_rata<=0.75 && $k2_rata>0.5){
		$newTotal = $originalTotal-$originalK2+3;
		mysql_query("UPDATE indikator_2 SET k21='$k21', k22='$k22', k23='$k23', k24='$k24', ket21='$ket21', ket22='$ket22', ket23='$ket23', ket24='$ket24', k2=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k2=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k2_rata<=0.5 && $k2_rata>0.25){
		$newTotal = $originalTotal-$originalK2+2;
		mysql_query("UPDATE indikator_2 SET k21='$k21', k22='$k22', k23='$k23', k24='$k24', ket21='$ket21', ket22='$ket22', ket23='$ket23', ket24='$ket24', k2=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k2=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalK2+1;
		mysql_query("UPDATE indikator_2 SET k21='$k21', k22='$k22', k23='$k23', k24='$k24', ket21='$ket21', ket22='$ket22', ket23='$ket23', ket24='$ket24', k2=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k2=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>