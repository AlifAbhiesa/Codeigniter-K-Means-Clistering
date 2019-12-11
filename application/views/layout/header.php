<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Pasar Strategis by Alif Abhiesa</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- favicon
        ============================================ -->
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/green-horizotal/')?>img/favicon.ico">
	<!-- datapicker CSS
		============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/datapicker/datepicker3.css">
	<!-- Google Fonts
        ============================================ -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
	<!-- Bootstrap CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/bootstrap.min.css">
	<!-- bootstrap select CSS
       ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/bootstrap-select/bootstrap-select.css">
	<!-- Bootstrap CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/font-awesome.min.css">
	<!-- owl.carousel CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/owl.carousel.css">
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/owl.theme.css">
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/owl.transitions.css">
	<!-- meanmenu CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/meanmenu/meanmenu.min.css">
	<!-- animate CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/animate.css">
	<!-- normalize CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/normalize.css">
	<!-- mCustomScrollbar CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/scrollbar/jquery.mCustomScrollbar.min.css">
	<!-- jvectormap CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/jvectormap/jquery-jvectormap-2.0.3.css">
	<!-- notika icon CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/notika-custom-icon.css">
	<!-- wave CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/wave/waves.min.css">
	<!-- main CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/main.css">
	<!-- style CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>style.css">
	<!-- responsive CSS
        ============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/responsive.css">
	<!-- modernizr JS
        ============================================ -->
	<script src="<?= base_url('assets/green-horizotal/')?>js/vendor/modernizr-2.8.3.min.js"></script>
	<!-- wave CSS
		============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/wave/waves.min.css">
	<!-- main CSS
		============================================ -->
	<link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/chosen/chosen.css">


	<!-- jquery
        ============================================ -->
	<script src="<?= base_url('assets/green-horizotal/')?>js/vendor/jquery-1.12.4.min.js"></script>
	<script src="<?= base_url('assets/green-horizotal/')?>js/owl.carousel.min.js"></script>

</head>

<body>
<!--<div id="type1" class="invoice-print">-->
<!--	--><?php //if($this->session->userdata('username') != ""){
//		?>
<!--		<a href="#" onclick="changeButton()" hidden class="btn"><i class="fa fa-users"></i></a>-->
<!--	--><?php //}else{
//		?>
<!--		<a href="--><?//= base_url('Login') ?><!--" class="btn"><i class="fa fa-power-off"></i></a>-->
<!--	--><?php //} ?>
<!--</div>-->
<!---->
<!--<div id="type2" hidden class="invoice-print">-->
<!--	--><?php //if($this->session->userdata('username') != ""){
//		?>
<!--		<a href="#" data-toggle="modal" data-target="#modalLogOut" class="btn"><i class="fa fa-sign-out"></i></a>-->
<!--		<a href="#" data-toggle="modal" data-target="#modalRequest" class="btn"><i class="fa fa-edit"></i></a>-->
<!--		<a href="#" onclick="changeButton2()" hidden class="btn"><i class="fa fa-close"></i></a>-->
<!--	--><?php //}else{
//		?>
<!--		<a href="--><?//= base_url('Login') ?><!--" class="btn"><i class="fa fa-power-off"></i></a>-->
<!--	--><?php //} ?>
<!--</div>-->

<div class="modal animated bounce" id="modalLogOut" role="dialog">
	<div class="modal-dialog modals-default">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h2>Apakah anda yakin untuk log out?</h2>
			</div>
			<div class="modal-footer">
				<button onclick="logOut()" type="button" class="btn btn-default">Ya</button>
				<button type="button" class="btn" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>



<div class="modal animated bounce" id="modalRequest" role="dialog">
	<div class="modal-dialog modals-default">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">

				<div class="nk-form">


					<div class="input-group mg-t-15">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-star"></i></span>
						<div class="nk-int-st">
							<select class="form-control" id="idKomoditas">
								<?php foreach ($list_komoditas as $row): ?>
									<option value="<?= $row['idKomoditas'] ?>"><?= $row['namaKomoditas'] ?></option>
								<?php endforeach; ?>

							</select>
						</div>
					</div>


					<div class="input-group mg-t-15">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-calendar"></i></span>
						<div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
							<div class="input-group date nk-int-st">
								<span class="input-group-addon"></span>
								<input type="text" id="dateRequest" class="form-control" placeholder="Tanggal butuh">
							</div>
						</div>
					</div>


					<div class="input-group mg-t-15">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-dollar"></i></span>
						<div class="nk-int-st">
							<input type="text" class="form-control" id="priceRequest" placeholder="Harga">
						</div>
					</div>

				</div>

			</div>
			<div class="modal-footer">
				<br>
				<button onclick="submitRequest()" type="button" class="btn btn-default">Submit</button>
				<button type="button" class="btn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Start Header Top Area -->
<div class="header-top-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="logo-area">
					<a href="#"><img src="<?= base_url('assets/green-horizotal/')?>img/logo/logo.png" alt="" /></a>

				</div>
			</div>

		</div>
	</div>
</div>
<!-- End Header Top Area -->

<script>
	function changeButton() {
		document.getElementById("type1").setAttribute("hidden", true);
		document.getElementById("type2").removeAttribute("hidden");
	}

	function changeButton2() {
		document.getElementById("type2").setAttribute("hidden", true);
		document.getElementById("type1").removeAttribute("hidden");
	}

	function logOut() {
		window.location.href = "<?= base_url('Login/logout') ?>";
	}

	function submitRequest() {
		var idKomoditas = document.getElementById("idKomoditas").value;
		var dateRequest = document.getElementById("dateRequest").value;
		var priceRequest = document.getElementById("priceRequest").value;

		$.ajax({
			url: "<?php echo base_url('Request/addRequest'); ?>",
			type: "post",
			data: {
				idKomoditas:idKomoditas,
				dateRequest:dateRequest,
				priceRequest:priceRequest,
			},
			cache: false,
			success: function (response) {
				// alert(response);
				if(response == "Ok"){
					alert('data submited !');
					document.getElementById("idKomoditas").value = "";
					document.getElementById("dateRequest").value = "";
					document.getElementById("priceRequest").value = "";
				}else if(response == "failed"){
					alert('Gagal submit !');
				}
			}
		});

	}
</script>
