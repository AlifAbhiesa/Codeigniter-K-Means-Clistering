<style>

.scrollbar
{
	margin-left: 30px;
	float: left;
	height: 300px;
	width: 65px;
	background: #F5F5F5;
	overflow-y: scroll;
	margin-bottom: 25px;
}

.force-overflow
{
	min-height: 450px;
}


#style-3::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}

#style-3::-webkit-scrollbar
{
	width: 6px;
	background-color: #F5F5F5;
}

</style>
<!-- Breadcomb area Start-->
<div class="breadcomb-area" style="margin-bottom : 10px">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="breadcomb-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="breadcomb-wp">
								<div class="breadcomb-icon">
									<i style="cursor:pointer" title="Cari Pasar" class="fa fa-search" data-toggle="modal" data-target="#myModalfourteen"></i>
								</div>
								<div class="breadcomb-ctn">
									<h2>Cari Pasar Strategis</h2>
									<p>Pasar terdekat dengan harga jual tertinggi</p>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <!-- Start Sale Statistic area-->
    <div class="sale-statistic-area">
        <div class="container">
            <div class="row">
			<div class="col-lg-4 col-md-4 mr-0 col-sm-5 col-xs-12">
			<div class="row">
			<div class="col-sm-12" style="padding-right:0px">
                    <div class="statistic-right-area notika-shadow mg-tb-30 sm-res-mg-t-0">
                        <div class="past-day-statis">

                            <h2>Pasar Rekomendasi</h2>
                        </div>
						<hr>
                        <div class="past-statistic-an">
                            <div style="overflow:auto; height:250px; width:100%" id="rekomendasiPasar" class="past-statistic-ctn">
                            </div>
                        </div>
<!--						<hr>-->
<!--						<button style="position: relative" class="btn btn-success">Pedagang</button>-->
                    </div>

					
			</div>
			<div class="col-sm-12 col-xs-12"style="padding-right:0px">
                    <div class="statistic-right-area notika-shadow mg-tb-30 sm-res-mg-t-0">
                        <div class="past-day-statis">
                            <h2>Rute Rekomendasi</h2>
                        </div>
						<hr>
                        <div class="past-statistic-an">
                            <div style="overflow:auto; height:250px;" id="directions-panel" class="past-statistic-ctn">

                            </div>
                        </div>


                    </div>
                </div>
					
            </div>
			</div>
				
				
				
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    <div class="sale-statistic-inner notika-shadow mg-tb-30">
                        <div class="curved-inner-pro">
                            <div class="curved-ctn">
                                <h2>Maps</h2>
                            </div>
                        </div>
						<div id="map-canvas" style="width:100%; height:640px;"></div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- End Sale Statistic area-->



	<!-- Start Status area -->
	<div class="notika-status-area">
		<div class="container">
			<div class="row">


				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="cabeMerah">NaN</span></h2>
							<p>Cabe Merah</p>
						</div>
						/kg <i id="iconCabeMerah"></i>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="bawangMerah">NaN</span></h2>
							<p>Bawang Merah</p>
						</div>
						/kg <i id="iconBawangMerah"></i>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="dagingAyam">NaN</span></h2>
							<p>Daging Ayam</p>
						</div>
						/kg <i id="iconDagingAyam"></i>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="berasMedium">NaN</span></h2>
							<p>Beras Medium</p>
						</div>
						/kg <i id="iconBerasMedium"></i>
					</div>
				</div>



				<!--bagian bawah-->
				<div style="margin-top: 10px" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="bawangPutih">NaN</span></h2>
							<p>Bawang Putih</p>
						</div>
						/kg <i id="iconBawangPutih"></i>
					</div>
				</div>
				<div style="margin-top: 10px" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="cabeKeriting">NaN</span>k</h2>
							<p>Cabe Keriting</p>
						</div>
						/kg <i id="iconCabeKeriting"></i>
					</div>
				</div>
				<div style="margin-top: 10px" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="cabeRawit">NaN</span></h2>
							<p>Cabe Rawit Hijau</p>
						</div>
						/kg <i id="iconCabeRawit"></i>
					</div>
				</div>
				<div style="margin-top: 10px" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
						<div class="website-traffic-ctn">
							<h2><span id="dagingSapi">NaN</span></h2>
							<p>Daging Sapi</p>
						</div>
						/kg <i id="iconDagingSapi"></i>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- End Status area-->

