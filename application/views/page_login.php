<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Register | Notika - Notika Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/bootstrap.min.css">
    <!-- font awesome CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/owl.theme.css">
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/wave/waves.min.css">
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/green-horizotal/')?>css/notika-custom-icon.css">
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
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Login Register area Start-->
    <div class="login-content">
        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
            <div class="nk-form">
                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" placeholder="Username" id="usernameLogin">
                    </div>
                </div>
                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                    <div class="nk-int-st">
                        <input type="password" class="form-control" placeholder="Password" id="passwordLogin">
                    </div>
                </div>
                <a onclick="loginUser()" href="#" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></a>
            </div>

            <div class="nk-navigation nk-lg-ic">
                <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
                <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
            </div>
        </div>

        <!-- Register -->
        <div class="nk-block" id="l-register">
            <div class="nk-form">


                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" id="usernameRegister" placeholder="Email Address">
                    </div>
                </div>

                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                    <div class="nk-int-st">
                        <input type="password" class="form-control" id="passwordRegister" placeholder="Password">
                    </div>
                </div>

				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-phone"></i></span>
					<div class="nk-int-st">
						<input type="text" class="form-control" id="noHpResgister" placeholder="No Hp">
					</div>
				</div>

				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-map"></i></span>
					<div class="nk-int-st">
						<input type="text" class="form-control" id="lokasiRegister" placeholder="Lokasi Pasar">
					</div>
				</div>

                <a href="#" class="btn btn-login btn-success btn-float" onclick="registerUser()"><i class="notika-icon notika-right-arrow"></i></a>
            </div>

            <div class="nk-navigation rg-ic-stl">
                <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
                <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
            </div>
        </div>

        <!-- Forgot Password -->
        <div class="nk-block" id="l-forget-password">
            <div class="nk-form">
                <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>

                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" placeholder="Email Address">
                    </div>
                </div>

                <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>
            </div>

            <div class="nk-navigation nk-lg-ic rg-ic-stl">
                <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
                <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
            </div>
        </div>
    </div>
    <!-- Login Register area End-->
    <!-- jquery
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/counterup/jquery.counterup.min.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/counterup/waypoints.min.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/sparkline/sparkline-active.js"></script>
    <!-- flot JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/flot/jquery.flot.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/flot/flot-active.js"></script>
    <!-- knob JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/knob/jquery.knob.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/knob/jquery.appear.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/knob/knob-active.js"></script>
    <!--  Chat JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/chat/jquery.chat.js"></script>
    <!--  wave JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/wave/waves.min.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/wave/wave-active.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/icheck/icheck.min.js"></script>
    <script src="<?= base_url('assets/green-horizotal/')?>js/icheck/icheck-active.js"></script>
    <!--  todo JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/todo/jquery.todo.js"></script>
    <!-- Login JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/login/login-action.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="<?= base_url('assets/green-horizotal/')?>js/main.js"></script>
</body>

</html>

<script>
	function loginUser(){
		var username = document.getElementById("usernameLogin").value;
		var password = document.getElementById("passwordLogin").value;

		$.ajax({
			url: "<?php echo site_url('Login/login'); ?>",
			type: "post",
			data: {username: username,
				password: password},
			cache: false,
			success: function (response) {

				if(response.replace(/(\r\n|\n|\r)/gm, "") == "Ok"){
					window.location.href = "<?php echo base_url()?>";
				}else{
					alert('error');
				}
			}
		});
	}

	function registerUser(){
		var username = document.getElementById("usernameRegister").value;
		var password = document.getElementById("passwordRegister").value;
		var noHp = document.getElementById("noHpResgister").value;
		var lokasi = document.getElementById("lokasiRegister").value;

		$.ajax({
			url: "<?php echo site_url('Login/register'); ?>",
			type: "post",
			data: {username: username,
				password: password,
				noHp:noHp,
			lokasi:lokasi
			},
			cache: false,
			success: function (response) {

				if(response.replace(/(\r\n|\n|\r)/gm, "") == "Ok"){
					alert('Register sukses !');

					document.getElementById("usernameRegister").value = ""
					document.getElementById("passwordRegister").value = "";
					document.getElementById("noHpResgister").value = "";
					document.getElementById("lokasiRegister").value = ""
				}else{
					alert('error');
				}
			}
		});
	}
</script>
