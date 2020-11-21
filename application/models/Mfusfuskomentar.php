<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfusfuskomentar extends CI_Model {
		public function InsertData($tableName, $data) {
		$res = $this->db->insert($tableName,$data);
		return $res;
	}
}