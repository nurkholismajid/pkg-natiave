<?
session_start();
include "lib/koneksi.php";

$id=$_GET['id'];
$nama=mysql_query("SELECT nama FROM guru WHERE id='$id'");
$row_nama=mysql_fetch_array($nama);

if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
?>
<script language="JavaScript">alert('You are not login yet, please login first'); 
document.location='index.php'</script>
<?
}else{
	$username = $_SESSION['username'];
	$sql_admin = mysql_query("SELECT * FROM supervisor WHERE username='$username'");
	$row_admin =mysql_fetch_array($sql_admin);
	$kategori = $row_admin['kategori'];
	$id_supervisor1 = $row_admin['id'];
	
	if($kategori=='guru'){
		header("Location: raport.php");
	}
	
	$sql_supervisor = mysql_query("SELECT * FROM guru WHERE id_supervisor='$id_supervisor1'");
	$row_supervisor =mysql_fetch_array($sql_supervisor);
	$id_supervisor2 = $row_supervisor['id_supervisor'];
?>

<!DOCTYPE HTML>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Analisis | PKG SMKN 6 Malang</title>
	<meta http-equiv="refresh" content = "600; url=proses_logout.php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/docs.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
	  .well{
	    background-color:#ecf8ff;
	  }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>
	<div id="myContact" class="modal hide fade" style="display: none; ">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">×</button>
              <h3>Contact</h3>
            </div>
            <div class="modal-body">
				
			</div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
    </div>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <? echo $_SESSION['username'];?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
			  <li><a href="profil.php"><i class="icon-user"></i> Profil</a></li>
              <li class="divider"></li>
              <li><a href="proses_logout.php">Sign Out</a></li>
            </ul>
          </div>
          <div class="nav-collapse">
            <ul class="nav">         
              <li><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
			  <?
				if($kategori=='admin'){
					?><li class="active"><a href="daftar.php"><i class="icon-search icon-white"></i> Administrator</a></li><?
				}
				else{
					?>
					<li class="active"><a href="daftar.php"><i class="icon-search icon-white"></i> Penilaian</a></li>
					<li><a href="raport.php"><i class="icon-book icon-white"></i> Raport</a></li>
					<?
				}
			  ?>
              <li><a data-toggle="modal" href="#myContact"><i class="icon-th-large icon-white"></i> Kontak</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
		<h1><? echo $row_nama['nama'];?></h1>
		<br>
		<div class="row-fluid">
			<ul id="myTab" class="nav nav-tabs">
				<li class="active"><a href="#petunjuk" data-toggle="tab">Hasil</a></li>
				<li class=""><a href="#identitas" data-toggle="tab">Identitas</a></li>
				<li class=""><a href="#kompetensi" data-toggle="tab">Indikator</a></li>		
			</ul>
		  <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="petunjuk">
			<?
				if($kategori=='supervisor'){?>
				<div class="alert alert-info">
					<button class="close" data-dismiss="alert">&times;</button>
					Anda adalah supervisor, pilih tab Indikator untuk melakukan penilaian.
				</div>
				<?}?>
			
			<?
				if($kategori=='admin'){
					$sql_previous=mysql_query("SELECT * FROM guru WHERE id<'$id' ORDER BY id DESC");
					$sql_next=mysql_query("SELECT * FROM guru WHERE id>'$id' ORDER BY id ASC");
					$row_previous=mysql_fetch_array($sql_previous);
					$row_next=mysql_fetch_array($sql_next);
					$id_previous = $row_previous['id'];
					$id_next = $row_next['id'];
				}
				if($kategori=='supervisor'){
					$sql_previous=mysql_query("SELECT * FROM guru WHERE id<'$id' AND id_supervisor=$id_supervisor2 ORDER BY id DESC");
					$sql_next=mysql_query("SELECT * FROM guru WHERE id>'$id' AND id_supervisor=$id_supervisor2 ORDER BY id ASC");
					$row_previous=mysql_fetch_array($sql_previous);
					$row_next=mysql_fetch_array($sql_next);
					$id_previous = $row_previous['id'];
					$id_next = $row_next['id'];
				}
				if($kategori!='guru'){
			?>
				<a href="analisis.php?id=<? echo $id_previous;?>"><i class="icon-chevron-left" title="ke raport sebelumnya"></i></a>
				<a class="nav pull-right" href="analisis.php?id=<? echo $id_next;?>"><i class="icon-chevron-right" title="ke raport selanjutnya"></i></a>
			<?}?>
				<h3>HASIL PENILAIAN KINERJA GURU</h3>
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="2%">No</th>
							<th>Indikator Kinerja Guru</th>
							<th>Nilai</th>
						</tr>
					</thead>
					<tbody>
						<?
							$skor=mysql_query("SELECT * FROM nilai WHERE id='$id'");
							$row_skor=mysql_fetch_array($skor);
						?>
						<tr>
							<td colspan="3"><strong>I. PERENCANAAN PEMBELAJARAN</strong></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Guru memformulasikan tujuan  pembelajaran dalam RPP sesuai dengan kurikulum/silabus dan memperhatikan karakteristik peserta didik</td>
							<td>
							<?
							$k1 = $row_skor['k1'];
							if($k1>=3){
								?><span class="badge badge-success"><? echo $row_skor['k1'];?></span><?
							}
							if($k1==2){
								?><span class="badge badge-warning"><? echo $row_skor['k1'];?></span><?
							}
							if($k1==1){
								?><span class="badge badge-important"><? echo $row_skor['k1'];?></span><?
							}
							if($k1==0){
								?><span class="badge"><? echo $row_skor['k1'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Guru menyusun  bahan ajar secara runut, logis, kontekstual dan mutakhir</td>
							<td>
							<?
							$k2 = $row_skor['k2'];
							if($k2>=3){
								?><span class="badge badge-success"><? echo $row_skor['k2'];?></span><?
							}
							if($k2==2){
								?><span class="badge badge-warning"><? echo $row_skor['k2'];?></span><?
							}
							if($k2==1){
								?><span class="badge badge-important"><? echo $row_skor['k2'];?></span><?
							}
							if($k2==0){
								?><span class="badge"><? echo $row_skor['k2'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Guru merencanakan kegiatan pembelajaran yang efektif</td>
							<td>
							<?
							$k3 = $row_skor['k3'];
							if($k3>=3){
								?><span class="badge badge-success"><? echo $row_skor['k3'];?></span><?
							}
							if($k3==2){
								?><span class="badge badge-warning"><? echo $row_skor['k3'];?></span><?
							}
							if($k3==1){
								?><span class="badge badge-important"><? echo $row_skor['k3'];?></span><?
							}
							if($k3==0){
								?><span class="badge"><? echo $row_skor['k3'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Guru memilih sumber belajar/ media pembelajaran sesuai dengan materi dan strategi pembelajaran</td>
							<td>
							<?
							$k4 = $row_skor['k4'];
							if($k4>=3){
								?><span class="badge badge-success"><? echo $row_skor['k4'];?></span><?
							}
							if($k4==2){
								?><span class="badge badge-warning"><? echo $row_skor['k4'];?></span><?
							}
							if($k4==1){
								?><span class="badge badge-important"><? echo $row_skor['k4'];?></span><?
							}
							if($k4==0){
								?><span class="badge"><? echo $row_skor['k4'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><strong>Sub Total Nilai Kinerja Perencanaan Pembelajaran</strong></td>
							<td><span class="badge badge-info"><?echo $k1+$k2+$k3+$k4;?></span></td>
						</tr>
						<tr>
							<td colspan="3"><strong>II. PELAKSANAAN KEGIATAN PEMBELAJARAN YANG AKTIF DAN EFEKTIF</strong></td>
						</tr>
						<tr>
							<td>5</td>
							<td>Guru memulai pembelajaran dengan efektif</td>
							<td>
							<?
							$k5 = $row_skor['k5'];
							if($k5>=3){
								?><span class="badge badge-success"><? echo $row_skor['k5'];?></span><?
							}
							if($k5==2){
								?><span class="badge badge-warning"><? echo $row_skor['k5'];?></span><?
							}
							if($k5==1){
								?><span class="badge badge-important"><? echo $row_skor['k5'];?></span><?
							}
							if($k5==0){
								?><span class="badge"><? echo $row_skor['k5'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>6</td>
							<td>Guru menguasai materi pelajaran</td>
							<td>
							<?
							$k6 = $row_skor['k6'];
							if($k6>=3){
								?><span class="badge badge-success"><? echo $row_skor['k6'];?></span><?
							}
							if($k6==2){
								?><span class="badge badge-warning"><? echo $row_skor['k6'];?></span><?
							}
							if($k6==1){
								?><span class="badge badge-important"><? echo $row_skor['k6'];?></span><?
							}
							if($k6==0){
								?><span class="badge"><? echo $row_skor['k6'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>7</td>
							<td>Guru menerapkan pendekatan/strategi pembelajaran yang efektif</td>
							<td>
							<?
							$k7 = $row_skor['k7'];
							if($k7>=3){
								?><span class="badge badge-success"><? echo $row_skor['k7'];?></span><?
							}
							if($k7==2){
								?><span class="badge badge-warning"><? echo $row_skor['k7'];?></span><?
							}
							if($k7==1){
								?><span class="badge badge-important"><? echo $row_skor['k7'];?></span><?
							}
							if($k7==0){
								?><span class="badge"><? echo $row_skor['k7'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>8</td>
							<td>Guru memanfaatan sumber belajar/media dalam pembelajaran</td>
							<td>
							<?
							$k8 = $row_skor['k8'];
							if($k8>=3){
								?><span class="badge badge-success"><? echo $row_skor['k8'];?></span><?
							}
							if($k8==2){
								?><span class="badge badge-warning"><? echo $row_skor['k8'];?></span><?
							}
							if($k8==1){
								?><span class="badge badge-important"><? echo $row_skor['k8'];?></span><?
							}
							if($k8==0){
								?><span class="badge"><? echo $row_skor['k8'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>9</td>
							<td>Guru memotivasi dan/atau memelihara keterlibatan siswa dalam pembelajaran</td>
							<td>
							<?
							$k9 = $row_skor['k9'];
							if($k9>=3){
								?><span class="badge badge-success"><? echo $row_skor['k9'];?></span><?
							}
							if($k9==2){
								?><span class="badge badge-warning"><? echo $row_skor['k9'];?></span><?
							}
							if($k9==1){
								?><span class="badge badge-important"><? echo $row_skor['k9'];?></span><?
							}
							if($k9==0){
								?><span class="badge"><? echo $row_skor['k9'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>10</td>
							<td>Guru menggunakan bahasa yang benar dan tepat dalam pembelajaran</td>
							<td>
							<?
							$k10 = $row_skor['k10'];
							if($k10>=3){
								?><span class="badge badge-success"><? echo $row_skor['k10'];?></span><?
							}
							if($k10==2){
								?><span class="badge badge-warning"><? echo $row_skor['k10'];?></span><?
							}
							if($k10==1){
								?><span class="badge badge-important"><? echo $row_skor['k10'];?></span><?
							}
							if($k10==0){
								?><span class="badge"><? echo $row_skor['k10'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>11</td>
							<td>Guru mengakhiri pembelajaran dengan efektif</td>
							<td>
							<?
							$k11 = $row_skor['k11'];
							if($k11>=3){
								?><span class="badge badge-success"><? echo $row_skor['k11'];?></span><?
							}
							if($k11==2){
								?><span class="badge badge-warning"><? echo $row_skor['k11'];?></span><?
							}
							if($k11==1){
								?><span class="badge badge-important"><? echo $row_skor['k11'];?></span><?
							}
							if($k11==0){
								?><span class="badge"><? echo $row_skor['k11'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><strong>Sub Total Nilai Kinerja Pelaksanaan Kegiatan Pembelajaran yang Aktif dan Efektif</strong></td>
							<td><span class="badge badge-info"><?echo $k5+$k6+$k7+$k8+$k9+$k10+$k11;?></span></td>
						</tr>
						<tr>
							<td colspan="3"><strong>III. PENILAIAN PEMBELAJARAN</strong></td>
						</tr>						
						<tr>
							<td>12</td>
							<td>Guru merancang alat evaluasi untuk mengukur kemajuan dan keberhasilan belajar peserta didik</td>
							<td>
							<?
							$k12 = $row_skor['k12'];
							if($k12>=3){
								?><span class="badge badge-success"><? echo $row_skor['k12'];?></span><?
							}
							if($k12==2){
								?><span class="badge badge-warning"><? echo $row_skor['k12'];?></span><?
							}
							if($k12==1){
								?><span class="badge badge-important"><? echo $row_skor['k12'];?></span><?
							}
							if($k12==0){
								?><span class="badge"><? echo $row_skor['k12'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>13</td>
							<td>Guru menggunakan berbagai strategi dan metode penilaian  untuk memantau kemajuan dan hasil belajar peserta didik dalam mencapai kompetensi tertentu sebagaimana yang tertulis dalam RPP</td>
							<td>
							<?
							$k13 = $row_skor['k13'];
							if($k13>=3){
								?><span class="badge badge-success"><? echo $row_skor['k13'];?></span><?
							}
							if($k13==2){
								?><span class="badge badge-warning"><? echo $row_skor['k13'];?></span><?
							}
							if($k13==1){
								?><span class="badge badge-important"><? echo $row_skor['k13'];?></span><?
							}
							if($k13==0){
								?><span class="badge"><? echo $row_skor['k13'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>14</td>
							<td>Guru memanfatkan berbagai  hasil penilaian untuk memberikan umpan balik bagi peserta didik tentang kemajuan belajarnya dan  bahan penyusunan rancangan pembelajaran selanjutnya</td>
							<td>
							<?
							$k14 = $row_skor['k14'];
							if($k14>=3){
								?><span class="badge badge-success"><? echo $row_skor['k14'];?></span><?
							}
							if($k14==2){
								?><span class="badge badge-warning"><? echo $row_skor['k14'];?></span><?
							}
							if($k14==1){
								?><span class="badge badge-important"><? echo $row_skor['k14'];?></span><?
							}
							if($k14==0){
								?><span class="badge"><? echo $row_skor['k14'];?></span><?
							}
							?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><strong>Sub Total Nilai Kinerja Penilaian Pembelajaran</strong></td>
							<td><span class="badge badge-info"><?echo $k12+$k13+$k14;?></span></td>
						</tr>
						<tr>
							<td colspan="2"><strong>JUMLAH (HASIL PENILAIAN KINERJA GURU)</strong></td>
							<td><span class="badge badge-info"><? echo $row_skor['total'];?></span></td>
						</tr>
						<tr>
							<td colspan="2"><strong>KONVERSI TOTAL NILAI KINERJA GURU KE SKALA 100 (PERMENNEG PAN RAN RB NO 16 TAHUN 2009, PASAL 15)</strong></td>
							<td><span class="badge badge-info"><? $total=($row_skor['total']/56)*100; echo number_format($total,2);?></span></td>
						</tr>
						<tr>
							<td colspan="2"><strong>KATEGORI NILAI KINERJA GURU</strong></td>
							<td>
								<span class="badge badge-info">
									<?
										if($total<=50)
											echo "KURANG";
										else if($total<=60)
											echo "SEDANG";
										else if($total<=75)
											echo "CUKUP";
										else if($total<=90)
											echo "BAIK";
										else
											echo "AMAT BAIK";
									?>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				*) Nilai diisi berdasarkan laporan dan evaluasi PK Guru. Nilai minimum per kompetensi = 1 dan nilai maksimum = 4.<br>
				*) Jika nilai masih 0, maka lakukan analisis nilai terlebih dahulu.
			</div>
            <div class="tab-pane fade" id="identitas">
            	<h2>Identitas</h2>
				<?
					$mysql=mysql_query("SELECT * FROM guru WHERE id='$id'");
					while($row=mysql_fetch_array($mysql)){
						$originalDate = $row['tanggal_lahir'];
						$newDate = date("d-m-Y", strtotime($originalDate));
				?>
				<table class="table table-striped" style="width:30%">
					<tr>
						<td>Nama</td>
						<td>: <? echo $row['nama'];?></td>
					</tr>
					<tr>
						<td>NIP</td>
						<td>: <? echo $row['nip'];?></td>
					</tr>
					<tr>
						<td>Tempat Lahir</td>
						<td>: <? echo $row['tempat_lahir'];?></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>: <? echo $newDate;?></td>
					</tr>
					<tr>
						<td>Pendidikan</td>
						<td>: <? echo $row['pendidikan'];}?></td>
					</tr>
				</table>
			</div>
			<div class="tab-pane fade" id="kompetensi">
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#kompetensi1" data-toggle="tab">Indikator 1</a></li>
					  <li class=""><a href="#kompetensi2" data-toggle="tab">Indikator 2</a></li>
					  <li class=""><a href="#kompetensi3" data-toggle="tab">Indikator 3</a></li>
					  <li class=""><a href="#kompetensi4" data-toggle="tab">Indikator 4</a></li>
					  <li class=""><a href="#kompetensi5" data-toggle="tab">Indikator 5</a></li>
					  <li class=""><a href="#kompetensi6" data-toggle="tab">Indikator 6</a></li>
					  <li class=""><a href="#kompetensi7" data-toggle="tab">Indikator 7</a></li>
					  <li class=""><a href="#kompetensi8" data-toggle="tab">Indikator 8</a></li>
					  <li class=""><a href="#kompetensi9" data-toggle="tab">Indikator 9</a></li>
					  <li class=""><a href="#kompetensi10" data-toggle="tab">Indikator 10</a></li>
					  <li class=""><a href="#kompetensi11" data-toggle="tab">Indikator 11</a></li>
					  <li class=""><a href="#kompetensi12" data-toggle="tab">Indikator 12</a></li>
					  <li class=""><a href="#kompetensi13" data-toggle="tab">Indikator 13</a></li>
					  <li class=""><a href="#kompetensi14" data-toggle="tab">Indikator 14</a></li>					  
					</ul>
					<div class="tab-content">
						<div class="tab-pane  active" id="kompetensi1">
							<h3>NILAI INDIKATOR 1</h3><br>
							<?
							$k1 = $row_skor['k1'];
							if($k1>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k1'];?></span><?
							}
							if($k1==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k1'];?></span><?
							}
							if($k1==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k1'];?></span><?
							}
							if($k1==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k1'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form1" action="proses_k1.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="3">1</td>
										<td rowspan="3">Guru memformulasikan tujuan  pembelajaran dalam RPP sesuai dengan kurikulum/silabus dan memperhatikan karakteristik peserta didik.</td>
										<td>Sebelum pengamatan:</td>
										<td>Tujuan pembelajaran dirumuskan  dan dikembangkan berdasarkan SK/KD yang akan dicapai.</td>
										<?
											$indikator_1 = mysql_query("SELECT * FROM indikator_1 WHERE id='$id'");
											$data1 = mysql_fetch_array($indikator_1);
											$i11 = $data1['k11'];
											$i12 = $data1['k12'];
											$i13 = $data1['k13'];
											$ket11 = $data1['ket11'];
											$ket12 = $data1['ket12'];
											$ket13 = $data1['ket13'];
											
											if($i11==1){
												echo"
												<td><input type=\"radio\" name=\"k11\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form1.ket11.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k11\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form1.ket11.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket11\" type=\"text\" name=\"ket11\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i11==0){
												echo"
												<td><input type=\"radio\" name=\"k11\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form1.ket11.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k11\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form1.ket11.disabled=false\" checked=\"\" title=\"$ket11\"></td>
												<td><input class=\"input-small\" id=\"ket11\" type=\"text\" name=\"ket11\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>										
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Tujuan pembelajaran memuat gambaran proses dan hasil belajar yang dapat dicapai oleh peserta didik sesuai dengan kebutuhan belajarnya</td>
										<?
											if($i12==1){
												echo"
												<td><input type=\"radio\" name=\"k12\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form1.ket12.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k12\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form1.ket12.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket12\" type=\"text\" name=\"ket12\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i12==0){
												echo"
												<td><input type=\"radio\" name=\"k12\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form1.ket12.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k12\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form1.ket12.disabled=false\" checked=\"\" title=\"$ket12\"></td>
												<td><input class=\"input-small\" id=\"ket12\" type=\"text\" name=\"ket12\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Tujuan pembelajaran disesuaikan dengan kebutuhan belajar peserta didik</td>
										<?
											if($i13==1){
												echo"
												<td><input type=\"radio\" name=\"k13\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form1.ket13.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k13\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form1.ket13.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket13\" type=\"text\" name=\"ket13\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i13==0){
												echo"
												<td><input type=\"radio\" name=\"k13\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form1.ket13.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k13\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form1.ket13.disabled=false\" checked=\"\" title=\"$ket13\"></td>
												<td><input class=\"input-small\" id=\"ket13\" type=\"text\" name=\"ket13\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>										
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi2">
							<h3>NILAI INDIKATOR 2</h3><br>
							<?
							$k2 = $row_skor['k2'];
							if($k2>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k2'];?></span><?
							}
							if($k2==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k2'];?></span><?
							}
							if($k2==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k2'];?></span><?
							}
							if($k2==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k2'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form2" action="proses_k2.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="4">2</td>
										<td rowspan="4">Guru menyusun  bahan ajar secara runtut, logis, kontekstual dan mutakhir.</td>										
										<td>Sebelum pengamatan:</td>
										<td> Bahan ajar disusun dari yang sederhana ke kompleks, mudah ke sulit dan/atau konkrit ke abstrak sesuai dengan tujuan pembelajaran</td>
										<?
											$indikator_2 = mysql_query("SELECT * FROM indikator_2 WHERE id='$id'");
											$data2 = mysql_fetch_array($indikator_2);
											$i21 = $data2['k21'];
											$i22 = $data2['k22'];
											$i23 = $data2['k23'];
											$i24 = $data2['k24'];
											$ket21 = $data2['ket21'];
											$ket22 = $data2['ket22'];
											$ket23 = $data2['ket23'];
											$ket24 = $data2['ket24'];
											
											if($i21==1){
												echo"
												<td><input type=\"radio\" name=\"k21\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket21.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k21\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket21.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket21\" type=\"text\" name=\"ket21\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i21==0){
												echo"
												<td><input type=\"radio\" name=\"k21\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket21.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k21\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket21.disabled=false\" checked=\"\" title=\"$ket21\"></td>
												<td><input class=\"input-small\" id=\"ket21\" type=\"text\" name=\"ket21\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td> Keluasan dan kedalaman bahan ajar disusun dengan memperhatikan potensi peserta didik (termasuk yang cepat dan lambat,motivasi tinggi dan rendah)</td>
										<?
											if($i22==1){
												echo"
												<td><input type=\"radio\" name=\"k22\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket22.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k22\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket22.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket22\" type=\"text\" name=\"ket22\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i22==0){
												echo"
												<td><input type=\"radio\" name=\"k22\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket22.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k22\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket22.disabled=false\" checked=\"\" title=\"$ket22\"></td>
												<td><input class=\"input-small\" id=\"ket22\" type=\"text\" name=\"ket22\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Bahan ajar dirancang sesuai dengan konteks kehidupan dan perkembangan Ilmu pengetahuan dan teknologi.</td>
										<?
											if($i23==1){
												echo"
												<td><input type=\"radio\" name=\"k23\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket23.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k23\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket23.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket23\" type=\"text\" name=\"ket23\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i23==0){
												echo"
												<td><input type=\"radio\" name=\"k23\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket23.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k23\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket23.disabled=false\" checked=\"\" title=\"$ket23\"></td>
												<td><input class=\"input-small\" id=\"ket23\" type=\"text\" name=\"ket23\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Bahan ajar dirancang dengan menggunakan sumber yang bervariasi (tidak hanya buku pegangan peserta didik)</td>
										<?
											if($i24==1){
												echo"
												<td><input type=\"radio\" name=\"k24\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket24.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k24\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket24.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket24\" type=\"text\" name=\"ket24\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i24==0){
												echo"
												<td><input type=\"radio\" name=\"k24\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form2.ket24.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k24\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form2.ket24.disabled=false\" checked=\"\" title=\"$ket24\"></td>
												<td><input class=\"input-small\" id=\"ket24\" type=\"text\" name=\"ket24\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi3">
							<h3>NILAI INDIKATOR 3</h3><br>
							<?
							$k3 = $row_skor['k3'];
							if($k3>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k3'];?></span><?
							}
							if($k3==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k3'];?></span><?
							}
							if($k3==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k3'];?></span><?
							}
							if($k3==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k3'];?></span><?
							}
							?>
							<table class="table table-striped">
							<thead>
								<tr>
									<th rowspan="2">NO</th>
									<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
									<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
									<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
									<th colspan="2">PENILAIAN</th>
								</tr>
								<tr>
									<th>YA</th>
									<th>TIDAK</th>
									<th>KETERANGAN</th>
								</tr>
							</thead>
							<tbody>
								<form name="form3" action="proses_k3.php" method="post">
								<input type="hidden" name="id" id="id" value="<? echo $id;?>">
								<tr>
									<td rowspan="4">3</td>
									<td rowspan="4">Guru merencanakan kegiatan pembelajaran yang efektif</td>
									<td>Sebelum pengamatan:</td>
									<td>Strategi, pendekatan, dan metode pembelajaran relevan untuk mencapai tujuan pembelajaran yang ingin dicapai /kompetensi harus dikuasai peserta didik.</td>
									<?
											$indikator_3 = mysql_query("SELECT * FROM indikator_3 WHERE id='$id'");
											$data3 = mysql_fetch_array($indikator_3);
											$i31 = $data3['k31'];
											$i32 = $data3['k32'];
											$i33 = $data3['k33'];
											$i34 = $data3['k34'];
											$ket31 = $data3['ket31'];
											$ket32 = $data3['ket32'];
											$ket33 = $data3['ket33'];
											$ket34 = $data3['ket34'];
											
											if($i31==1){
												echo"
												<td><input type=\"radio\" name=\"k31\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket31.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k31\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket31.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket31\" type=\"text\" name=\"ket31\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i31==0){
												echo"
												<td><input type=\"radio\" name=\"k31\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket31.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k31\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket31.disabled=false\" checked=\"\" title=\"$ket31\"></td>
												<td><input class=\"input-small\" id=\"ket31\" type=\"text\" name=\"ket31\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
								</tr>
								<tr>
									<td>Selama pengamatan:</td>
									<td>Strategi dan metode pembelajaran yang dipilih dapat memudahkan pemahaman peserta didik</td>
									<?
											if($i32==1){
												echo"
												<td><input type=\"radio\" name=\"k32\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket32.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k32\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket32.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket32\" type=\"text\" name=\"ket32\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i32==0){
												echo"
												<td><input type=\"radio\" name=\"k32\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket32.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k32\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket32.disabled=false\" checked=\"\" title=\"$ket32\"></td>
												<td><input class=\"input-small\" id=\"ket32\" type=\"text\" name=\"ket32\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
								</tr>
								<tr>
									<td></td>
									<td>Strategi dan metode pembelajaran yang dipilih sesuai dengan tingkat perkembangan kognitif, afektif, dan psikomotor peserta didik.</td>
									<?
											if($i33==1){
												echo"
												<td><input type=\"radio\" name=\"k33\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket33.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k33\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket33.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket33\" type=\"text\" name=\"ket33\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i33==0){
												echo"
												<td><input type=\"radio\" name=\"k33\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket33.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k33\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket33.disabled=false\" checked=\"\" title=\"$ket33\"></td>
												<td><input class=\"input-small\" id=\"ket33\" type=\"text\" name=\"ket33\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
								</tr>
								<tr>
									<td>Setelah pengamatan:</td>
									<td>Setiap tahapan pembelajaran diberi alokasi waktu secara proporsional dengan memperhatikan tingkat kompleksitas materi dan/atau kebutuhan belajar  peserta didik.</td>
									<?
											if($i34==1){
												echo"
												<td><input type=\"radio\" name=\"k34\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket34.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k34\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket34.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket34\" type=\"text\" name=\"ket34\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i34==0){
												echo"
												<td><input type=\"radio\" name=\"k34\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form3.ket34.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k34\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form3.ket34.disabled=false\" checked=\"\" title=\"$ket34\"></td>
												<td><input class=\"input-small\" id=\"ket34\" type=\"text\" name=\"ket34\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
								</tr>
								<tr>
									<td colspan="6"></td>
									<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
								</tr>
								</form>
							</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi4">
							<h3>NILAI INDIKATOR 4</h3><br>
							<?
							$k4 = $row_skor['k4'];
							if($k4>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k4'];?></span><?
							}
							if($k4==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k4'];?></span><?
							}
							if($k4==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k4'];?></span><?
							}
							if($k4==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k4'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form4" action="proses_k4.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="3">4</td>
										<td rowspan="3">Guru memilih sumber belajar/ media pembelajaran sesuai dengan materi dan strategi pembelajaran.</td>
										<td>Sebelum pengamatan:</td>
										<td>Sumber belajar/media pembelajaran yang dipilih dapat dipakai untuk mencapai tujuan pembelajaran atau kompetensi yang ingin dicapai (misalnya buku, modul untuk kompetensi kognitif; media audio visual, Komputer untuk kompetensi keterampilan).</td>
										<?
											$indikator_4 = mysql_query("SELECT * FROM indikator_4 WHERE id='$id'");
											$data4 = mysql_fetch_array($indikator_4);
											$i41 = $data4['k41'];
											$i42 = $data4['k42'];
											$i43 = $data4['k43'];
											$ket41 = $data4['ket41'];
											$ket42 = $data4['ket42'];
											$ket43 = $data4['ket43'];
											
											if($i41==1){
												echo"
												<td><input type=\"radio\" name=\"k41\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form4.ket41.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k41\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form4.ket41.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket41\" type=\"text\" name=\"ket41\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i41==0){
												echo"
												<td><input type=\"radio\" name=\"k41\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form4.ket41.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k41\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form4.ket41.disabled=false\" checked=\"\" title=\"$ket41\"></td>
												<td><input class=\"input-small\" id=\"ket41\" type=\"text\" name=\"ket41\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Sumber belajar/media pembelajaran termasuk TIK yang dipilih dapat memudahkan pemahaman peserta didik (misalnya lidi/sempoa digunakan untuk operasi hitung matematika, lampu senter, globe, dan bola untuk mengilustrasikan proses terjadinya gerhana).</td>
										<?
											if($i42==1){
												echo"
												<td><input type=\"radio\" name=\"k42\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form4.ket42.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k42\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form4.ket42.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket42\" type=\"text\" name=\"ket42\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i42==0){
												echo"
												<td><input type=\"radio\" name=\"k42\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form4.ket42.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k42\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form4.ket42.disabled=false\" checked=\"\" title=\"$ket42\"></td>
												<td><input class=\"input-small\" id=\"ket42\" type=\"text\" name=\"ket42\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Sumber belajar/media pembelajaran yang dipilih sesuai dengan tingkat perkembangan kognitif, afektif, dan psikomotor peserta didik.</td>
										<?
											if($i43==1){
												echo"
												<td><input type=\"radio\" name=\"k43\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form4.ket43.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k43\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form4.ket43.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket43\" type=\"text\" name=\"ket43\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i43==0){
												echo"
												<td><input type=\"radio\" name=\"k43\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form4.ket43.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k43\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form4.ket43.disabled=false\" checked=\"\" title=\"$ket43\"></td>
												<td><input class=\"input-small\" id=\"ket43\" type=\"text\" name=\"ket43\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi5">
							<h3>NILAI INDIKATOR 5</h3><br>
							<?
							$k5 = $row_skor['k5'];
							if($k5>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k5'];?></span><?
							}
							if($k5==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k5'];?></span><?
							}
							if($k5==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k5'];?></span><?
							}
							if($k5==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k5'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form5" action="proses_k5.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="2">5</td>
										<td rowspan="2">Guru memulai pembelajaran dengan efektif</td>
										<td>Sebelum pengamatan:</td>
										<td>Melakukan apersepsi</td>
										<?
											$indikator_5 = mysql_query("SELECT * FROM indikator_5 WHERE id='$id'");
											$data5 = mysql_fetch_array($indikator_5);
											$i51 = $data5['k51'];
											$i52 = $data5['k52'];
											$ket51 = $data5['ket51'];
											$ket52 = $data5['ket52'];											
											
											if($i51==1){
												echo"
												<td><input type=\"radio\" name=\"k51\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form5.ket51.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k51\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form5.ket51.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket51\" type=\"text\" name=\"ket51\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i51==0){
												echo"
												<td><input type=\"radio\" name=\"k51\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form5.ket51.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k51\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form5.ket51.disabled=false\" checked=\"\" title=\"$ket51\"></td>
												<td><input class=\"input-small\" id=\"ket51\" type=\"text\" name=\"ket51\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:<br/>Setelah pengamatan:</td>
										<td>Menyampaikan kompetensi yang akan dicapai dalam rencana kegiatan</td>
										<?
											if($i52==1){
												echo"
												<td><input type=\"radio\" name=\"k52\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form5.ket52.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k52\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form5.ket52.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket52\" type=\"text\" name=\"ket52\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i52==0){
												echo"
												<td><input type=\"radio\" name=\"k52\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form5.ket52.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k52\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form5.ket52.disabled=false\" checked=\"\" title=\"$ket52\"></td>
												<td><input class=\"input-small\" id=\"ket52\" type=\"text\" name=\"ket52\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi6">
							<h3>NILAI INDIKATOR 6</h3><br>
							<?
							$k6 = $row_skor['k6'];
							if($k6>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k6'];?></span><?
							}
							if($k6==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k6'];?></span><?
							}
							if($k6==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k6'];?></span><?
							}
							if($k6==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k6'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form6" action="proses_k6.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="4">6</td>
										<td rowspan="4">Guru menguasai materi pelajaran</td>
										<td>Sebelum pengamatan:</td>
										<td>Kemampuan menyesuiakan materi dengan tujuan pembelajaran.</td>
										<?
											$indikator_6 = mysql_query("SELECT * FROM indikator_6 WHERE id='$id'");
											$data6 = mysql_fetch_array($indikator_6);
											$i61 = $data6['k61'];
											$i62 = $data6['k62'];
											$i63 = $data6['k63'];
											$i64 = $data6['k64'];
											$ket61 = $data6['ket61'];
											$ket62 = $data6['ket62'];
											$ket63 = $data6['ket63'];
											$ket64 = $data6['ket64'];
											
											if($i61==1){
												echo"
												<td><input type=\"radio\" name=\"k61\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket61.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k61\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket61.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket61\" type=\"text\" name=\"ket61\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i61==0){
												echo"
												<td><input type=\"radio\" name=\"k61\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket61.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k61\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket61.disabled=false\" checked=\"\" title=\"$ket61\"></td>
												<td><input class=\"input-small\" id=\"ket61\" type=\"text\" name=\"ket61\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Kemampuan mengkaitkan materi dengan pengetahuan lain yang relevan,  perkembangan Iptek , dan kehidupan nyata.</td>
										<?
											if($i62==1){
												echo"
												<td><input type=\"radio\" name=\"k62\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket62.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k62\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket62.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket62\" type=\"text\" name=\"ket62\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i62==0){
												echo"
												<td><input type=\"radio\" name=\"k62\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket62.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k62\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket62.disabled=false\" checked=\"\" title=\"$ket62\"></td>
												<td><input class=\"input-small\" id=\"ket62\" type=\"text\" name=\"ket62\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td> Tingkat ketepatan pembahasan dengan materi pembelajaran.</td>
										<?
											if($i63==1){
												echo"
												<td><input type=\"radio\" name=\"k63\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket63.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k63\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket63.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket63\" type=\"text\" name=\"ket63\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i63==0){
												echo"
												<td><input type=\"radio\" name=\"k63\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket63.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k63\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket63.disabled=false\" checked=\"\" title=\"$ket63\"></td>
												<td><input class=\"input-small\" id=\"ket63\" type=\"text\" name=\"ket63\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Kemampuan menyajikan materi secara sistematis  (mudah ke sulit, dari konkrit ke abstrak)</td>
										<?
											if($i64==1){
												echo"
												<td><input type=\"radio\" name=\"k64\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket64.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k64\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket64.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket64\" type=\"text\" name=\"ket64\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i64==0){
												echo"
												<td><input type=\"radio\" name=\"k64\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form6.ket64.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k64\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form6.ket64.disabled=false\" checked=\"\" title=\"$ket64\"></td>
												<td><input class=\"input-small\" id=\"ket64\" type=\"text\" name=\"ket64\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi7">
							<h3>NILAI INDIKATOR 7</h3><br>
							<?
							$k7 = $row_skor['k7'];
							if($k7>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k7'];?></span><?
							}
							if($k7==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k7'];?></span><?
							}
							if($k7==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k7'];?></span><?
							}
							if($k7==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k7'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form7" action="proses_k7.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="6">7</td>
										<td rowspan="6">Guru menerapkan pendekatan/strategi pembelajaran yang efektif</td>
										<td>Sebelum pengamatan:</td>
										<td> Melaksanakan pembelajaran sesuai dengan kompetensi yang akan dicapai</td>
										<?
											$indikator_7 = mysql_query("SELECT * FROM indikator_7 WHERE id='$id'");
											$data7 = mysql_fetch_array($indikator_7);
											$i71 = $data7['k71'];
											$i72 = $data7['k72'];
											$i73 = $data7['k73'];
											$i74 = $data7['k74'];
											$i75 = $data7['k75'];
											$i76 = $data7['k76'];
											$ket71 = $data7['ket71'];
											$ket72 = $data7['ket72'];
											$ket73 = $data7['ket73'];
											$ket74 = $data7['ket74'];
											$ket75 = $data7['ket75'];
											$ket76 = $data7['ket76'];
											
											if($i71==1){
												echo"
												<td><input type=\"radio\" name=\"k71\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket71.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k71\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket71.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket71\" type=\"text\" name=\"ket71\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i71==0){
												echo"
												<td><input type=\"radio\" name=\"k71\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket71.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k71\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket71.disabled=false\" checked=\"\" title=\"$ket71\"></td>
												<td><input class=\"input-small\" id=\"ket71\" type=\"text\" name=\"ket71\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Melaksanakan pembelajaran secara runtut</td>
										<?
											if($i72==1){
												echo"
												<td><input type=\"radio\" name=\"k72\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket72.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k72\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket72.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket72\" type=\"text\" name=\"ket72\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i72==0){
												echo"
												<td><input type=\"radio\" name=\"k72\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket72.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k72\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket72.disabled=false\" checked=\"\" title=\"$ket72\"></td>
												<td><input class=\"input-small\" id=\"ket72\" type=\"text\" name=\"ket72\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Menguasai kelas</td>
										<?
											if($i73==1){
												echo"
												<td><input type=\"radio\" name=\"k73\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket73.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k73\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket73.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket73\" type=\"text\" name=\"ket73\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i73==0){
												echo"
												<td><input type=\"radio\" name=\"k73\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket73.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k73\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket73.disabled=false\" checked=\"\" title=\"$ket73\"></td>
												<td><input class=\"input-small\" id=\"ket73\" type=\"text\" name=\"ket73\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Melaksanakan pembelajaran yang bersifat kontekstual</td>
										<?
											if($i74==1){
												echo"
												<td><input type=\"radio\" name=\"k74\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket74.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k74\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket74.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket74\" type=\"text\" name=\"ket74\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i74==0){
												echo"
												<td><input type=\"radio\" name=\"k74\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket74.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k74\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket74.disabled=false\" checked=\"\" title=\"$ket74\"></td>
												<td><input class=\"input-small\" id=\"ket74\" type=\"text\" name=\"ket74\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Melaksanakan pembelajaran yang memungkinkan tumbuhnya kebiasaan positif (nurturant effect)</td>
										<?
											if($i75==1){
												echo"
												<td><input type=\"radio\" name=\"k75\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket75.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k75\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket75.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket75\" type=\"text\" name=\"ket75\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i75==0){
												echo"
												<td><input type=\"radio\" name=\"k75\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket75.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k75\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket75.disabled=false\" checked=\"\" title=\"$ket75\"></td>
												<td><input class=\"input-small\" id=\"ket75\" type=\"text\" name=\"ket75\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Melaksanakan pembelajaran sesuai dengan alokasi waktu yang direncanakan</td>
										<?
											if($i76==1){
												echo"
												<td><input type=\"radio\" name=\"k76\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket76.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k76\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket76.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket76\" type=\"text\" name=\"ket76\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i76==0){
												echo"
												<td><input type=\"radio\" name=\"k76\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form7.ket76.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k76\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form7.ket76.disabled=false\" checked=\"\" title=\"$ket76\"></td>
												<td><input class=\"input-small\" id=\"ket76\" type=\"text\" name=\"ket76\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi8">
							<h3>NILAI INDIKATOR 8</h3><br>
							<?
							$k8 = $row_skor['k8'];
							if($k8>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k8'];?></span><?
							}
							if($k8==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k8'];?></span><?
							}
							if($k8==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k8'];?></span><?
							}
							if($k8==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k8'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form8" action="proses_k8.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="3">8</td>
										<td rowspan="3">Guru memanfaatan sumber belajar/media dalam pembelajaran</td>
										<td>Sebelum pengamatan:</td>
										<td>Menunjukkan keterampilan dalam penggunaan sumber belajar/media pembelajaran</td>
										<?
											$indikator_8 = mysql_query("SELECT * FROM indikator_8 WHERE id='$id'");
											$data8 = mysql_fetch_array($indikator_8);
											$i81 = $data8['k81'];
											$i82 = $data8['k82'];
											$i83 = $data8['k83'];
											$ket81 = $data8['ket81'];
											$ket82 = $data8['ket82'];
											$ket83 = $data8['ket83'];
											
											if($i81==1){
												echo"
												<td><input type=\"radio\" name=\"k81\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form8.ket81.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k81\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form8.ket81.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket81\" type=\"text\" name=\"ket81\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i81==0){
												echo"
												<td><input type=\"radio\" name=\"k81\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form8.ket81.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k81\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form8.ket81.disabled=false\" checked=\"\" title=\"$ket81\"></td>
												<td><input class=\"input-small\" id=\"ket81\" type=\"text\" name=\"ket81\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Menghasilkan pesan yang menarik</td>
										<?
											if($i82==1){
												echo"
												<td><input type=\"radio\" name=\"k82\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form8.ket82.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k82\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form8.ket82.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket82\" type=\"text\" name=\"ket82\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i82==0){
												echo"
												<td><input type=\"radio\" name=\"k82\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form8.ket82.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k82\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form8.ket82.disabled=false\" checked=\"\" title=\"$ket82\"></td>
												<td><input class=\"input-small\" id=\"ket82\" type=\"text\" name=\"ket82\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Melibatkan siswa dalam pembuatan dan pemanfaatan sumber belajar/media pembelajaran</td>
										<?
											if($i83==1){
												echo"
												<td><input type=\"radio\" name=\"k83\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form8.ket83.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k83\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form8.ket83.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket83\" type=\"text\" name=\"ket83\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i83==0){
												echo"
												<td><input type=\"radio\" name=\"k83\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form8.ket83.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k83\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form8.ket83.disabled=false\" checked=\"\" title=\"$ket83\"></td>
												<td><input class=\"input-small\" id=\"ket83\" type=\"text\" name=\"ket83\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi9">
							<h3>NILAI INDIKATOR 9</h3><br>
							<?
							$k9 = $row_skor['k9'];
							if($k9>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k9'];?></span><?
							}
							if($k9==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k9'];?></span><?
							}
							if($k9==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k9'];?></span><?
							}
							if($k9==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k9'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form9" action="proses_k9.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="5">9</td>
										<td rowspan="5">Guru memicu dan/atau memelihara keterlibatan siswa dalam pembelajaran</td>
										<td>Sebelum pengamatan:</td>
										<td> Menumbuhkan partisipasi aktif siswa melalui interaksi guru, siswa, sumber belajar</td>
										<?
											$indikator_9 = mysql_query("SELECT * FROM indikator_9 WHERE id='$id'");
											$data9 = mysql_fetch_array($indikator_9);
											$i91 = $data9['k91'];
											$i92 = $data9['k92'];
											$i93 = $data9['k93'];
											$i94 = $data9['k94'];
											$i95 = $data9['k95'];
											$ket91 = $data9['ket91'];
											$ket92 = $data9['ket92'];
											$ket93 = $data9['ket93'];
											$ket94 = $data9['ket94'];
											$ket95 = $data9['ket95'];
											
											if($i91==1){
												echo"
												<td><input type=\"radio\" name=\"k91\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket91.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k91\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket91.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket91\" type=\"text\" name=\"ket91\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i91==0){
												echo"
												<td><input type=\"radio\" name=\"k91\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket91.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k91\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket91.disabled=false\" checked=\"\" title=\"$ket91\"></td>
												<td><input class=\"input-small\" id=\"ket91\" type=\"text\" name=\"ket91\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Merespon positif partisipasi siswa</td>
										<?
											if($i92==1){
												echo"
												<td><input type=\"radio\" name=\"k92\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket92.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k92\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket92.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket92\" type=\"text\" name=\"ket92\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i92==0){
												echo"
												<td><input type=\"radio\" name=\"k92\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket92.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k92\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket92.disabled=false\" checked=\"\" title=\"$ket92\"></td>
												<td><input class=\"input-small\" id=\"ket92\" type=\"text\" name=\"ket92\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Menunjukkan sikap terbuka terhadap respons siswa</td>
										<?
											if($i93==1){
												echo"
												<td><input type=\"radio\" name=\"k93\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket93.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k93\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket93.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket93\" type=\"text\" name=\"ket93\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i93==0){
												echo"
												<td><input type=\"radio\" name=\"k93\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket93.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k93\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket93.disabled=false\" checked=\"\" title=\"$ket93\"></td>
												<td><input class=\"input-small\" id=\"ket93\" type=\"text\" name=\"ket93\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Menunjukkan hubungan antar pribadi yang kondusif</td>
										<?
											if($i94==1){
												echo"
												<td><input type=\"radio\" name=\"k94\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket94.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k94\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket94.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket94\" type=\"text\" name=\"ket94\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i94==0){
												echo"
												<td><input type=\"radio\" name=\"k94\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket94.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k94\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket94.disabled=false\" checked=\"\" title=\"$ket94\"></td>
												<td><input class=\"input-small\" id=\"ket94\" type=\"text\" name=\"ket94\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Menumbuhkan keceriaan dan antusisme siswa dalam belajar</td>
										<?
											if($i95==1){
												echo"
												<td><input type=\"radio\" name=\"k95\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket95.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k95\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket95.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket95\" type=\"text\" name=\"ket95\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i95==0){
												echo"
												<td><input type=\"radio\" name=\"k95\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form9.ket95.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k95\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form9.ket95.disabled=false\" checked=\"\" title=\"$ket95\"></td>
												<td><input class=\"input-small\" id=\"ket95\" type=\"text\" name=\"ket95\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi10">
							<h3>NILAI INDIKATOR 10</h3><br>
							<?
							$k10 = $row_skor['k10'];
							if($k10>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k10'];?></span><?
							}
							if($k10==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k10'];?></span><?
							}
							if($k10==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k10'];?></span><?
							}
							if($k10==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k10'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form10" action="proses_k10.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="3">10</td>
										<td rowspan="3">Guru menggunakan bahasa yang benar dan tepat dalam pembelajaran</td>
										<td>Sebelum pengamatan:</td>
										<td>Menggunakan bahasa lisan secara jelas dan lancar</td>
										<?
											$indikator_10 = mysql_query("SELECT * FROM indikator_10 WHERE id='$id'");
											$data10 = mysql_fetch_array($indikator_10);
											$i101 = $data10['k101'];
											$i102 = $data10['k102'];
											$i103 = $data10['k103'];
											$ket101 = $data10['ket101'];
											$ket102 = $data10['ket102'];
											$ket103 = $data10['ket103'];
											
											if($i101==1){
												echo"
												<td><input type=\"radio\" name=\"k101\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form10.ket101.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k101\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form10.ket101.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket101\" type=\"text\" name=\"ket101\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i101==0){
												echo"
												<td><input type=\"radio\" name=\"k101\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form10.ket101.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k101\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form10.ket101.disabled=false\" checked=\"\" title=\"$ket101\"></td>
												<td><input class=\"input-small\" id=\"ket101\" type=\"text\" name=\"ket101\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Menggunakan bahasa tulis yang baik dan benar</td>
										<?
											if($i102==1){
												echo"
												<td><input type=\"radio\" name=\"k102\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form10.ket102.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k102\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form10.ket102.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket102\" type=\"text\" name=\"ket102\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i102==0){
												echo"
												<td><input type=\"radio\" name=\"k102\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form10.ket102.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k102\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form10.ket102.disabled=false\" checked=\"\" title=\"$ket102\"></td>
												<td><input class=\"input-small\" id=\"ket102\" type=\"text\" name=\"ket102\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Menyampaikan pesan dengan gaya yang sesuai</td>
										<?
											if($i103==1){
												echo"
												<td><input type=\"radio\" name=\"k103\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form10.ket103.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k103\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form10.ket103.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket103\" type=\"text\" name=\"ket103\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i103==0){
												echo"
												<td><input type=\"radio\" name=\"k103\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form10.ket103.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k103\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form10.ket103.disabled=false\" checked=\"\" title=\"$ket103\"></td>
												<td><input class=\"input-small\" id=\"ket103\" type=\"text\" name=\"ket103\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi11">
							<h3>NILAI INDIKATOR 11</h3><br>
							<?
							$k11 = $row_skor['k11'];
							if($k11>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k11'];?></span><?
							}
							if($k11==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k11'];?></span><?
							}
							if($k11==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k11'];?></span><?
							}
							if($k11==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k11'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form11" action="proses_k11.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="2">11</td>
										<td rowspan="2">Guru mengakhiri pembelajaran dengan efektif</td>
										<td>Sebelum pengamatan:<br/>Setelah pengamatan:</td>
										<td>Melakukan refleksi atau membuat rangkuman dengan melibatkan siswa</td>
										<?
											$indikator_11 = mysql_query("SELECT * FROM indikator_11 WHERE id='$id'");
											$data11 = mysql_fetch_array($indikator_11);
											$i111 = $data11['k111'];
											$i112 = $data11['k112'];
											$ket111 = $data11['ket111'];
											$ket112 = $data11['ket112'];
											
											if($i111==1){
												echo"
												<td><input type=\"radio\" name=\"k111\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form11.ket111.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k111\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form11.ket111.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket111\" type=\"text\" name=\"ket111\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i111==0){
												echo"
												<td><input type=\"radio\" name=\"k111\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form11.ket111.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k111\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form11.ket111.disabled=false\" checked=\"\" title=\"$ket111\"></td>
												<td><input class=\"input-small\" id=\"ket111\" type=\"text\" name=\"ket111\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td> Melaksanakan tindak lanjut dengan memberikan arahan, atau kegiatan, atau tugas sebagai bagian remidi/pengayaan</td>
										<?
											if($i112==1){
												echo"
												<td><input type=\"radio\" name=\"k112\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form11.ket112.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k112\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form11.ket112.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket112\" type=\"text\" name=\"ket112\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i112==0){
												echo"
												<td><input type=\"radio\" name=\"k112\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form11.ket112.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k112\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form11.ket112.disabled=false\" checked=\"\" title=\"$ket112\"></td>
												<td><input class=\"input-small\" id=\"ket112\" type=\"text\" name=\"ket112\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi12">
							<h3>NILAI INDIKATOR 12</h3><br>
							<?
							$k12 = $row_skor['k12'];
							if($k12>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k12'];?></span><?
							}
							if($k12==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k12'];?></span><?
							}
							if($k12==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k12'];?></span><?
							}
							if($k12==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k12'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form12" action="proses_k12.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="4">12</td>
										<td rowspan="4">Guru merancang alat evaluasi untuk mengukur kemajuan dan keberhasilan belajar peserta didik</td>
										<td>Sebelum pengamatan:</td>
										<td> Kesesuaian teknik dan jenis penilaian (tes lisan, tes tertulis, tes perbuatan) sesuai dengan tujuan pembelajaran.</td>
										<?
											$indikator_12 = mysql_query("SELECT * FROM indikator_12 WHERE id='$id'");
											$data12 = mysql_fetch_array($indikator_12);
											$i121 = $data12['k121'];
											$i122 = $data12['k122'];
											$i123 = $data12['k123'];
											$i124 = $data12['k124'];
											$ket121 = $data12['ket121'];
											$ket122 = $data12['ket122'];
											$ket123 = $data12['ket123'];
											$ket124 = $data12['ket124'];
											
											if($i121==1){
												echo"
												<td><input type=\"radio\" name=\"k121\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket121.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k121\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket121.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket121\" type=\"text\" name=\"ket121\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i121==0){
												echo"
												<td><input type=\"radio\" name=\"k121\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket121.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k121\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket121.disabled=false\" checked=\"\" title=\"$ket121\"></td>
												<td><input class=\"input-small\" id=\"ket121\" type=\"text\" name=\"ket121\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Alat tes dirancang untuk dapat mengukur kemajuan belajar peserta didik dari aspek kognitif, afektif dan/atau psikomotorik.</td>
										<?
											if($i122==1){
												echo"
												<td><input type=\"radio\" name=\"k122\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket122.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k122\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket122.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket122\" type=\"text\" name=\"ket122\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i122==0){
												echo"
												<td><input type=\"radio\" name=\"k122\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket122.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k122\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket122.disabled=false\" checked=\"\" title=\"$ket122\"></td>
												<td><input class=\"input-small\" id=\"ket122\" type=\"text\" name=\"ket122\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Rancangan penilaian portofolio peserta didik minimal 1 kali per semester.</td>
										<?
											if($i123==1){
												echo"
												<td><input type=\"radio\" name=\"k123\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket123.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k123\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket123.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket123\" type=\"text\" name=\"ket123\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i123==0){
												echo"
												<td><input type=\"radio\" name=\"k123\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket123.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k123\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket123.disabled=false\" checked=\"\" title=\"$ket123\"></td>
												<td><input class=\"input-small\" id=\"ket123\" type=\"text\" name=\"ket123\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Hasil analisis penilaian sebelumnya (UH, UAS, UN) digunakan  untuk keperluan program perbaikan (remedial,  pengayaan, dan/atau menyempurnakan rancangan dan/atau pelaksanaan pembelajaran)</td>
										<?
											if($i124==1){
												echo"
												<td><input type=\"radio\" name=\"k124\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket124.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k124\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket124.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket124\" type=\"text\" name=\"ket124\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i124==0){
												echo"
												<td><input type=\"radio\" name=\"k124\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form12.ket124.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k124\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form12.ket124.disabled=false\" checked=\"\" title=\"$ket124\"></td>
												<td><input class=\"input-small\" id=\"ket124\" type=\"text\" name=\"ket124\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi13">
							<h3>NILAI INDIKATOR 13</h3><br>
							<?
							$k13 = $row_skor['k13'];
							if($k13>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k13'];?></span><?
							}
							if($k13==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k13'];?></span><?
							}
							if($k13==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k13'];?></span><?
							}
							if($k13==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k13'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form13" action="proses_k13.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="4">13</td>
										<td rowspan="4">Guru menggunakan berbagai strategi dan metode penilaian  untuk memantau kemajuan dan hasil belajar peserta didik dalam mencapai kompetensi tertentu sebagaimana yang tertulis dalam RPP.</td>
										<td>Sebelum pengamatan:</td>
										<td>Menggunakan teknik penilaian otentik (kuis, pertanyaan lisan, pemberian tugas, dsb.) untuk memantau kemajuan belajar peserta didik.</td>
										<?
											$indikator_13 = mysql_query("SELECT * FROM indikator_13 WHERE id='$id'");
											$data13 = mysql_fetch_array($indikator_13);
											$i131 = $data13['k131'];
											$i132 = $data13['k132'];
											$i133 = $data13['k133'];
											$i134 = $data13['k134'];
											$ket131 = $data13['ket131'];
											$ket132 = $data13['ket132'];
											$ket133 = $data13['ket133'];
											$ket134 = $data13['ket134'];
											
											if($i131==1){
												echo"
												<td><input type=\"radio\" name=\"k131\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket131.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k131\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket131.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket131\" type=\"text\" name=\"ket131\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i131==0){
												echo"
												<td><input type=\"radio\" name=\"k131\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket131.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k131\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket131.disabled=false\" checked=\"\" title=\"$ket131\"></td>
												<td><input class=\"input-small\" id=\"ket131\" type=\"text\" name=\"ket131\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Menggunakan teknik penilaian (ulangan harian, tengah semester, dan ulangan semester) disusun untuk mengukur hasil belajar peserta didik dalam aspek kognitif, afektif dan/atau psikomotor.</td>
										<?
											if($i132==1){
												echo"
												<td><input type=\"radio\" name=\"k132\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket132.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k132\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket132.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket132\" type=\"text\" name=\"ket132\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i132==0){
												echo"
												<td><input type=\"radio\" name=\"k132\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket132.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k132\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket132.disabled=false\" checked=\"\" title=\"$ket132\"></td>
												<td><input class=\"input-small\" id=\"ket132\" type=\"text\" name=\"ket132\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Menerapkan penilaian portofolio dalam bentuk berbagai tugas terstruktur</td>
										<?
											if($i133==1){
												echo"
												<td><input type=\"radio\" name=\"k133\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket133.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k133\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket133.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket133\" type=\"text\" name=\"ket133\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i133==0){
												echo"
												<td><input type=\"radio\" name=\"k133\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket133.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k133\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket133.disabled=false\" checked=\"\" title=\"$ket133\"></td>
												<td><input class=\"input-small\" id=\"ket133\" type=\"text\" name=\"ket133\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td>Menggunakan alat penilaian yang sesuai dengan tujuan pembelajaran dan materi ajar sebagaimana disusun dalam RPP.</td>
										<?
											if($i134==1){
												echo"
												<td><input type=\"radio\" name=\"k134\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket134.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k134\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket134.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket134\" type=\"text\" name=\"ket134\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i134==0){
												echo"
												<td><input type=\"radio\" name=\"k134\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form13.ket134.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k134\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form13.ket134.disabled=false\" checked=\"\" title=\"$ket134\"></td>
												<td><input class=\"input-small\" id=\"ket134\" type=\"text\" name=\"ket134\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="kompetensi14">
							<h3>NILAI INDIKATOR 14</h3><br>
							<?
							$k14 = $row_skor['k14'];
							if($k14>=3){
								?><span class="badge badge-success" style="font-size:20px;"><? echo $row_skor['k14'];?></span><?
							}
							if($k14==2){
								?><span class="badge badge-warning" style="font-size:20px;"><? echo $row_skor['k14'];?></span><?
							}
							if($k14==1){
								?><span class="badge badge-important" style="font-size:20px;"><? echo $row_skor['k14'];?></span><?
							}
							if($k14==0){
								?><span class="badge" style="font-size:20px;"><? echo $row_skor['k14'];?></span><?
							}
							?>
							<table class="table table-striped">
								<thead>
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">TUGAS UTAMA / INDIKATOR KINERJA GURU</th>
										<th rowspan="2">HASIL ANALISIS DAN CATATAN HASIL PENGAMATAN</th>
										<th rowspan="2">BUTIR PENILAIAN INDIKATOR KINERJA GURU </th>
										<th colspan="2">PENILAIAN</th>
									</tr>
									<tr>
										<th>YA</th>
										<th>TIDAK</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<form name="form14" action="proses_k14.php" method="post">
									<input type="hidden" name="id" id="id" value="<? echo $id;?>">
									<tr>
										<td rowspan="4">14</td>
										<td rowspan="4">Guru memanfatkan berbagai  hasil penilaian untuk memberikan umpan balik bagi peserta didik tentang kemajuan belajarnya dan  bahan penyusunan rancangan pembelajaran selanjutnya</td>
										<td>Sebelum pengamatan:</td>
										<td>Menggunakan hasil analisis penilaian untuk mengidentifikasi topik/kompetensi dasar yang mudah, sedang dan sulit sehingga diketahui kekuatan dan kelemahan masing-masing peserta didik untuk keperluan remedial dan pengayaan.</td>
										<?
											$indikator_14 = mysql_query("SELECT * FROM indikator_14 WHERE id='$id'");
											$data14 = mysql_fetch_array($indikator_14);
											$i141 = $data14['k141'];
											$i142 = $data14['k142'];
											$i143 = $data14['k143'];
											$i144 = $data14['k144'];
											$ket141 = $data14['ket141'];
											$ket142 = $data14['ket142'];
											$ket143 = $data14['ket143'];
											$ket144 = $data14['ket144'];
											
											if($i141==1){
												echo"
												<td><input type=\"radio\" name=\"k141\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket141.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k141\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket141.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket141\" type=\"text\" name=\"ket141\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i141==0){
												echo"
												<td><input type=\"radio\" name=\"k141\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket141.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k141\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket141.disabled=false\" checked=\"\" title=\"$ket141\"></td>
												<td><input class=\"input-small\" id=\"ket141\" type=\"text\" name=\"ket141\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Selama pengamatan:</td>
										<td>Menggunakan hasil penilaian untuk menyempurnakan rancangan dan/atau pelaksanaan pembelajaran</td>
										<?
											if($i142==1){
												echo"
												<td><input type=\"radio\" name=\"k142\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket142.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k142\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket142.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket142\" type=\"text\" name=\"ket142\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i142==0){
												echo"
												<td><input type=\"radio\" name=\"k142\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket142.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k142\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket142.disabled=false\" checked=\"\" title=\"$ket142\"></td>
												<td><input class=\"input-small\" id=\"ket142\" type=\"text\" name=\"ket142\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td></td>
										<td>Melaporkan kemajuan dan hasil belajar peserta didik kepada orang tua, teman guru dan bagi peserta didik sebagai refleksi belajarnya.</td>
										<?
											if($i143==1){
												echo"
												<td><input type=\"radio\" name=\"k143\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket143.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k143\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket143.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket143\" type=\"text\" name=\"ket143\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i143==0){
												echo"
												<td><input type=\"radio\" name=\"k143\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket143.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k143\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket143.disabled=false\" checked=\"\" title=\"$ket143\"></td>
												<td><input class=\"input-small\" id=\"ket143\" type=\"text\" name=\"ket143\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td>Setelah pengamatan:</td>
										<td> Memanfaatkan hasil penilaian secara efektif untuk mengidentifikasi kekuatan, kelemahan, tantangan dan masalah potensial untuk peningkatan keprofesian dalam menunjang proses pembelajaran</td>
										<?
											if($i144==1){
												echo"
												<td><input type=\"radio\" name=\"k144\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket144.disabled=true\" checked=\"\"></td>
												<td><input type=\"radio\" name=\"k144\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket144.disabled=false\"></td>
												<td><input class=\"input-small\" id=\"ket144\" type=\"text\" name=\"ket144\" placeholder=\"mohon diisi...\"></td>
											";
											}
											if($i144==0){
												echo"
												<td><input type=\"radio\" name=\"k144\" id=\"k1\" value=\"1\" onClick=\"javascript:document.form14.ket144.disabled=true\"></td>
												<td><input type=\"radio\" name=\"k144\" id=\"k2\" value=\"0\" onClick=\"javascript:document.form14.ket144.disabled=false\" checked=\"\" title=\"$ket144\"></td>
												<td><input class=\"input-small\" id=\"ket144\" type=\"text\" name=\"ket144\" placeholder=\"mohon diisi...\"></td>
											";
											}
										?>
									</tr>
									<tr>
										<td colspan="6"></td>
										<?if($kategori!='admin'){
											?><td align="right"><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tentukan!</button></td><?
										}?>
									</tr>
									</form>
								</tbody>
							</table>
						</div>
					</div>            
				</div>
			</div>
		</div>
	  </div>
       
      <hr>

      <footer>
		<p class="nav pull-right">&copy; 2012 <a target="_blank" href="http://enkaem.blogspot.com">@nkm</a>. Made with <a target="_blank" href="http://getbootstrap.com">Bootstrap.</a></p>
      </footer>

    </div><!--/container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

</body></html>
<?}?>