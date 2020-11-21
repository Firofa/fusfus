<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfusfusjualanmodel extends CI_Model {
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

	public function getCategoryName() {
		$query = "SELECT `barang_jualan`.*, `category`.`category`
				 FROM `category` JOIN `barang_jualan` ON `category`.`id` = `barang_jualan`.`id_category` WHERE `category`.`jenis_category` = 'jualan' 
		";

		return $this->db->query($query)->result_array();
	}

	public function getDataJualanById($id) {
		$query = "SELECT `barang_jualan`.*, `category`.`category`
				 FROM `category` JOIN `barang_jualan` ON `category`.`id` = `barang_jualan`.`id_category` WHERE `category`.`jenis_category` = 'jualan' AND `barang_jualan`.`kode_barang_jualan` =  
		".$id;

		return $this->db->query($query)->row_array();
	}

	public function getDataTukarById($id) {
		$query = "SELECT `barang_tukar`.*, `category`.`category` FROM `category` JOIN `barang_tukar` ON `category`.`id`  = `barang_tukar`.`id_category` WHERE `category`.`jenis_category` = 'penukaran' AND `barang_tukar`.`kode_barang_tukar` = ".$id;

		return $this->db->query($query)->row_array();
	}

	public function getDataSampahById($id) {
		$query = "SELECT `barang_sampah`.*, `category`.`category` FROM `category` JOIN `barang_sampah` ON `category`.`id`  = `barang_sampah`.`id_category` WHERE `category`.`jenis_category` = 'sampah' AND `barang_sampah`.`kode_barang_sampah` = ".$id;

		return $this->db->query($query)->row_array();
	}

	public function getCategoryTypeJualan() {
		$query = "SELECT * FROM `category` WHERE `jenis_category` = 'jualan' ";
		return $this->db->query($query)->result_array();
	}

	public function getCategoryTypeTukar() {
		$query = "SELECT * FROM `category` WHERE `jenis_category`= 'penukaran' ";
		return $this->db->query($query)->result_array();
	}

	public function getCategoryTypeSampah() {
		$query = "SELECT * FROM `category` WHERE `jenis_category` = 'sampah' ";
		return $this->db->query($query)->result_array();
	}

	public function getCategoryTukarName() {
		$query = "SELECT `barang_tukar`.*,`category`.`category` FROM `category` JOIN `barang_tukar` ON `category`.`id` = `barang_tukar`.`id_category` ";
		return $this->db->query($query)->result_array();
	}

	public function getCategorySampahName() {
		$query = "SELECT `barang_sampah`.*,`category`.`category` FROM `category` JOIN `barang_sampah` ON `category`.`id` = `barang_sampah`.`id_category`";
		return $this->db->query($query)->result_array();
	}

	public function getPemesananDetail() {
		$query = "SELECT * FROM `pemesanan_kerajinan` JOIN `barang_jualan` ON `pemesanan_kerajinan`.`kode_barang_pesan` = `barang_jualan`.`kode_barang_jualan` JOIN `users` ON `pemesanan_kerajinan`.`id_user` = `users`.`id`";
		return $this->db->query($query)->result_array();
	}

	public function getPermintaanTukarDetail() {
		$query = "SELECT * FROM `permintaan_tukar_saldo` JOIN `barang_tukar` ON `permintaan_tukar_saldo`.`id_barang_tukar` = `barang_tukar`.`kode_barang_tukar` JOIN `users` ON `permintaan_tukar_saldo`.`id_user` = `users`.`id` ";
		return $this->db->query($query)->result_array();
	}

	public function getPermintaanTambahSaldoDetail() {
		$query = "SELECT * FROM `permintaan_tambah_saldo` JOIN `barang_sampah` ON `permintaan_tambah_saldo`.`id_barang_sampah` = `barang_sampah`.`kode_barang_sampah` JOIN `users` ON `permintaan_tambah_saldo`.`id_user` = `users`.`id` ";
		return $this->db->query($query)->result_array();
	}

	public function getAllKomentar() {
		$query = "SELECT * FROM `komentar_jualan` JOIN `barang_jualan` ON `komentar_jualan`.`kode_barang_jualan` = `barang_jualan`.`kode_barang_jualan` JOIN `users` ON `komentar_jualan`.`id_user` = `users`.`id`";
		return $this->db->query($query)->result_array();

	}

	public function getAllKeluhan() {
		$query = "SELECT * FROM `keluhan_user` JOIN `users` ON `keluhan_user`.`id_user` = `users`.`id`";
		return $this->db->query($query)->result_array();
	}

}
