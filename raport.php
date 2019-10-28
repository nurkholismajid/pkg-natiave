<?
session_start();
include "lib/koneksi.php";

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
	$id = $row_admin['id'];
	
	$sql_nama = mysql_query("SELECT * FROM guru WHERE id='$id'");
	$row_nama =mysql_fetch_array($sql_nama);
	
	if($kategori=='admin'){
		header("Location: daftar.php");
	}
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
				if($kategori=='guru'){
					?><li class="active"><a href="raport.php"><i class="icon-book icon-white"></i> Raport</a></li><?
				}				
				else{
					?>
					<li><a href="daftar.php"><i class="icon-search icon-white"></i> Penilaian</a></li>
					<li class="active"><a href="raport.php"><i class="icon-book icon-white"></i> Raport</a></li>
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
	<?
		if($kategori=='guru'){
			?><img src="images/header_pkg.jpg" style="margin-top:-20px;"><?
		}
		if($kategori!='guru'){
			?><h1><? echo $row_nama['nama'];?></h1><?
		}
	?>
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

				$sql_guru = mysql_query("SELECT * FROM guru WHERE id='$id'");
				$row_guru =mysql_fetch_array($sql_guru);
				$guru_supervisor = $row_guru['id_supervisor'];
				
				$sql_guru2 = mysql_query("SELECT * FROM guru WHERE id='$guru_supervisor'");
				$row_guru2 =mysql_fetch_array($sql_guru2);
					
				?><div class="alert alert-info">
					<button class="close" data-dismiss="alert">&times;</button>
					Supervisor Anda adalah: <?echo $row_guru2['nama'];?>
				</div><?			
			?>
			
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
				*) Jika nilai masih 0, maka analisis nilai belum dilakukan oleh supervisor.
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i11==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket11\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i12==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket12\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i13==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket13\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i21==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket21\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i22==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket22\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i23==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket23\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i24==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket24\"></i></td>
											";
											}
										?>
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
											$i31 = $data3['k11'];
											$i32 = $data3['k32'];
											$i33 = $data3['k33'];
											$i34 = $data3['k34'];
											$ket31 = $data3['ket31'];
											$ket32 = $data3['ket32'];
											$ket33 = $data3['ket33'];
											$ket34 = $data3['ket34'];
											
											if($i31==1){
												echo"
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i31==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket31\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i32==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket32\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i33==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket33\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i34==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket34\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i41==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket41\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i42==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket42\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i43==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket43\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i51==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket51\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i52==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket52\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i61==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket61\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i62==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket62\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i63==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket63\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i64==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket64\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i71==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket71\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i72==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket72\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i73==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket73\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i74==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket74\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i75==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket75\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i76==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket76\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i81==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket81\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i82==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket82\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i83==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket83\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i91==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket91\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i92==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket92\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i93==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket93\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i94==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket94\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i95==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket95\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i101==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket101\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i102==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket102\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i103==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket103\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i111==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket111\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i112==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket112\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i121==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket121\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i122==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket122\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i123==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket123\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i124==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket124\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i131==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket131\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i132==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket132\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i133==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket133\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i134==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket134\"></i></td>
											";
											}
										?>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i141==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket141\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i142==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket142\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i143==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket143\"></i></td>
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
												<td><i class=\"icon-ok\"></i></td>
												<td></td>
											";
											}
											if($i144==0){
												echo"
												<td></td>
												<td><i class=\"icon-ok\" title=\"$ket144\"></i></td>
											";
											}
										?>
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