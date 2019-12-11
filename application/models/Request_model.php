<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 06/04/2019
 * Time: 16:09
 */
class Request_model extends CI_Model
{

	public function updateData($id, $data){
		$this->db->where('idRequest', $id);
		$this->db->update('request', $data);
		return $this->db->affected_rows();
	}

	public function addData($data){
		$this->db->insert('request', $data);
		return $this->db->affected_rows();
	}

}
