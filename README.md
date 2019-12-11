# K Means Clustering Implemented On Codeigniter To Find Strategic Market

<b><h2>Installation</h2></b>
<p>1 .You need to install composer, <a href="https://getcomposer.org/download/"> Read how to install composer</a></p>
<p>2. Install git, <a href="https://gist.github.com/derhuerst/1b15ff4652a867391f03"> Read how to install git</a></p>
<p>3. Clone repository with git</p>

```bash
git clone https://github.com/AlifAbhiesa/Codeigniter-K-Means-Clistering.git
```
<p><b>4. Create your own Google API</b></p>
You need 3 google API, google maps API to show routes, geocoding for translating address into Geographic Coordinates, and Distance matrix to provides distance between two place. Read how to get the API <p>
<p>4.1. <a href="https://developers.google.com/maps/documentation/javascript/tutorial"> Read how to setup Google Maps API </a><p>
<p>4.1. <a href="https://developers.google.com/maps/documentation/geocoding/start"> Read how to setup Geocoding API </a><p>
<p>4.1. <a href="https://developers.google.com/maps/documentation/distance-matrix/start"> Read how to setup Distance Matrix API </a><p>
<p> <b>5. Configure Google API in your code </b><p>
<p> 5.1. Placing Maps API<p>
<p> Open file /application/views/default/index.php and place your API key here</p>

```html
 <script src="https://maps.googleapis.com/maps/api/js?key= YOUR API KEY" type="text/javascript"></script>
 ```
 
<p> 5.2. Placing Geocoding API<p>
<p> Open file /application/controller/Data.php and place your API key here</p>

```php
public function getGeo($location){
 $httpClient = new \Http\Adapter\Guzzle6\Client();
 $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, ' YOUR API KEY ');
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
 ```
 
<p> 5.2. Placing Distance Matrix API<p>
<p> Open file /application/controller/Data.php and place your API key here</p>

```php
public function distance($LatOri,$LongOri,$LatDes,$LongDes){
 $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.
 $LatOri.','.$LongOri.'&destinations='.$LatDes.','.$LongDes.'&key= YOUR API KEY');
 $distance_arr = json_decode($distance_data);
 $result = $distance_arr->rows;
 //result is a distance on Meter
 return $result[0]->elements[0]->distance->value;
}
 ```

<b><h2>Methode</h2></b>
<p> In this application i'm using 2 methode. K Means clustering to create the cluster of data, and Silhouette Coefficient to test the result cluster of K Means clustering. If you want to understand the flow of that method, you need to read this paper
<p> <a href="https://www.sciencedirect.com/science/article/pii/S1875389212006220"> 1. Paper of K Means Clustering </a>
<p> <a href="https://www.sciencedirect.com/science/article/pii/0377042787901257" > 2. Paper of Silhouette Coefficient </a>
<p><h3><b> Code of Methode K Means Clustering Implemented On Codeigniter </b></h3>
<p> Controller</p>
```php
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
```
<p> Model</p>
```php
class KMeans_model extends CI_Model
{

	private $resultFinal = array();
	private $dataHrg = array();

	public function KMeans($data, $centroid){
		$lengthData = count($data);
		$lengthCentroid = count($centroid);
		$result = array();

		//echo json_encode($centroid);

		//Euclidean Distance
		for($x = 0; $x < $lengthCentroid; $x++){
			for($i = 0; $i < $lengthData; $i++) {
				$result[$x][$i]["Harga"] = sqrt(pow($centroid[$x]-$data[$i]["Harga"],2));
			}
		}


		//Mengelompokkan data
		for($x = 0; $x < $lengthData; $x++){

			for($num = 0; $num < $lengthCentroid; $num++){
				$this->dataHrg[$num] = $result[$num][$x]["Harga"];
			}
			$fRes = min($this->dataHrg);
			for($i = 0; $i < $lengthCentroid; $i++){
				if($result[$i][$x]["Harga"] == $fRes){
					$res[$i][$x]["Harga"] = $data[$x]["Harga"];
					$res[$i][$x]["Pasar"] = $data[$x]["Pasar"];
				}
			}
		}

		//menampilkan jarak iterasi awal
		//echo json_encode($result);

//		//Bentuk Centroid Baru
		for($i = 0; $i < $lengthCentroid; $i++){
			$sum = array_sum(array_column($res[$i],'Harga'));
			$newCentroid[] = $sum/count($res[$i]);
		}



		$resFind[] = $newCentroid;

		$loop = true;
		$z = 1;
		while($loop){
			if($z == 1){
				// iterasi kedua dibandingkan dengan centroid pertama
				$resFind[$z] = $this->findNewCentroid($data, $newCentroid);
			}else{
				// iterasi ketiga dibandingkan dengan centroid kedua, dst.
				$resFind[$z] = $this->findNewCentroid($data, $resFind[$z-1]);
			}
			//$resbro['iterasi'.$z] = $data;
			//$resFind[$z-1] = $resFind[$z];
			if($resFind[$z-1] == $resFind[$z]){
				$loop = false;
			}
			$z++;
		}

		//Mengembalikan hostory centroid
		//echo json_encode($resFind);

		//echo $z-1;
		//Mengembalikan nilai penuh nilai [0] merepresentasikan cluster harga tinggi
		return $this->resultFinal;




	}

	public function findNewCentroid($data, $centroid){

		$lengthData = count($data);
		$lengthCentroid = count($centroid);
		$result = array();

		//Euclidean Distance
		for($x = 0; $x < $lengthCentroid; $x++){
			for($i = 0; $i < $lengthData; $i++) {
				$result[$x][$i]["Harga"] = sqrt(pow($centroid[$x]-$data[$i]["Harga"],2));
			}
		}

		//menampilkan jarak iterasi 1 dst.
		//echo json_encode($result);

		//Mengelompokkan data
		for($x = 0; $x < $lengthData; $x++){

			//membuat data harga menjadi array
			for($num = 0; $num < $lengthCentroid; $num++){
				$this->dataHrg[$num] = $result[$num][$x]["Harga"];
			}
			$fRes = min($this->dataHrg);
			for($i = 0; $i < $lengthCentroid; $i++){
				//kelompokkan kedalam jarak yang terdekat
				if($result[$i][$x]["Harga"] == $fRes){
					$res[$i][$x]["Harga"] = $data[$x]["Harga"];
					$res[$i][$x]["Pasar"] = $data[$x]["Pasar"];
				}
			}
		}

		// Menyimpan kelompok data baru pada variabel kelas
		$this->resultFinal = $res;

		//Bentuk Centroid Baru
		for($i = 0; $i < $lengthCentroid; $i++){
			$sum = array_sum(array_column($res[$i],'Harga'));
			$newCentroid[] = $sum/count($res[$i]);
		}

		//echo json_encode($newCentroid);

		return $newCentroid;

	}
}

```
<p><h3><b> Code of Methode Silhouette Coefficient Implemented On Codeigniter </b></h3>
<p> Controller </p>
```php
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
```
