<?php
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
class Testing extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('KMeans_model');
	}

	private $lengthFull = 0;

	public function getDate(){
		//$date_raw = date("Y-m-d");
		$date_raw = "2019-05-06";

		$i = 0;
		while($i < 2){
			$dm[$i] = date('d-m-Y', strtotime('-1 day', strtotime($date_raw)));
			$date_raw = $dm[$i];

			if( (date('D', strtotime($dm[$i])) == 'Sun') || (date('D', strtotime($dm[$i])) == 'Sat')){
				// don't get the weekend day
			}else{
				$i++;
			}
		}

		return $dm;

	}

	public function step0(){

		// mengambil data dari web PIHPS

		$opts = array('http' =>
			array(
				'method'  => 'GET',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
			)
		);

		$context  = stream_context_create($opts);

		$htmlContent = file_get_contents('http://localhost/datasets/cabeRawit.html', false, $context);

		//echo $htmlContent;
		return $htmlContent;

	}

	public function step0p1(){

		$DOM = new DOMDocument();
		libxml_use_internal_errors(true);
		$DOM->loadHTML($this->step0());
		$Header = $DOM->getElementsByTagName('th');
		$Detail = $DOM->getElementsByTagName('td');

		//#Get header name of the table
		foreach($Header as $NodeHeader)
		{
			$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
		}

		//#Get row data/detail table without header name as key
		$i = 0;
		$j = 0;
		foreach($Detail as $sNodeDetail)
		{
			$aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
			$i = $i + 1;
			$j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
		}

		//#Get row data/detail table with header name as key and outer array index as row number
		for($i = 0; $i < count($aDataTableDetailHTML); $i++)
		{
			for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
			{
				$aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
			}
		}
		$aDataTableDetailHTML = $aTempData; unset($aTempData);

		//echo json_encode($aDataTableDetailHTML);
		$aDataTableDetailHTML['date'] = $this->getDate();

		//echo json_encode($aDataTableDetailHTML);
		return $aDataTableDetailHTML;
	}

	public function step1(){

		// mengambil data dari web PIHPS

		$dateNow = '06-05-2019';
		$postdata = http_build_query(
			array(
				'filter_province_ids' => '12',
				'filter_layout' => 'default',
				'filter_start_date' => $dateNow,
				'filter_end_date' => '09-05-2019',
				'filter_commodity_id' => 'cat-1',
				'filter_show_regency' => '1',
				'filter_show_market' => '1'
			)
		);

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context  = stream_context_create($opts);

		$htmlContent = file_get_contents('https://hargapangan.id/tabel-harga/pasar-tradisional/komoditas', false, $context);

		$DOM = new DOMDocument();
		libxml_use_internal_errors(true);
		$DOM->loadHTML($htmlContent);

		$Header = $DOM->getElementsByTagName('th');
		$Detail = $DOM->getElementsByTagName('td');

		//#Get header name of the table
		foreach($Header as $NodeHeader)
		{
			$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
		}

		//#Get row data/detail table without header name as key
		$i = 0;
		$j = 0;
		foreach($Detail as $sNodeDetail)
		{
			$aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
			$i = $i + 1;
			$j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
		}

		//#Get row data/detail table with header name as key and outer array index as row number
		for($i = 0; $i < count($aDataTableDetailHTML); $i++)
		{
			for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
			{
				$aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
			}
		}
		$aDataTableDetailHTML = $aTempData; unset($aTempData);

		//echo json_encode($aDataTableDetailHTML);

		return $aDataTableDetailHTML;
	}

	public function step2(){

		// mengubah key JSON agar lebih terstrukur dan menambahkan kota dibelakang pasar agar koordinat spesifik

		$aDataTableDetailHTML = $this->step0p1();
		$h1 = date('d/m/Y', strtotime($aDataTableDetailHTML['date'][0]));
		$h2 = date('d/m/Y', strtotime($aDataTableDetailHTML['date'][1]));

		$length = count($aDataTableDetailHTML)-1;

		$result = array();

		//Change key of JSON
		$kota = null;
		for($i = 0; $i < $length; $i++){

			if(is_numeric($aDataTableDetailHTML[$i]['No.'])){
				$kota = ', '.$aDataTableDetailHTML[$i]['Provinsi (Rp)'];
			}

			$result[$i]['Pasar'] = $aDataTableDetailHTML[$i]['Provinsi (Rp)'].$kota;

			if($aDataTableDetailHTML[$i][$h2] != '-'){
				$result[$i]['Harga'] = $aDataTableDetailHTML[$i][$h2];
			}
			if($aDataTableDetailHTML[$i][$h1] != '-'){
				$result[$i]['Harga'] = $aDataTableDetailHTML[$i][$h1];
			}
			if($aDataTableDetailHTML[$i]['06/05/2019'] != '-'){
				$result[$i]['Harga'] = $aDataTableDetailHTML[$i]["06/05/2019"];
			}

			//$result[$i]['Harga'] = $aDataTableDetailHTML[$i][date("d/m/Y")];


			$result[$i]['No'] = $aDataTableDetailHTML[$i]['No.'];
		}

		//echo json_encode($result);

		return $result;
	}

	public function step3(){

		$length = count($this->step2());
		$tempLength = $length;
		$result = $this->step2();

		//menghilangkan index semua provinsi dan jawa barat
		for($i = 0; $i < $length; $i++){
			if(is_numeric($result[$i]['No']) || $result[$i]['No'] == "I" || $result[$i]['No'] == "II"){
				unset($result[$i]);
				$tempLength--;
			}
		}

		$result[] = $tempLength;

		//mengurutkan index berdasarkan harga => DESC
		usort($result, function($a, $b) { //Sort the array using a user defined function
			return $a['Harga'] > $b['Harga'] ? -1 : 1; //Compare the scores
		});

		//echo json_encode($result);
		return $result;
	}

	public function step4(){
		$finalResult = $this->step3();
		unset($finalResult[18]);
		$KMeansRes = array();
		$kstart = 2;
		$this->lengthFull = count($finalResult);
		// cluster max = 5 karena 4 kali pengulangan dimulai dari 0 hingga 3 dimulai dari angka 2
		//2,3,4,5
		for($i=0;$i<4;$i++){
			$KMeansRes[$i] = $this->KMeans($finalResult, $kstart);
			$kstart++;
		}
		//$KMeansRes = $this->KMeans($finalResult, $kstart);
		//echo json_encode($KMeansRes);

		$silhouette = $this->silhouette($KMeansRes);

		//get key of max value on array
		$maxs = array_keys($silhouette, max($silhouette));

		//echo strongest k means and index 0 (its mean bestie group)
		//echo json_encode($silhouette);
		return $KMeansRes[0][$maxs[0]];
		//echo json_encode($KMeansRes[0][$maxs[0]]);
		//echo json_encode($silhouette);
	}

	public function KMeans($data,$k){

		//echo json_encode($data[0]["Harga"]);

		$length = count($data);

		//Menghilangkan dot pada list harga dari datasets
		for($i = 0; $i < $length; $i++){
			$data[$i]["Harga"] = str_replace(".", "", $data[$i]["Harga"]);
		}

		$centroid = $this->setCluster($data,$k);

		//echo json_encode($centroid);
		//echo json_encode($data);

//		//urutkan
		usort($centroid, function($a, $b) { //Sort the array using a user defined function
			return $a > $b ? -1 : 1; //Compare the scores
		});

//		$centroid = array($max,$min,$mid);

		$result = $this->KMeans_model->KMeans($data, $centroid);

		return $result;

	}

	public function silhouette($KMeansRes){

		$biBefore = array();
		$data = $KMeansRes;
		for($x=0;$x<count($data);$x++) {
			$i = 0;
			$fs = 0;
			$counter = 0;
			while ($i < count($data[$x][0])) {
				$u = $i + 1;
				$length = count($data[$x][0]);
				while ($u < $length) {
					$fs = $fs + sqrt(pow($data[$x][0][$i]["Harga"] - $data[$x][0][$u]["Harga"], 2));
					//echo "\r\n".$data[$x][0][$i]["Harga"].' - '.$data[$x][0][$u]["Harga"].' = '.$fs;
					$u++;
					$counter++;
				}

				$i++;
			}


			$ai[] = $fs/$counter;
			//echo "Nilai a(i) dengan K = ".($x+2)." adalah ".$ai[$x]."\r\n";
//			echo 'Times loop'.$counter;
//			echo "\r\n";
			//echo $counter;
		}
		//echo json_encode($ai);
//		$res = 0;
//		for($t=1;$t<count($data[0]);$t++){
//			$counter = 0;
//			for($r=count($data[0][$t-1]);$r<$this->lengthFull;$r++){
//				$x = 0;
//				while($x<count($data[0][$t-1])){
//					$res += $data[0][$t][$r]['Harga']+$data[0][$t-1][$x]['Harga'];
//					//echo $data[0][$t][$r]['Harga'].' banding '.$data[0][$t-1][$x]['Harga']."\r\n";
//					$x++;
//					$counter++;
//					//echo $x."\r\n";
//				}
//				//echo $r."\r\n";
//			}
//			$bi[] = $res/$counter;
//			//echo $counter;
//		}

		for($y=0;$y<count($data);$y++){

			$coun=count($data[$y][0]);
			$divider = 0;
			for($t=1;$t<count($data[$y]);$t++){
				$counter = 0;
				$res = 0;
				for($r=0;$r<count($data[$y][$t]);$r++){
					$x = 0;
					while($x<count($data[$y][0])){
						$res += sqrt(pow($data[$y][$t][$coun]['Harga']-$data[$y][0][$x]['Harga'],2));
						//echo $data[$y][0][$x]['Harga']."\r\n";
						$x++;
						$counter++;
						//echo $x."\r\n";
					}
					$coun++;


				}

				//echo 'proses'.$y.' cluster 0, banding '.$t."\r\n";
				$biBefore[$divider] = $res/$counter;
				$divider++;
				//echo $divider. ". ".$res/$counter."\r\n";
			}

			//echo "batas d(i) untuk K = ".($y+2)."\r\n";

			//echo json_encode($biBefore);
			$bi[$y] = min($biBefore);

			//echo "b(i) untuk K = ".($y+2)." adalah = ".$bi[$y]."\r\n";
			//$bi[$y] = $biBefore

		}



		for($length=0;$length<count($bi);$length++){
			$si[$length] = ($bi[$length]-$ai[$length])/max($bi[$length],$ai[$length]);
			//echo "s(i) untuk K = ".($length+2)." adalah = ".$si[$length]."\r\n";
		}

		//echo json_encode($si);

		return $si;

		//echo json_encode($ai);

		//echo json_encode($data0[1][12]);
		//echo json_encode($data0[0][10]);
		//echo json_encode($data0);

		//echo count($data0[1]);
	}

	public function step5(){

		$finalResult = array();
		$result = $this->step4();
		$length2 = count($result);
		//Mengambil Long Lat
		for($i = 0; $i < $length2; $i++){
			$geo = $this->getGeo($result[$i]['Pasar']);
			$finalResult[$i]['Pasar'] = $result[$i]['Pasar'];
			$finalResult[$i]['Harga'] = $result[$i]['Harga'];
			$finalResult[$i]['Longitude'] = $geo['Longitude'];
			$finalResult[$i]['Latitude'] = $geo['Latitude'];
		}

		//echo json_encode($finalResult);
		return $finalResult;
	}

	public function getGeo($location){
		$httpClient = new \Http\Adapter\Guzzle6\Client();
		$provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient);
		$geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');
		$result = $geocoder->geocodeQuery(GeocodeQuery::create($location));
		$Longitude = $result->first()->getCoordinates()->getLongitude();
		$Latitude = $result->first()->getCoordinates()->getLatitude();
		$coordinates = array(
			'Longitude' => $Longitude,
			'Latitude' => $Latitude
		);
		return $coordinates;
	}

	public function step6(){

		$finalResult = $this->step5();
		$length2 = count($finalResult);
		$LatOri = -6.8981702;
		$LongOri = 107.63521499999999;

		//Mengambil Jarak menggunakan matrix distance
		for($z = 0; $z < $length2; $z++){
			$finalResult[$z]['Jarak'] = $this->distance($LatOri,$LongOri,
				$finalResult[$z]['Latitude'],$finalResult[$z]['Longitude']);
		}

		echo json_encode($finalResult);

		return $finalResult;
	}

	public function step7(){
		$finalResult = $this->step6();
		$length2 = count($finalResult);

		for($z = 0; $z < $length2; $z++){
			$finalResult[$z]['Ongkir'] = $this->ongkirCount($finalResult[$z]['Jarak']);
		}

		//echo json_encode($finalResult);
		return $finalResult;

	}

	public function step8(){

		$qty = 100;

		//final shorting
		$finalResult = $this->step7();
		$length2 = count($finalResult);

		for($z = 0; $z < $length2; $z++){
			$finalResult[$z]['HargaFinal'] = ($finalResult[$z]['Harga']*$qty)-$finalResult[$z]['Ongkir'];
		}

		usort($finalResult, function($a, $b) { //Sort the array using a user defined function
			return $a['HargaFinal'] > $b['HargaFinal'] ? -1 : 1; //Compare the scores
		});

		echo json_encode($finalResult);

	}

	public function distance($LatOri,$LongOri,$LatDes,$LongDes){

		$distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.$LatOri.','.$LongOri.'&destinations='.$LatDes.','.$LongDes.'&key=AIzaSyAxXasmylWyKiP2KJ4PlzAjkTr23YjCC0Y');
		$distance_arr = json_decode($distance_data);
		$result = $distance_arr->rows;

		//result is a distance on Meter
		return $result[0]->elements[0]->distance->value;
	}

	public function ongkirCount($distance){

		if($distance <= 10000){
			$ongkir = 170000;
		}else{
			$distance = $distance - 10000;

			$ongkir = 170000;
			if($distance >= 5000){
				$distance = $distance/5000;
				if(round($distance == 0)){
					$distance = 1;
				}
				$ongkir = $ongkir+(round($distance)*12000);
			}else{
				$ongkir = $ongkir+12000;
			}
		}
		return $ongkir;
	}

	public function random(){
		$max = 41000;
		$min = 29000;
		for ($i = 0; $i < 3; $i++){
			$ran[] = round(mt_rand($min, $max));
		}

		usort($ran, function($a, $b) { //Sort the array using a user defined function
			return $a > $b ? -1 : 1; //Compare the scores
		});

		echo json_encode($ran);

	}

	public function getMin(){
		for($t=0;$t<3;$t++){
			$res[] = round(mt_rand(1, 100));
		}

		$fRes['data'] = $res;

		$fRes['min'] = min($res);

		echo json_encode($fRes) ;
	}

	public function perbandingan(){

		$res = round(3/2);

		echo $res;
	}

	public function setCluster($data,$k){

		//manual
//		$length = count($data);
//		$max = $data[0]["Harga"];
//		$min = $data[$length-1]["Harga"];
//		$space = floor(($max-$min)/($k-1));
//		$cluster[0] = $max;
//		for($i=1;$i<$k;$i++){
//			$cluster[$i] = floor($max-$space);
//			$max -= $space;
//		}

		//kuartil

		for($i = 0; $i < count($data)-2; $i++){
			$data[$i]["Harga"] = str_replace(".", "", $data[$i]["Harga"]);
		}
		$cluster = array();

		if($k<5){
			$cluster[0] = $data[0]["Harga"];
			for ($i=1;$i<$k;$i++){
				$tempKey = (($i*((count($data)-1)+1))/4);
				$format = number_format($tempKey, 2);
				$exploder = explode('.', $format);

				if($exploder[1] > 0){
					//echo $nextData;
					//echo $tempKey-$exploder[0];
					//echo $data[$exploder[0]]["Harga"]."\r\n";
					//echo $data[$nextData]["Harga"]."\r\n";
					//echo $data[$exploder[0]-1]["Harga"] - $data[$exploder[0]]["Harga"]."\r\n";
					$cluster[$i] = $data[$exploder[0]-1]["Harga"] - (($tempKey-$exploder[0])*($data[$exploder[0]-1]["Harga"]-$data[$exploder[0]]["Harga"]));
				}else{
					$cluster[$i] = $data[$tempKey]["Harga"];
				}
				//$cluster[$i] = $data[$exploder[0]]+($data[$exploder[0]]);
			}
		}else{
			$cluster[0] = $data[0]["Harga"];
			for ($i=1;$i<$k-1;$i++){
				$tempKey = (($i*((count($data)-1)+1))/4);
				$format = number_format($tempKey, 2);
				$exploder = explode('.', $format);

				if($exploder[1] > 0){
					//echo $nextData;
					//echo $tempKey-$exploder[0];
					//echo $data[$exploder[0]]["Harga"]."\r\n";
					//echo $data[$nextData]["Harga"]."\r\n";
					//echo $data[$exploder[0]-1]["Harga"] - $data[$exploder[0]]["Harga"]."\r\n";
					$cluster[$i] = $data[$exploder[0]-1]["Harga"] - (($tempKey-$exploder[0])*($data[$exploder[0]-1]["Harga"]-$data[$exploder[0]]["Harga"]));
				}else{
					$cluster[$i] = $data[$tempKey]["Harga"];
				}
				//$cluster[$i] = $data[$exploder[0]]+($data[$exploder[0]]);
			}
			$cluster[4] = $data[count($data)-2]["Harga"];
		}



		//random
//		$length = count($data);
//		$max = $data[0]["Harga"];
//		$min = $data[$length-1]["Harga"];
//		for ($i=0; $i<$k;$i++){
//			$cluster[$i] = round(rand($min,$max));
//		}

		//random+manual
//		$length = count($data);
//		$max = $data[0]["Harga"];
//		$min = $data[$length-1]["Harga"];
//		$space = floor(($max-$min)/($k-1));
//		$cluster[0] = $max;
//		for($i=1;$i<$k;$i++){
//			$cluster[$i] = round(rand($max-$space, $max));
//			$max -= $space;
//		}

		//echo json_encode($cluster);
		return $cluster;
	}

	public function randomC(){

		$k = 3;
		$max = 42000;
		$min = 22000;
		$space = floor(($max-$min)/($k-1));
		$cluster[0] = $max;
		for($i=1;$i<$k;$i++){
			$cluster[$i] = rand($max-$space,$max);
			$max -= $space;
		}

		echo json_encode($cluster);
	}

	public function setComa(){
		$number = 123.5;

		$format = number_format($number, 2);

		$coma = explode('.', $format);

//		if($coma[1] > 0){
//			echo "cek";
//		}else{
//			echo "no";
//		}

		$cek = $number - $coma[0];

		echo $cek;
		//echo json_encode($coma[1]);
	}

}
