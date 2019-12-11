
<?php

class Login extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$this->load->view('page_login');
	}

	public function login(){
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$response = $this->Users_model->login($username, $password);

		if(count($response) > 0){
			$loginData = array(
				"username" => $response[0]['username'],
				"idUsers" => $response[0]['idUsers']);
			$this->session->set_userdata($loginData);

			$LastAndToken = array(
				'token' => md5(date("Y-m-d h:i:sa").$response[0]['username']),
				'lastLogin' => date("Y-m-d h:i:sa")
			);
			$result2 = $this->Users_model->updateData($this->session->userdata('idUsers'),$LastAndToken);

			if($result2 > 0){
				echo "Ok";
			}else{
				echo "Failed";
			}

		}else{
			echo "Failed";
		}
	}

	public function register(){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$noHp = $_POST['noHp'];
		$lokasi = $_POST['lokasi'];

		$data = array(
			'username' => $username,
			'password' => $password,
			'nohp' => $noHp,
			'lokasi' => $lokasi
		);

		$response = $this->Users_model->register($data);

		if($response > 0){
			echo "Ok";
		}else{
			echo "Failed";
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Login/', 'refresh');
	}
}

?>
