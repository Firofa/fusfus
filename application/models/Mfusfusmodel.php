<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfusfusmodel extends CI_Model {

	public function InsertData($tableName, $data) {
		$res = $this->db->insert($tableName,$data);
		return $res;
	}

	public function UpdateData($tableName, $data,$where) {
		$res = $this->db->Update($tableName,$data,$where);
		return $res;
	}

	public function DeleteData($tableName, $where) {
		$res = $this->db->Delete($tableName,$where);
		return $res;
	}

	public function GetData($table, $where) {
		$data = $this->db->get_where($table,$where);
		return $data->result_array();
	}

	public function GetJumlahPesanan() {
		$query = "SELECT * FROM `pemesanan_kerajinan` WHERE `status` != 'Selesai'";
		return $this->db->query($query)->num_rows();
	}

	public function GetJumlahPenambahan() {
		$query = "SELECT * FROM `permintaan_tambah_saldo` WHERE `status` != 'Selesai'";
		return $this->db->query($query)->num_rows();
	}

	public function GetJumlahPenukaran() {
		$query = "SELECT * FROM `permintaan_tukar_saldo` WHERE `status` != 'Selesai'";
		return $this->db->query($query)->num_rows();
	}

	public function GetJumlahKomentar() {
		$query = "SELECT * FROM `komentar_jualan`";
		return $this->db->query($query)->num_rows();
	}

	public function GetJumlahKeluhan() {
		$query = "SELECT * FROM `keluhan_user`";
		return $this->db->query($query)->num_rows();
	}
}
