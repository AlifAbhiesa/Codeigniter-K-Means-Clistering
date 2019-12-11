<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$data = array('isi' => 'default/index', 'title' => 'Aset');
		// $data['list_komoditas'] = $this->Dashboard_model->getKomoditas();
		//$data = json_decode($data['pricing'], true);
		//echo json_encode($data['pricing'][0]['date']);
		$this->load->view('layout/wrapper', $data);
	}
}
