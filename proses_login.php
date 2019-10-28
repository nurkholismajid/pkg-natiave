<?php 
session_start(); 
include 'lib/koneksi.php';
 
#jika ditekan tombol login 
if(isset($_POST['login'])) { 
 $username = $_POST['username']; 
 $password = $_POST['password']; 
 $sql = mysqli_query($conn, "SELECT * FROM supervisor WHERE username='$username' && password='$password'"); 
 $num = mysqli_num_rows($sql); 
 if($num==1) { 
  // login benar // 
  $_SESSION['username'] = $username; 
  $_SESSION['password'] = $password;
  $row=mysqli_fetch_array($sql);
  $kategori = $row['kategori'];
  if($kategori == 'admin' || $kategori == 'supervisor'){
	header("Location: daftar.php");
  }
  else{
	$sql2 = mysql_query("SELECT * FROM supervisor WHERE username='$username' && password='$password'");
	$row2=mysql_fetch_array($sql2);
	$id = $row2['id'];
	header("Location: raport.php");
  }
 } 
 else { 
  // jika login salah // 
  header("Location: index.php");
 } 
} 
?>