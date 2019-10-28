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
	
	if($kategori=='supervisor'){
		header("Location: daftar.php");
	}
	else if($kategori=='guru'){
		header("Location: raport.php");
	}
?>

<!DOCTYPE HTML>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Daftar Supervisi | PKG SMKN 6 Malang</title>
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
			  <li class="active"><a href="daftar.php"><i class="icon-search icon-white"></i> Administrator</a></li>
              <li><a data-toggle="modal" href="#myContact"><i class="icon-th-large icon-white"></i> Kontak</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
		<div class="row-fluid">
			<ul id="myTab" class="nav nav-tabs">
				<li class="active"><a href="#daftar" data-toggle="tab"><strong>Supervisor: <?echo $row_nama['nama'];?></strong></a></li>
			</ul>			
			<div id="myTabContent" class="tab-content">				
				<div class="tab-pane fade active in" id="daftar">
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Daftar Guru Supervisi!</strong><br/>
						Anda dapat melihat daftar guru yang dinilai.
					</div>
					<?
						$sql_previous=mysql_query("SELECT * FROM guru WHERE id<'$id' AND supervisor=1 ORDER BY id DESC");
						$sql_next=mysql_query("SELECT * FROM guru WHERE id>'$id' AND supervisor=1 ORDER BY id ASC");
						$row_previous=mysql_fetch_array($sql_previous);
						$row_next=mysql_fetch_array($sql_next);
						$id_previous = $row_previous['id'];
						$id_next = $row_next['id'];
					?>
					<a href="daftar_supervisi.php?id=<? echo $id_previous;?>"><i class="icon-chevron-left" title="ke supervisor sebelumnya"></i></a>
					<a class="nav pull-right" href="daftar_supervisi.php?id=<? echo $id_next;?>"><i class="icon-chevron-right" title="ke supervisor selanjutnya"></i></a>
					<table class="table table-striped" id="sortTable" style="width:50%">
						<thead>
						  <tr>
							<th>No</th>
							<th>Nama Guru</th>
							<th>NIP Guru</th>
							<th style="width:20px"></th>
						  </tr>
						</thead>
						<tbody>
						<?
						  $mysql1=mysql_query("SELECT * FROM guru WHERE id_supervisor='$id';");
						  while($row1=mysql_fetch_array($mysql1))
						  {
						?>
						  <tr>
							<td><? echo $index1+=1;?></td>
							<td>
							<? 
								echo $row1['nama'];
								$supervisor=$row1['supervisor'];
								if($supervisor==1){
									echo " (<b>Supervisor</b>)";
								}
							?>
							</td>
							<td><? echo $row1['nip'];?></td>
							<td>
								<a href="proses_supervisi.php?id=<? echo $row1['id'];?>&ids=<? echo $id;?>" title="Hapus dari daftar!"><i class="icon-minus"></i></a>
							</td>
						  </tr>
						  <? } ?>
						</tbody>					
					</table>
					
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Daftar Guru SMK Negeri 6 Malang!</strong><br/>
						Di bawah ini adalah daftar guru yang belum mendapatkan supervisor. Anda dapat menambahkan guru di bawah ini ke daftar supervisor.
					</div>
					<table class="table table-striped" id="sortTable" style="width:50%">
						<thead>
						  <tr>
							<th>No</th>
							<th>Nama Guru</th>
							<th>NIP Guru</th>
							<th style="width:20px"></th>
						  </tr>
						</thead>
						<tbody>
						<?
						  $mysql2=mysql_query("SELECT * FROM guru WHERE id_supervisor=0 AND id<>'$id';");
						  while($row2=mysql_fetch_array($mysql2))
						  {
						?>
						  <tr>
							<td><? echo $index2+=1;?></td>
							<td>
							<? 
								echo $row2['nama'];
								$supervisor=$row2['supervisor'];
								if($supervisor==1){
									echo " (<b>Supervisor</b>)";
								}
							?>
							</td>
							<td><? echo $row2['nip'];?></td>
							<td>
								<a href="proses_supervisi.php?id=<? echo $row2['id'];?>&ids=<? echo $id;?>" title="Tambahkan!"><i class="icon-plus"></i></a>
							</td>
						  </tr>
						  <? } ?>
						</tbody>					
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
	
</body></html>
<?}?>