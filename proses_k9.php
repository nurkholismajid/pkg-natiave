<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k91 = $_POST['k91'];
	$k92 = $_POST['k92'];
	$k93 = $_POST['k93'];
	$k94 = $_POST['k94'];
	$k95 = $_POST['k95'];
	
	if(k91==1){
		$ket91 = "";
	}
	else if(k91==0){
		$ket91 = $_POST['ket91'];
	}
	
	if(k92==1){
		$ket92 = "";
	}
	else if(k92==0){
		$ket92 = $_POST['ket92'];
	}
	
	if(k93==1){
		$ket93 = "";
	}
	else if(k93==0){
		$ket93 = $_POST['ket93'];
	}
	
	if(k94==1){
		$ket94 = "";
	}
	else if(k94==0){
		$ket94 = $_POST['ket94'];
	}
	
	if(k95==1){
		$ket95 = "";
	}
	else if(k95==0){
		$ket95 = $_POST['ket95'];
	}
	
	$k9_total = $k91+$k92+$k93+$k94+$k95;
	$k9_rata = $k9_total/5;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk9 = $row_total['k9'];
	$originalTotal = $row_total['total'];
	
	if($k9_rata<=1 && $k9_rata>0.75){
		$newTotal = $originalTotal-$originalk9+4;
		mysql_query("UPDATE indikator_9 SET k91='$k91', k92='$k92', k93='$k93', k94='$k94', k95='$k95', ket91='$ket91', ket92='$ket92', ket93='$ket93', ket94='$ket94', ket95='$ket95', k9=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k9=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k9_rata<=0.75 && $k9_rata>0.5){
		$newTotal = $originalTotal-$originalk9+3;
		mysql_query("UPDATE indikator_9 SET k91='$k91', k92='$k92', k93='$k93', k94='$k94', k95='$k95', ket91='$ket91', ket92='$ket92', ket93='$ket93', ket94='$ket94', ket95='$ket95', k9=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k9=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k9_rata<=0.5 && $k9_rata>0.25){
		$newTotal = $originalTotal-$originalk9+2;
		mysql_query("UPDATE indikator_9 SET k91='$k91', k92='$k92', k93='$k93', k94='$k94', k95='$k95', ket91='$ket91', ket92='$ket92', ket93='$ket93', ket94='$ket94', ket95='$ket95', k9=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k9=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk9+1;
		mysql_query("UPDATE indikator_9 SET k91='$k91', k92='$k92', k93='$k93', k94='$k94', k95='$k95', ket91='$ket91', ket92='$ket92', ket93='$ket93', ket94='$ket94', ket95='$ket95', k9=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k9=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>