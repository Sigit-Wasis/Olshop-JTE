<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script type="text/javascript" src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/client/style.css">

    <title>Olshop JTE</title>
  </head>
  <body>


<!-- membuat menu navigasi -->
	<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="<?= base_url(); ?>">Olshop JTE</a>
			</div>
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="#">Home <span class="sr-only">(current)</span></a></li>
					<li><a href="#">Promo</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kategori <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Elektronik</a></li>
							<li><a href="#">Paket & Voucher</a></li>
							<li><a href="#">Kesehatan</a></li>							
							<li><a href="#">Perkantoran</a></li>							
							<li><a href="#">Busana Muslim</a></li>
						</ul>
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right my-sm-3">
					 <form class="form-inline nav-item mr-sm-2" action="<?= base_url(); ?>login">
      <button class="btn btn-outline-primary my-2 my-sm-0"> Login </button>
    </form>
    <form class="form-inline nav-item mr-sm-2" action="<?= base_url(); ?>register">
      <button class="btn btn-outline-primary my-2 my-sm-0"> Register </button>
    </form>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>	

 
	<div class="container-fluid my-sm-2 ">			
		<!-- membuat jumbotron -->
		<div class="jumbotron">
			<center>			
				<h2>Selamat datang di Online Shop JTE</h2>
				<p><h4>Toko online ini menyediakan berbagai macam kelengkapan anak-anak, muda, maupun dewasa</p></h4>
				<p><h4>Dengan Barang terlengkap dan pastinya barang berkualitas tinggi serta Harga terjangkau</p></h4>
			</center>
		</div>
		<!-- akhir jumbotron -->
		
		<?php 
        	foreach ($data as $u) {
        ?>
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<div class="cus-thumbnail img-4">
					<img src="<?= base_url(); ?>assets/images/barang/<?= $u->gambar ?>" alt="...">
				</div>
				<div class="caption">
					<h3><?php echo ucwords($u->nama_barang) ?></h3>
					<p>Rp. <?php echo $u->harga ?></p>
					<p><a href="#" class="btn btn-primary" role="button">Checkout</a></p>
				</div>
			</div>
		</div>
		<?php } ?>
 
	</div>
	<br/>
	
	
	<div class="clearfix"></div>
		
	<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark" style="bottom: 0;margin: 0">
		<div class="container">	
			<center>
				
			<ul class="nav navbar-nav">
				<li><a href="#">Copyright @ Sigit wasis subekti</a></li>				
			</ul>
 
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Develop by qodr.or.id</a></li>									
			</ul>
			</center>		
		</div>
	</nav>
	
</body>
</html>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>