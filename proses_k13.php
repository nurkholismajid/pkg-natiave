<?php
include 'lib/koneksi.php';

	$id = $_POST['id'];
	$k131 = $_POST['k131'];
	$k132 = $_POST['k132'];
	$k133 = $_POST['k133'];
	$k134 = $_POST['k134'];
	
	if(k131==1){
		$ket131 = "";
	}
	else if(k131==0){
		$ket131 = $_POST['ket131'];
	}
	
	if(k132==1){
		$ket132 = "";
	}
	else if(k132==0){
		$ket132 = $_POST['ket132'];
	}
	
	if(k133==1){
		$ket133 = "";
	}
	else if(k133==0){
		$ket133 = $_POST['ket133'];
	}
	
	if(k134==1){
		$ket134 = "";
	}
	else if(k134==0){
		$ket134 = $_POST['ket134'];
	}
	
	$k13_total = $k131+$k132+$k133+$k134;
	$k13_rata = $k13_total/4;
	
	$total=mysql_query("SELECT * FROM nilai WHERE id='$id'");
	$row_total=mysql_fetch_array($total);
	
	$originalk13 = $row_total['k13'];
	$originalTotal = $row_total['total'];
	
	if($k13_rata<=1 && $k13_rata>0.75){
		$newTotal = $originalTotal-$originalk13+4;
		mysql_query("UPDATE indikator_13 SET k131='$k131', k132='$k132', k133='$k133', k134='$k134', ket131='$ket131', ket132='$ket132', ket133='$ket133', ket134='$ket134', k13=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k13=4 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k13_rata<=0.75 && $k13_rata>0.5){
		$newTotal = $originalTotal-$originalk13+3;
		mysql_query("UPDATE indikator_13 SET k131='$k131', k132='$k132', k133='$k133', k134='$k134', ket131='$ket131', ket132='$ket132', ket133='$ket133', ket134='$ket134', k13=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k13=3 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else if($k13_rata<=0.5 && $k13_rata>0.25){
		$newTotal = $originalTotal-$originalk13+2;
		mysql_query("UPDATE indikator_13 SET k131='$k131', k132='$k132', k133='$k133', k134='$k134', ket131='$ket131', ket132='$ket132', ket133='$ket133', ket134='$ket134', k13=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k13=2 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
	else{
		$newTotal = $originalTotal-$originalk13+1;
		mysql_query("UPDATE indikator_13 SET k131='$k131', k132='$k132', k133='$k133', k134='$k134', ket131='$ket131', ket132='$ket132', ket133='$ket133', ket134='$ket134', k13=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET k13=1 WHERE id ='$id'");
		mysql_query("UPDATE nilai SET total=$newTotal WHERE id ='$id'");
		header("Location: analisis.php?id=$id");
	}
?>