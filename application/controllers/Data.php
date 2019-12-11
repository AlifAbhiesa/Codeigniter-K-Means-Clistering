<?php

use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

class Data extends CI_Controller
{

	function __construct(){
        parent::__construct();
        $this->load->model('KMeans_model');
    }


	public function index(){

		$LatOri = $_POST['lat'];
		$LongOri = $_POST['lng'];
		$cat = $_POST['cat'];
		$qty = $_POST['qty'];

		//echo $LongOri;
		echo json_encode($this->preProcessing($LatOri,$LongOri,$cat,$qty));
	}

	public function getDate($date_raw){
		//$date_raw = "2019-05-06";

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

	public function preProcessing($LatOri,$LongOri,$cat,$qty){

		$condition = true;

		$dateNow = "22-05-2019";
		if($this->getHours() < 18){
			$dateNow = date('Y-m-d', strtotime('-1 day', strtotime($dateNow)));
		}

		while ($condition){
			if( (date('D', strtotime($dateNow)) == 'Sun') || (date('D', strtotime($dateNow)) == 'Sat')){
				$dateNow = date('Y-m-d', strtotime('-1 day', strtotime($dateNow)));
			}else{
				$condition = false;
			}
		}

		$date = $this->getDate(date("Y-m-d",strtotime($dateNow)));
		$postdata = http_build_query(
			array(
				'filter_province_ids' => '12',
				'filter_layout' => 'default',
				'filter_start_date' => $date[1],
				'filter_end_date' => $dateNow,
				'filter_commodity_id' => $cat,
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


		$length = count($aDataTableDetailHTML);

		$result = array();

		//Change key of JSON
		$kota = null;
		for($i = 0; $i < $length; $i++){

			if(is_numeric($aDataTableDetailHTML[$i]['No.'])){
				$kota = ', '.$aDataTableDetailHTML[$i]['Provinsi (Rp)'];
			}

			$result[$i]['Pasar'] = $aDataTableDetailHTML[$i]['Provinsi (Rp)'].$kota;

			if($aDataTableDetailHTML[$i][date("d/m/Y", strtotime($date[1]))] != '-'){
				$result[$i]['Harga'] = $aDataTableDetailHTML[$i][date("d/m/Y", strtotime($date[1]))];
			}
			if($aDataTableDetailHTML[$i][date("d/m/Y", strtotime($date[0]))] != '-'){
				$result[$i]['Harga'] = $aDataTableDetailHTML[$i][date("d/m/Y", strtotime($date[0]))];
			}
			if($aDataTableDetailHTML[$i][date("d/m/Y", strtotime($dateNow))] != '-'){
				$result[$i]['Harga'] = $aDataTableDetailHTML[$i][date("d/m/Y", strtotime($dateNow))];
			}

			//$result[$i]['Harga'] = $aDataTableDetailHTML[$i][date("d/m/Y")];


			$result[$i]['No'] = $aDataTableDetailHTML[$i]['No.'];
		}



		//get Pasar only
		for($i = 0; $i < $length; $i++){
			if(is_numeric($result[$i]['No']) || $result[$i]['No'] == "I" || $result[$i]['No'] == "II"){
				unset($result[$i]);
			}
		}

		//shorting
		usort($result, function($a, $b) { //Sort the array using a user defined function
			return $a['Harga'] > $b['Harga'] ? -1 : 1; //Compare the scores
		});


		$kstart = 2;
		for($i=0;$i<4;$i++){
			$KMeans[$i] = $this->KMeans($result, $kstart);
			$kstart++;
		}

		//echo json_encode($KMeans);

		$silhouette = $this->silhouette($KMeans);

		//get key of max value on array
		$maxs = array_keys($silhouette, max($silhouette));

		//mengambil nilai si yang mendekati 1
		$KMeansRes = $KMeans[$maxs[0]][0];

		//echo json_encode($KMeansRes);
		// length2 = banyak index array kelompok harga tertinggi
		$length2 = count($KMeansRes);

		$finalResult = array();

		//Mengambil Long Lat
		for($i = 0; $i < $length2; $i++){
			$geo = $this->getGeo($KMeansRes[$i]['Pasar']);
			$finalResult[$i]['Pasar'] = $KMeansRes[$i]['Pasar'];
			$finalResult[$i]['Harga'] = $KMeansRes[$i]['Harga'];
			$finalResult[$i]['Longitude'] = $geo['Longitude'];
			$finalResult[$i]['Latitude'] = $geo['Latitude'];
		}

		//Mengambil Jarak
		for($z = 0; $z < $length2; $z++){
			$finalResult[$z]['Jarak'] = $this->distance($LatOri,$LongOri,
				$finalResult[$z]['Latitude'],$finalResult[$z]['Longitude']);
		}

		//Menentukan ongkir
		for($z = 0; $z < $length2; $z++){
			$finalResult[$z]['Ongkir'] = $this->ongkirCount($finalResult[$z]['Jarak']);
		}

		//get Final Price
		for($z = 0; $z < $length2; $z++){
			$finalResult[$z]['HargaFinal'] = ($finalResult[$z]['Harga']*$qty)-$finalResult[$z]['Ongkir'];
		}

		//final shorting
		usort($finalResult, function($a, $b) { //Sort the array using a user defined function
			return $a['HargaFinal'] > $b['HargaFinal'] ? -1 : 1; //Compare the scores
		});

		//echo json_encode($finalResult[0]);
		return $finalResult;
		die();
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

	public function KMeans($data,$k){

		$length = count($data);

		//Menghilangkan dot pada list harga dari datasets
		for($i = 0; $i < $length; $i++){
			$data[$i]["Harga"] = str_replace(".", "", $data[$i]["Harga"]);
		}

		$centroid = $this->setCluster($data,$k);

		//urutkan
		usort($centroid, function($a, $b) { //Sort the array using a user defined function
			return $a > $b ? -1 : 1; //Compare the scores
		});

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
				//echo "\r\n";
				$i++;
			}
			$ai[] = $fs / $counter;
			//echo $counter;
		}

		for($y=0;$y<count($data);$y++){
			$res = 0;
			$coun=count($data[$y][0]);
			$divider = 0;
			for($t=1;$t<count($data[$y]);$t++){
				$counter = 0;
				for($r=0;$r<count($data[$y][$t]);$r++){
					$x = 0;
					while($x<count($data[$y][0])){
						$res += $data[$y][$t][$coun]['Harga']+$data[$y][0][$x]['Harga'];
						//echo $data[0][$t][$r]['Harga'].' banding '.$data[0][$t-1][$x]['Harga']."\r\n";
						$x++;
						$counter++;
						//echo $x."\r\n";
					}
					$coun++;
					//echo $coun."\r\n";
				}
				$biBefore[$divider] = $res/$counter;
				$divider++;
			}

			$bi[$y] = min($biBefore);
		}

		for($length=0;$length<count($bi);$length++){
			$si[$length] = ($bi[$length]-$ai[$length])/max($bi[$length],$ai[$length]);
		}

		return $si;
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

	public function getDataAwal(){

		$distance_data = file_get_contents('https://hargapangan.id/index.php?option=com_gtpihps&task=json.commodityPrices&province_id=12&price_type_id=1');
		$distance_arr = json_decode($distance_data);
		$result = $distance_arr;

		echo json_encode($result);

	}

	public function setCluster($data,$k){

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

					$cluster[$i] = $data[$exploder[0]-1]["Harga"] - (($tempKey-$exploder[0])*($data[$exploder[0]-1]["Harga"]-$data[$exploder[0]]["Harga"]));
				}else{
					$cluster[$i] = $data[$tempKey]["Harga"];
				}
			}
			$cluster[4] = $data[count($data)-2]["Harga"];
		}

		//echo json_encode($cluster);
		return $cluster;
	}

	public function getHours(){
		date_default_timezone_set('ASIA/JAKARTA');
		return date('H');
	}

	public function cekDate(){
		$dateNow = date('Y-m-d');
		if($this->getHours() < 18){
			$dateNow = date('Y-m-d', strtotime('-1 day', strtotime($dateNow)));
		}

		echo $dateNow;
	}


}


?>
