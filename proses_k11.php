<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k111 = $_POST['k111'];
	$k112 = $_POST['k112'];
	
	if(k111==1){
		$ket111 = "";
	}
	else if(k111==0){
		$ket111 = $_POST['ket111'];
	}
	
	if(k112==1){
		$ket112 = "";
	}
	else if(k112==0){
		$ket112 = $_POST['ket112'];
	}
	
	$k11_total = $k111+$k112;
	$k11_rata = $k11_total/2;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk11 = $row_total['k11'];
	$originalTotal = $row_total['total'];
	
	if($k11_rata<=1 && $k11_rata>0.75){
		$newTotal = $originalTotal-$originalk11+4;
		mysql_query("UPDATE indikator_11 SET k111='$k111', k112='$k112', ket111='$ket111', ket112='$ket112', k11=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k11=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k11_rata<=0.75 && $k11_rata>0.5){
		$newTotal = $originalTotal-$originalk11+3;
		mysql_query("UPDATE indikator_11 SET k111='$k111', k112='$k112', ket111='$ket111', ket112='$ket112', k11=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k11=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k11_rata<=0.5 && $k11_rata>0.25){
		$newTotal = $originalTotal-$originalk11+2;
		mysql_query("UPDATE indikator_11 SET k111='$k111', k112='$k112', ket111='$ket111', ket112='$ket112', k11=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k11=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk11+1;
		mysql_query("UPDATE indikator_11 SET k111='$k111', k112='$k112', ket111='$ket111', ket112='$ket112', k11=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k11=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>