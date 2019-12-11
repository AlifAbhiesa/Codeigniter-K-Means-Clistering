<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 06/04/2019
 * Time: 16:09
 */
class Users_model extends CI_Model
{
	public function login($username, $password){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('username' => $username, 'password' => $password, 'active' => 'Y'));
		return $this->db->get()->result_array();
	}

	public function updateData($id, $data){
		$this->db->where('idUsers', $id);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}

	public function register($data){
		$this->db->insert('users', $data);
		return $this->db->affected_rows();
	}

}
