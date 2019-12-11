<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 23/03/2019
 * Time: 10:06
 */
class KMeansTest_model extends CI_Model
{

	private $resultFinal = array();
	private $dataHrg = array();

	public function KMeans($data, $centroid){
		$lengthData = count($data);
		$lengthCentroid = count($centroid);
		$result = array();

		echo json_encode($centroid);
		//$res = array();

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
		echo json_encode($resFind);
		//Mengembalikan nilai penuh nilai [0] merepresentasikan cluster harga tinggi
		return $this->resultFinal;


		//Mengembalikan hostory centroid


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

		return $newCentroid;

	}
}
