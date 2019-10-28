<?php 
session_start(); 
include 'lib/koneksi.php';
 
#jika ditekan tombol login 
if(isset($_POST['ubah'])) {
 $username = $_SESSION['username'];
 $oldpass = $_POST['passlama']; 
 $newpass = $_POST['passbaru'];
 $confirm = $_POST['ulangpassbaru']; 
 $sql = mysql_query("SELECT * FROM supervisor WHERE username='$username'");
 $num = mysql_num_rows($sql); 
 $row = mysql_fetch_array($sql);
 
 if($num==1){ 
  if($oldpass==$row['password']){
	  if($newpass==$confirm){
		mysql_query("UPDATE supervisor SET password='$newpass' WHERE username='$username'");
		?><script language="JavaScript">alert('Anda berhasil mengganti password'); 
		document.location='profil.php'</script><?php
	  }else
		?><script language="JavaScript">alert('Ulangi password baru Anda dengan benar!'); 
		document.location='profil.php'</script><?php
  }else
  	?><script language="JavaScript">alert('Password lama Anda tidak sesuai!'); 
  	document.location='profil.php'</script><?php
 } else { 
  ?><script language="JavaScript">alert('Anda gagal mengganti password!'); 
  document.location='profil.php'</script><?php 
 } 
} 
?>