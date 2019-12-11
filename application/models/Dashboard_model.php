<?php
/**
 * Created by IntelliJ IDEA.
 * User: UnixMan
 * Date: 30/03/2019
 * Time: 12:10
 */
class Dashboard_model extends CI_Model
{

	public function getKomoditas(){
		$this->db->select('*');
		$this->db->from('komoditas');
		$this->db->where(array('active' => 'Y'));
		return $this->db->get()->result_array();
	}
}
