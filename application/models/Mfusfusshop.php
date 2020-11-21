<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfusfusshop extends CI_Model {

public function getAllDataKerajinan() {
	$query = "SELECT * FROM `barang_jualan` JOIN `category` ON `barang_jualan`.`id_category` = `category`.`id`";
	return $this->db->query($query)->result_array();
}


public function getAllDataPenukaranSampah() {
	$query = "SELECT * FROM `barang_tukar` JOIN `category` ON `barang_tukar`.`id_category` = `category`.`id`";
	return $this->db->query($query)->result_array();
}

public function getAllDataOpsiTambahSaldo() {
	$query = "SELECT * FROM `barang_sampah` JOIN `category` ON `barang_sampah`.`id_category` = `category`.`id`";
	return $this->db->query($query)->result_array();
}

public function getDetailProductKerajinan($id) {
	$query = "SELECT * FROM `barang_jualan` JOIN `category` ON `barang_jualan`.`id_category` = `category`.`id` WHERE `barang_jualan`.`kode_barang_jualan` =".$id;
	return $this->db->query($query)->row_array();
}

public function getDetailProductTukarSaldo($id) {
	$query = "SELECT * FROM `barang_tukar` JOIN `category` ON `barang_tukar`.`id_category` = `category`.`id` WHERE `barang_tukar`.`kode_barang_tukar` =".$id;
	return $this->db->query($query)->row_array();
}

public function getPemesananKerajinanById($id, $id_user) {
	$query = "SELECT * FROM `pemesanan_kerajinan` WHERE `id_user` = ".$id_user."  AND `kode_barang_pesan` = ".$id;
	return $this->db->query($query)->num_rows();
}

public function getDetailProductTambahSaldo($id) {
	$query = "SELECT * FROM `barang_sampah` JOIN `category` ON `barang_sampah`.`id_category` = `category`.`id` WHERE `barang_sampah`.`kode_barang_sampah` = ".$id;
	return $this->db->query($query)->row_array();
}

public function InsertData($tableName, $data) {
		$res = $this->db->insert($tableName,$data);
		return $res;
	}

public function UpdateData($tableName, $data,$where) {
		$res = $this->db->Update($tableName,$data,$where);
		return $res;
}

public function getDataPembayaranDetail($id_pesan) {
	$query = "SELECT * FROM `pemesanan_kerajinan` JOIN `barang_jualan` ON `pemesanan_kerajinan`.`kode_barang_pesan` = `barang_jualan`.`kode_barang_jualan` WHERE `pemesanan_kerajinan`.`id_pesan` = ".$id_pesan;
	return $this->db->query($query)->row_array();

}

public function getKomentarByIdBarang($id) {
	$query = "SELECT * FROM `komentar_jualan` JOIN `barang_jualan` ON `komentar_jualan`.`kode_barang_jualan` = `barang_jualan`.`kode_barang_jualan` JOIN `users` ON `komentar_jualan`.`id_user` = `users`.`id` WHERE `barang_jualan`.`kode_barang_jualan` = ".$id;
	return $this->db->query($query)->result_array();
}

}

?>