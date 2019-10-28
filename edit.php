<?
session_start();
include "lib/koneksi.php";
$id=$_GET['id'];

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
				?><li class="active"><a href="daftar.php"><i class="icon-search icon-white"></i> Penilaian</a></li><?
			  }
			  ?>
              <li><a data-toggle="modal" href="#myContact"><i class="icon-th-large icon-white"></i> Kontak</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
		<div class="row-fluid">
			<ul id="myTab" class="nav nav-tabs">
				<li class="active"><a href="#edit" data-toggle="tab">Edit Guru</a></li>
			</ul>
			
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="edit">
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Edit!</strong><br/>
						Isi biodata dengan benar.
					</div>
					
					<form action="proses_edit.php" method="post">
						<?
						  $mysql=mysql_query("SELECT * FROM guru WHERE id='$id'");
						  $row=mysql_fetch_array($mysql);
						?>
						<input type="hidden" placeholder="id" name="id" id="id" value="<? echo $row['id'];?>"><br>
						<input type="text" placeholder="Nama" name="nama" id="nama" value="<? echo $row['nama'];?>"><br>
						<input type="text" placeholder="NIP" name="nip" id="nip" value="<? echo $row['nip'];?>"><br>
						<select name="jenis_kelamin">
							<?
							$jenis_kelamin = $row['jenis_kelamin'];
							if($jenis_kelamin=='L'){
								echo"
								<option value=\"\">----Pilih Jenis Kelamin----</option>
								<option value=\"L\" selected=\"selected\">Laki-Laki</option>
								<option value=\"P\">Perempuan</option>
							";
							}
							if($jenis_kelamin=='P'){
								echo"
								<option value=\"\">----Pilih Jenis Kelamin----</option>
								<option value=\"L\">Laki-Laki</option>
								<option value=\"P\" selected=\"selected\">Perempuan</option>
							";
							}
							if($jenis_kelamin==''){
								echo"
								<option value=\"\"  selected=\"selected\">----Pilih Jenis Kelamin----</option>
								<option value=\"L\">Laki-Laki</option>
								<option value=\"P\">Perempuan</option>
							";
							}
							?>							
						</select><br>
						<input type="text" placeholder="Tempat Lahir" name="tempat" id="tempat" value="<? echo $row['tempat_lahir'];?>"><br>
						<input type="text" value="<? echo $row['tanggal_lahir'];?>" id="jqui" name="tanggal"><br>
						<select name="pendidikan">
							<?
							$pendidikan = $row['pendidikan'];
							if($pendidikan=='D1'){
								echo"
								<option value=\"D1\" selected=\"selected\">D1</option>
								<option value=\"D2\">D2</option>
								<option value=\"D3\">D3</option>
								<option value=\"D4\">D4</option>
								<option value=\"S1\">S1</option>
								<option value=\"S2\">S2</option>
								<option value=\"S3\">S3</option>
							";
							}
							else if($pendidikan=='D2'){
								echo"
								<option value=\"D1\">D1</option>
								<option value=\"D2\" selected=\"selected\">D2</option>
								<option value=\"D3\">D3</option>
								<option value=\"D4\">D4</option>
								<option value=\"S1\">S1</option>
								<option value=\"S2\">S2</option>
								<option value=\"S3\">S3</option>
							";
							}
							else if($pendidikan=='D3'){
								echo"
								<option value=\"D1\">D1</option>
								<option value=\"D2\">D2</option>
								<option value=\"D3\" selected=\"selected\">D3</option>
								<option value=\"D4\">D4</option>
								<option value=\"S1\">S1</option>
								<option value=\"S2\">S2</option>
								<option value=\"S3\">S3</option>
							";
							}
							else if($pendidikan=='D4'){
								echo"
								<option value=\"D1\">D1</option>
								<option value=\"D2\">D2</option>
								<option value=\"D3\">D3</option>
								<option value=\"D4\" selected=\"selected\">D4</option>
								<option value=\"S1\">S1</option>
								<option value=\"S2\">S2</option>
								<option value=\"S3\">S3</option>
							";
							}
							else if($pendidikan=='S1'){
								echo"
								<option value=\"D1\">D1</option>
								<option value=\"D2\">D2</option>
								<option value=\"D3\">D3</option>
								<option value=\"D4\">D4</option>
								<option value=\"S1\" selected=\"selected\">S1</option>
								<option value=\"S2\">S2</option>
								<option value=\"S3\">S3</option>
							";
							}
							else if($pendidikan=='S2'){
								echo"
								<option value=\"D1\">D1</option>
								<option value=\"D2\">D2</option>
								<option value=\"D3\">D3</option>
								<option value=\"D4\">D4</option>
								<option value=\"S1\">S1</option>
								<option value=\"S2\" selected=\"selected\">S2</option>
								<option value=\"S3\">S3</option>
							";
							}
							else if($pendidikan=='S3'){
								echo"
								<option value=\"D1\">D1</option>
								<option value=\"D2\">D2</option>
								<option value=\"D3\">D3</option>
								<option value=\"D4\">D4</option>
								<option value=\"S1\">S1</option>
								<option value=\"S2\">S2</option>
								<option value=\"S3\" selected=\"selected\">S3</option>
							";
							}
							else{
								echo"
								<option value=\"D1\">D1</option>
								<option value=\"D2\">D2</option>
								<option value=\"D3\">D3</option>
								<option value=\"D4\">D4</option>
								<option value=\"S1\" selected=\"selected\">S1</option>
								<option value=\"S2\">S2</option>
								<option value=\"S3\">S3</option>
							";
							}
							?>
						</select><br>
						<button type="submit" class="btn btn-primary" name="tambah" id="tambah">Selesai</button>
					</form>
				</div>
			</div>
		</div>
		
		<div class="row">

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
	<script src="assets/js/mootools-core.js" type="text/javascript"></script>
	<script src="assets/js/mootools-more.js" type="text/javascript"></script>
	<script src="assets/js/Locale.en-US.DatePicker.js" type="text/javascript"></script>
	<script src="assets/js/Picker.js" type="text/javascript"></script>
	<script src="assets/js/Picker.Attach.js" type="text/javascript"></script>
	<script src="assets/js/Picker.Date.js" type="text/javascript"></script>	
	
	<script>
		window.addEvent('domready', function(){
			new Picker.Date('jqui', {
				pickerClass: 'datepicker_jqui'
			});
		});
	</script>
</body></html>
<?}?>