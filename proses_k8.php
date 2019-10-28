<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k81 = $_POST['k81'];
	$k82 = $_POST['k82'];
	$k83 = $_POST['k83'];
	
	if(k81==1){
		$ket81 = "";
	}
	else if(k81==0){
		$ket81 = $_POST['ket81'];
	}
	
	if(k82==1){
		$ket82 = "";
	}
	else if(k82==0){
		$ket82 = $_POST['ket82'];
	}
	
	if(k83==1){
		$ket83 = "";
	}
	else if(k83==0){
		$ket83 = $_POST['ket83'];
	}
	
	$k8_total = $k81+$k82+$k83;
	$k8_rata = $k8_total/3;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk8 = $row_total['k8'];
	$originalTotal = $row_total['total'];
	
	if($k8_rata<=1 && $k8_rata>0.75){
		$newTotal = $originalTotal-$originalk8+4;
		mysql_query("UPDATE indikator_8 SET k81='$k81', k82='$k82', k83='$k83', ket81='$ket81', ket82='$ket82', ket83='$ket83', k8=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k8=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k8_rata<=0.75 && $k8_rata>0.5){
		$newTotal = $originalTotal-$originalk8+3;
		mysql_query("UPDATE indikator_8 SET k81='$k81', k82='$k82', k83='$k83', ket81='$ket81', ket82='$ket82', ket83='$ket83', k8=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k8=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k8_rata<=0.5 && $k8_rata>0.25){
		$newTotal = $originalTotal-$originalk8+2;
		mysql_query("UPDATE indikator_8 SET k81='$k81', k82='$k82', k83='$k83', ket81='$ket81', ket82='$ket82', ket83='$ket83', k8=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k8=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk8+1;
		mysql_query("UPDATE indikator_8 SET k81='$k81', k82='$k82', k83='$k83', ket81='$ket81', ket82='$ket82', ket83='$ket83', k8=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k8=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>