<!--Modal Search -->

<div class="modal fade" id="myModalfourteen" role="dialog">
	<div class="modal-dialog modals-default">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h2>Pilih Komoditas</h2>

				<div style="width:100%" class="form-group ic-cmp-int">
					<div class="nk-int-st">
						<select id="idKom" style="border: 0px; outline: 0px;" class="form-control">
							<option value="13">Cabai Merah</option>
							<option value="cat-5">Bawang Merah</option>
							<option value="cat-2">Daging Ayam</option>
							<option value="4">Beras Medium</option>
							<option value="cat-6">Bawang Putih</option>
							<option value="13">Cabai Keriting</option>
							<option value="cat-8">Cabai Rawit</option>
						</select>
					</div>
				</div>

				<h2>Quantity</h2>

				<div style="width:100%" class="form-group ic-cmp-int">
					<div class="nk-int-st">
						<input id="qtyKom" style="border: 0px; outline: 0px;" class="form-control">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="getDataPasar()" data-dismiss="modal">Cari</button>
				<button class="btn notika-btn-gray btn-reco-mg btn-button-mg waves-effect" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!--End of modal search -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxXasmylWyKiP2KJ4PlzAjkTr23YjCC0Y" type="text/javascript"></script>

<script>
	getData();
	var dest;
	var directionsDisplay;
	var listCabeMerah;
	var latitude;
	var longitude;

	// memanggil service Google Maps Direction
	var directionsService = new google.maps.DirectionsService();
	directionsDisplay = new google.maps.DirectionsRenderer();

	$(document).ready(function() {
		var myOptions = {
			zoom: 4,
			center: new google.maps.LatLng(-2.548926,118.0148634),
			mapTypeId: google.maps.MapTypeId.ROADMAP

		};

		// posisi awal ketika halaman pertama kali dimuat
		var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

		// memanggil fungsi geocoder autocomplete
		//var autocomplete = new google.maps.places.Autocomplete((document.getElementById('dest')),{ types: ['geocode'] });

		/*
            fungsi geolocation pada geocoder ini sangat penting
            agar pencarian daerah tujuan pada textbox ga ngaco
        */

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				latitude = position.coords.latitude;
				longitude = position.coords.longitude;
				
				console.log(latitude);
				console.log(longitude);
			});
		}

	});

	function getData() {

		$.ajax({
			url: "<?= base_url() ?>Data/getDataAwal",
			type: "GET",
			cache: false,
			success: function (response) {
				// alert(response);
				if(response != ""){

					response = JSON.parse(response);
					console.log(response["prices"][1]);
					//cabe merah
					document.getElementById("cabeMerah").innerHTML = response["prices"][13]["price"];
					document.getElementById("iconCabeMerah").setAttribute('class', response["prices"][13]["icon"]);

					//bawang Merah
					document.getElementById("bawangMerah").innerHTML = response["prices"][11]["price"];
					document.getElementById("iconBawangMerah").setAttribute('class', response["prices"][11]["icon"]);

					//daging ayam
					document.getElementById("dagingAyam").innerHTML = response["prices"][7]["price"];
					document.getElementById("iconDagingAyam").setAttribute('class', response["prices"][7]["icon"]);

					//beras medium
					document.getElementById("berasMedium").innerHTML = response["prices"][3]["price"];
					document.getElementById("iconBerasMedium").setAttribute('class', response["prices"][3]["icon"]);

					//bawang putih
					document.getElementById("bawangPutih").innerHTML = response["prices"][12]["price"];
					document.getElementById("iconBawangPutih").setAttribute('class', response["prices"][12]["icon"]);

					//cabe keriting
					document.getElementById("cabeKeriting").innerHTML = response["prices"][14]["price"];
					document.getElementById("iconCabeKeriting").setAttribute('class', response["prices"][14]["icon"]);

					//cabe rawit hijau
					document.getElementById("cabeRawit").innerHTML = response["prices"][15]["price"];
					document.getElementById("iconCabeRawit").setAttribute('class', response["prices"][15]["icon"]);

					//cabe rawit hijau
					document.getElementById("dagingSapi").innerHTML = response["prices"][8]["price"];
					document.getElementById("iconDagingSapi").setAttribute('class', response["prices"][8]["icon"]);
				}else{
					alert("Error cok euy !");
				}
			}
		});
	}

	function getRoute(lat,long) {

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				console.log(position.coords.latitude);
				console.log(position.coords.longitude);
			});
		}

		dest = lat+','+long;

		var defaultLatLng = new google.maps.LatLng(-2.548926, 118.0148634);

		console.log(dest);
		/*
            nah, pada fungsi geolocation disini adalah
            ketika koordinat user berhasil didapat maka peta koordinat yang digunakan
            adalah koordinat user, namun jika tidak berhasil maka koordinat yang digunakan
            adalah koordinat default (pada variable defaultLatLng)
        */
		if (navigator.geolocation) {
			function success(pos) {
				drawMap(pos.coords.latitude, pos.coords.longitude);
			}

			function fail(error) {
				drawMap(defaultLatLng);
			}

			navigator.geolocation.getCurrentPosition(success, fail, {
				maximumAge: 500000,
				enableHighAccuracy: true,
				timeout: 6000
			});

		} else {
			drawMap(defaultLatLng);
		}
        //
		function drawMap(lat, lng) {

			var myOptions = {
				zoom: 15,
				center: new google.maps.LatLng(lat, lng),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

			// kita bikin marker untuk asal dengan koordinat user hasil dari geolocation
			var markerorigin = new google.maps.Marker({
				position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
				map: map,
				title: "Origin",
				visible: false // kita ga perlu menampilkan markernya, jadi visibilitasnya kita set false
			});

			// membuat request ke Direction Service
			var request = {
				origin: markerorigin.getPosition(), // untuk daerah asal, kita ambil posisi user
				destination: dest, // untuk daerah tujuan, kita ambil value dari textbox tujuan
				provideRouteAlternatives: true, // set true, karena kita ingin menampilkan rute alternatif


				/**
				 * kamu bisa tambahkan opsi yang lain seperti
				 * avoidHighways:true (set true untuk menghindari jalan raya, set false untuk menonantifkan opsi ini)
				 * atau kamu bisa juga menambahkan opsi seperti
				 * avoidTolls:true (set true untuk menghindari jalan tol, set false untuk menonantifkan opsi ini)
				 */
				travelMode: google.maps.TravelMode.DRIVING // set mode DRIVING (mode berkendara / kendaraan pribadi)
				/**
				 * kamu bisa ganti dengan
				 * google.maps.TravelMode.BICYCLING (mode bersepeda)
				 * google.maps.TravelMode.WALKING (mode berjalan)
				 * google.maps.TravelMode.TRANSIT (mode kendaraan / transportasi umum)
				 */
			};


			directionsService.route(request, function (response, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
				}
			});
			// menampiklkan rute pada peta dan juga direction panel sebagai petunjuk text
			directionsDisplay.setMap(map);
			directionsDisplay.setPanel(document.getElementById('directions-panel'));

			// menampilkan layer traffic atau lalu-lintas pada peta
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(map);
		}
	}

	function getDataPasar(){

		lng = longitude;
		lat = latitude;
		var cat = document.getElementById("idKom").value;
		var qty = document.getElementById("qtyKom").value;

		$.ajax({
			url: "<?= base_url() ?>Data",
			type: "POST",
			data: {
				lng:lng,
				lat:lat,
				cat:cat,
				qty:qty,
			},
			cache: false,
			success: function (response) {
				console.log(response);
				response = JSON.parse(response);
				$('#rekomendasiPasar').empty();

				for(var i in response) {
					$('#rekomendasiPasar').append('<a href="#" style="color: #00C292" onclick="getRoute('+ response[i]['Latitude'] +','+response[i]['Longitude']+')">' +
						'<h3 style="color:#00C292">'+ response[i]['Pasar'] +' &nbsp; <i class="fa fa-chevron-right"></i></h3></a>' +
						'<p>Harga Jual <span>'+ response[i]['Harga'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</span></p>' +
						'<p>Estimasi Biaya Kirim <span>'+ response[i]['Ongkir'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</span></p>' +
						'<p>Jarak <span>'+ response[i]['Jarak']/1000 +' KM</span></p><hr>');
				}


			}
		});


	}

</script>

