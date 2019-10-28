<?php
session_start();
include "lib/koneksi.php";

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $sql_admin = mysqli_query($conn, "SELECT * FROM supervisor WHERE username='$username'");
  $row_admin =mysqli_fetch_array($sql_admin);
  $id = $row_admin['id'];
  $kategori = $row_admin['kategori'];
}
?>

<!DOCTYPE HTML>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Home | PKG SMKN 6 Malang</title>
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
          <?php
		  if(isset($_SESSION['username']) || isset($_SESSION['password'])){
		  ?>
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
          <?php
		  }
		  ?>
          <div class="nav-collapse">
          <ul class="nav">
          <?php
		  if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
		  {
			?>
              <li class="active"><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
              <li><a data-toggle="modal" href="#myContact"><i class="icon-th-large icon-white"></i> Kontak</a></li>
          <?php
		  }
		  else
		  {
			?>
              <li class="active"><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
			  <?php
				if($kategori=='admin'){
					?><li><a href="daftar.php"><i class="icon-search icon-white"></i> Administrator</a></li><?php
				}
				if($kategori=='supervisor'){
					?>
					<li><a href="daftar.php"><i class="icon-search icon-white"></i> Penilaian</a></li>
					<li><a href="raport.php"><i class="icon-book icon-white"></i> Raport</a></li>
					<?php
				}
				if($kategori=='guru'){
					?><li><a href="daftar.php"><i class="icon-book icon-white"></i> Raport</a></li><?php
				}
			  ?>
              <li><a data-toggle="modal" href="#myContact"><i class="icon-th-large icon-white"></i> Kontak</a></li>
          <?php
		  }
		  ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
		<div class="container" style="width:80%;">
		  <div class="row-fluid">
			<div class="span3">
			  <div class="well">
				<img src="images/smkn6.png" style="margin-top:-10px;"><hr style="margin-top:-1px; margin-bottom:10px;">
				<?php
				if(isset($_SESSION['username']) || isset($_SESSION['password'])){
				?>
				<center><strong>Anda telah login.</strong><br><br>
				<?php
					if($kategori=='guru'){
					?><a href="raport.php">Kembali ke hasil PKG</a><?php						
					}
					else{
					?><a href="daftar.php">Kembali ke daftar guru</a><?php
					}
				?>				
				</center>
				<?php }
				else{?>				
				<form action="proses_login.php" method="post">
					<input class="span12" type="text" placeholder="Username" name="username">
					<input class="span12" type="password" placeholder="Password" name="password">
					<div align="right" style="margin-bottom:-25px;"><input class="btn-primary" name="login" type="submit" value="Log In"></div>
				</form>
				<?php } ?>
			  </div>			  
			</div>
			<div class="span9">
			  <div id="myCarousel" class="carousel slide">
				<div class="carousel-inner">
				  <div class="item active">
					<img src="images/pkg.jpg" alt="">
					<div class="carousel-caption">
					  <h4>Penilaian Kinerja Guru (v1.5)</h4>
					  <p>Penilaian kinerja guru merupakan penilaian dari tiap butir kegiatan tugas utama guru dalam rangka pembinaan karier kepangkatan dan jabatannya. (Permenneg PAN & RB No. 16/2009)</p>
					</div>
				  </div>
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
			  </div>
			</div>
		  </div>
		  <div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Mohon Perhatian!</strong><br/>
			Bagi Bapak/Ibu baik supervisor maupun guru yang belum mendapatkan username dan password untuk login di PKG-Online, segera menghubungi <strong>nurkholismajid@live.com</strong> atau SMS ke <strong>03416791277</strong>. Terima kasih atas perhatiannya.
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
	<script>
		$('.carousel').carousel();
	</script>

  

</body></html>
