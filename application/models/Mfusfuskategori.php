<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfusfuskategori extends CI_Model {
	public function getALlCategory() {
		$query = "SELECT * FROM `category` ";
		return $this->db->query($query)->result_array();
	}

	public function InsertData($tableName, $data) {
		$res = $this->db->insert($tableName,$data);
		return $res;
	}

	public function getCategoryById($id) {
		$query = "SELECT * FROM `category` WHERE `id` = ".$id;
		return $this->db->query($query)->row_array();
	}

	public function UpdateData($tableName, $data,$where) {
		$res = $this->db->Update($tableName,$data,$where);
		return $res;
	}

	public function DeleteData($tableName, $where) {
		$res = $this->db->Delete($tableName,$where);
		return $res;
	}

}

?>