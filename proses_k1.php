<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k11 = $_POST['k11'];
	$k12 = $_POST['k12'];
	$k13 = $_POST['k13'];
	
	if(k11==1){
		$ket11 = "";
	}
	else if(k11==0){
		$ket11 = $_POST['ket11'];
	}
	
	if(k12==1){
		$ket12 = "";
	}
	else if(k12==0){
		$ket12 = $_POST['ket12'];
	}
	
	if(k13==1){
		$ket13 = "";
	}
	else if(k13==0){
		$ket13 = $_POST['ket13'];
	}
	
	$k1_total = $k11+$k12+$k13;
	$k1_rata = $k1_total/3;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalK1 = $row_total['k1'];
	$originalTotal = $row_total['total'];
	
	if($k1_rata<=1 && $k1_rata>0.75){
		$newTotal = $originalTotal-$originalK1+4;
		mysql_query("UPDATE indikator_1 SET k11='$k11', k12='$k12', k13='$k13', ket11='$ket11', ket12='$ket12', ket13='$ket13', k1=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k1=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k1_rata<=0.75 && $k1_rata>0.5){
		$newTotal = $originalTotal-$originalK1+3;
		mysql_query("UPDATE indikator_1 SET k11='$k11', k12='$k12', k13='$k13', ket11='$ket11', ket12='$ket12', ket13='$ket13', k1=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k1=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k1_rata<=0.5 && $k1_rata>0.25){
		$newTotal = $originalTotal-$originalK1+2;
		mysql_query("UPDATE indikator_1 SET k11='$k11', k12='$k12', k13='$k13', ket11='$ket11', ket12='$ket12', ket13='$ket13', k1=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k1=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalK1+1;
		mysql_query("UPDATE indikator_1 SET k11='$k11', k12='$k12', k13='$k13', ket11='$ket11', ket12='$ket12', ket13='$ket13', k1=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k1=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>