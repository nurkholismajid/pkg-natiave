<?php
session_start();
include "lib/koneksi.php";

if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
?>
<script language="JavaScript">alert('You are not login yet, please login first'); 
document.location='index.php'</script>
<?php
}
else{
	$username = $_SESSION['username'];
	$sql_admin = mysqli_query($conn, "SELECT * FROM supervisor WHERE username='$username'");
	$row_admin =mysqli_fetch_array($sql_admin);
	$id = $row_admin['id'];
	$kategori = $row_admin['kategori'];
	
	if($kategori=='guru'){
		header("Location: analisis.php?id=$id");
	}
?>

<!DOCTYPE HTML>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Daftar | PKG SMKN 6 Malang</title>
	<meta http-equiv="refresh" content = "600; url=proses_logout.php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/docs.css" rel="stylesheet">
	<link  href="assets/css/datepicker_jqui.css" rel="stylesheet" type="text/css" media="screen" />
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
              <i class="icon-user"></i> <?php echo $_SESSION['username'];?>
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
			  <?php
			  if($kategori=='admin'){
				?><li class="active"><a href="daftar.php"><i class="icon-search icon-white"></i> Administrator</a></li><?php
			  }
			  else{
				?>
				<li class="active"><a href="daftar.php"><i class="icon-search icon-white"></i> Penilaian</a></li>
				<li><a href="raport.php"><i class="icon-book icon-white"></i> Raport</a></li>
				<?php
			  }
			  ?>
              <li><a data-toggle="modal" href="#myContact"><i class="icon-th-large icon-white"></i> Kontak</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
		<img src="images/header_pkg.jpg" style="margin-top:-20px;">
		<div class="row-fluid">
			<ul id="myTab" class="nav nav-tabs">				
				<?php
					if($kategori=='admin'){ ?>
						<li class="active"><a href="#daftar" data-toggle="tab">Daftar Guru</a></li>
						<li class=""><a href="#supervisor" data-toggle="tab">Daftar Supervisor</a></li>
						<li class=""><a href="#user" data-toggle="tab">Daftar User</a></li>
						<li class=""><a href="#tambah" data-toggle="tab">Tambah Guru</a></li>
					<?php }
					else if($kategori=='supervisor'){ ?>
						<li class="active"><a href="#daftar" data-toggle="tab">Daftar Guru Supervisi</a></li>
					<?php } ?>
			</ul>
			
			<div id="myTabContent" class="tab-content">
			
				<div class="tab-pane fade active in" id="daftar">					
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Bantuan!</strong><br/>
						Dengan mengklik header tabel, Anda dapat mengurutkan isi tabel.
					</div>
					<table class="table table-striped" id="sortTable">
						<thead>
						  <tr>
							<th>No</th>
							<th>Nama</th>
							<th>NIP</th>
							<th>Tempat Lahir</th>
							<th>Tanggal Lahir</th>
							<!--<th>Jenis Kelamin</th>-->
							<!--<th>Pendidikan</th>-->
							<th>Nilai</th>
							<?php if($kategori=='admin'){ ?>
							<th style="width:70px;"></th>
							<?php } ?>
							<?php if($kategori=='supervisor'){ ?>
							<th style="width:10px;"></th>
							<?php } ?>
						  </tr>
						</thead>
						<tbody>
						<?php
						  if($kategori=='admin'){
							$mysql1=mysqli_query($conn, "SELECT * FROM guru INNER JOIN nilai ON guru.id = nilai.id;");
						  }					  
						  else{
							$mysql1=mysqli_query($conn, "SELECT * FROM guru INNER JOIN nilai ON guru.id = nilai.id WHERE id_supervisor=$id;");
						  }			  
						  while($row1=mysqli_fetch_array($mysql1)){
						?>
						  <tr>
							<td><?php echo $row1['id'];?></td>
							<td>
							<?php 
								echo $row1['nama'];
								if($kategori=='admin'){
									$supervisor=$row1['supervisor'];
									if($supervisor==1){
										echo " (<b>Supervisor</b>)";
									}
								}								
							?>
							</td>
							<td><?php echo $row1['nip'];?></td>
							<td><?php echo $row1['tempat_lahir'];?></td>
							<td><?php echo $row1['tanggal_lahir'];?></td>
							<!--<td><?php echo $row1['jenis_kelamin'];?></td>-->
							<!--<td><?php echo $row1['pendidikan'];?></td>-->
							<td><?php echo $row1['total'];?></td>
							<?php if($kategori=='admin'){ ?>
							<td>
							<?php
								if($supervisor==0){
									?><a href="proses_supervisor.php?id=<?php echo $row1['id'];?>" title="Jadikan Supervisor!"><i class="icon-star"></i></a><?php
								}
								if($supervisor==1){
									?><a href="proses_supervisor.php?id=<?php echo $row1['id'];?>" title="Batal Supervisor!"><i class="icon-star-empty"></i></a><?php
								}																
							?>
								<a href="analisis.php?id=<?php echo $row1['id'];?>" title="Analisis"><i class="icon-signal"></i></a>
								<a href="edit.php?id=<?php echo $row1['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
								<a href="proses_hapus.php?id=<?php echo $row1['id'];?>" onclick="return confirm('Dengan mengklik OK, Anda setuju menghapus guru yang dipilih dari daftar guru SMKN 6 Malang. Apakah Anda yakin?')" title="Hapus"><i class="icon-trash"></i></a>
							</td>
							<?php } ?>
							<?php if($kategori=='supervisor'){ ?>
							<td>					
								<a href="analisis.php?id=<?php echo $row1['id'];?>" title="Analisis"><i class="icon-signal"></i></a>
							</td>
							<?php } ?>
						  </tr>
						  <?php } ?>
						</tbody>					
					</table>
				</div>
				
				<div class="tab-pane fade" id="supervisor">					
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Daftar Supervisor!</strong><br/>
						Anda dapat melihat daftar supervisor dan guru yang dinilai.
					</div>
					<table class="table table-striped" id="sortTable" style="width:60%">
						<thead>
						  <tr>
							<th>No</th>
							<th>Nama Supervisor</th>
							<th>NIP Supervisor</th>
							<th style="width:50px;"></th>
						  </tr>
						</thead>
						<tbody>
						<?php
						  $mysql3=mysqli_query($conn, "SELECT * FROM guru WHERE supervisor=1;");
						  while($row3=mysqli_fetch_array($mysql3))
						  {
						?>
						  <tr>
							<td><?php echo $index3+=1;?></td>
							<td><?php echo $row3['nama'];?></td>
							<td><?php echo $row3['nip'];?></td>
							<td>
								<a href="daftar_supervisi.php?id=<?php echo $row3['id'];?>" title="Daftar Guru Supervisi"><i class="icon-list-alt"></i></a>
								<a href="edit.php?id=<?php echo $row3['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
								<a href="proses_supervisor.php?id=<?php echo $row3['id'];?>" onclick="return confirm('Hapus dari daftar Supervisor?')" title="Hapus Supervisor"><i class="icon-trash"></i></a>
							</td>
						  </tr>
						  <?php } ?>
						</tbody>					
					</table>
				</div>
				
				<div class="tab-pane fade" id="user">					
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Daftar guru terdaftar!</strong><br/>
						Anda dapat melihat daftar guru yang sudah menjadi member ataupun belum.
					</div>
					
					<table class="table table-striped" id="sortTable" style="width:50%">
						<thead>
						  <tr>
							<th style="width:10px;">No</th>
							<th>Nama Guru</th>
							<th>Username</th>
							<th>Kategori</th>	
							<th style="width:40px;"></th>
						  </tr>
						</thead>
						<tbody>
						<?php
						  $mysql4=mysqli_query($conn, "SELECT * FROM supervisor INNER JOIN guru ON supervisor.id = guru.id ORDER BY guru.id;");
						  while($row4=mysqli_fetch_array($mysql4)){
						?>
						  <tr>
							<td><?php echo $index4+=1;?></td>
							<td><?php echo $row4['nama'];?></td>
							<td><?php echo $row4['username'];?></td>
							<td><?php echo $row4['kategori'];?></td>
							<td>
								<a href="edit_user.php?id=<?php echo $row4['id'];?>"><i class="icon-pencil"></i></a>
								<a href="proses_hapus_user.php?id=<?php echo $row4['id'];?>" onclick="return confirm('Dengan mengklik OK, Anda setuju menghapus guru yang dipilih dari daftar user di pkg.smkn6malang.sch.id. Apakah Anda yakin?')" title="Hapus"><i class="icon-trash"></i></a>
							</td>
						  </tr>
						  <?php } ?>
						</tbody>					
					</table>
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Daftar guru yang belum terdaftar!</strong><br/>
						Di bawah ini adalah daftar guru yang belum mempunyai akun untuk login ke pkg.smkn6malang.sch.id.
					</div>
					
					<table class="table table-striped" id="sortTable" style="width:35%">
						<thead>
						  <tr>
							<th style="width:10px;">No</th>
							<th>Nama Guru</th>							
							<th style="width:10px;"></th>
						  </tr>
						</thead>
						<tbody>
						<?php
						  $mysql5=mysqli_query($conn, "SELECT * FROM guru WHERE NOT EXISTS (SELECT * FROM supervisor WHERE guru.id = supervisor.id);");
						  while($row5=mysqli_fetch_array($mysql5)){
						?>
						  <tr>
							<td><?php echo $index5+=1;?></td>
							<td>
							<?php 
								echo $row5['nama'];
								$supervisor=$row5['supervisor'];
								if($supervisor==1){
									echo " (<b>Supervisor</b>)";
								}
							?>
							</td>							
							<td><a href="proses_user.php?id=<?php echo $row5['id']; ?>&nama=<?php echo $row5['nama'];?>&supervisor=<?php echo $row5['supervisor']; ?>"><i class="icon-plus"></i></a></td>
						  </tr>
						  <?php } ?>
						</tbody>					
					</table>
				</div>
				
				<div class="tab-pane fade" id="tambah">					
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Tambah!</strong><br/>
						Anda dapat menambahkan Guru dengan mengisi semua atau beberapa saja.
					</div>
					<table>
						<form action="proses_tambah.php" method="post">
						<tr>
							<td width="10%">
								<input type="text" placeholder="Nama" name="nama" id="nama"><br>
								<input type="text" placeholder="NIP" name="nip" id="nip"><br>
								<select name="jenis_kelamin">
									<option value="" selected="selected">----Pilih Jenis Kelamin----</option>
									<option value="L">Laki-Laki</option>
									<option value="P">Perempuan</option>
								</select><br>
								<input type="text" placeholder="Tempat Lahir" name="tempat" id="tempat"><br>
								<input type="text" value="02/08/2011" id="jqui" name="tanggal"><br>
								<select name="pendidikan">
									<option value="D1">D1</option>
									<option value="D2">D2</option>
									<option value="D3">D3</option>
									<option value="D4">D4</option>
									<option value="S1" selected="selected">S1</option>
									<option value="S2">S2</option>
									<option value="S3">S3</option>
								</select><br>
							</td>
						</tr>
						<tr>
							<td><button type="submit" class="btn btn-primary" name="tambah" id="tambah">Tambahkan</button></td>
						</tr>
						</form>
					</table>
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
	<script src="assets/js/jquery.tablesorter.min.js"></script>
	<script src="assets/js/mootools-core.js" type="text/javascript"></script>
	<script src="assets/js/mootools-more.js" type="text/javascript"></script>
	<script src="assets/js/Locale.en-US.DatePicker.js" type="text/javascript"></script>
	<script src="assets/js/Picker.js" type="text/javascript"></script>
	<script src="assets/js/Picker.Attach.js" type="text/javascript"></script>
	<script src="assets/js/Picker.Date.js" type="text/javascript"></script>	
	<script>
		$(function() {
			$("table#sortTable").tablesorter({ sortList: [[0,0]] });
		});
	</script>
	
		<script>
		window.addEvent('domready', function(){
			new Picker.Date('jqui', {
				pickerClass: 'datepicker_jqui'
			});
		});
	</script>
</body></html>
<?php } ?>