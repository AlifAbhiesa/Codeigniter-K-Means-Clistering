<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 06/04/2019
 * Time: 16:48
 */
class Request extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->model('Request_model');
	}

	public function addRequest(){
		$idUsers = $this->session->userdata('idUsers');
		$idKomoditas = $_POST['idKomoditas'];
		$dateRequest = date("Y-m-d", strtotime($_POST['dateRequest']));
		$priceRequest = $_POST['priceRequest'];

		$data = array(
			'idUsers' => $idUsers,
			'idKomoditas' => $idKomoditas,
			'dateRequest' => $dateRequest,
			'priceRequest' => $priceRequest
		);

		$response = $this->Request_model->addData($data);

		if($response > 0){
			echo "Ok";
		}else{
			echo "Failed";
		}
	}

	public function deleteRequest(){
		$idRequest = $_POST['idRequest'];

		$data = array(
			'active' => 'N',
		);

		$response = $this->Request_model->updateData($idRequest, $data);

		if($response > 0){
			echo "Ok";
		}else{
			echo "Failed";
		}
	}

}
