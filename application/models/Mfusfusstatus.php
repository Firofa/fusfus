<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfusfusstatus extends CI_Model {

 public function getAllStatusPenukaranByUser($id) {
 	$query = "SELECT * FROM `permintaan_tukar_saldo` JOIN `barang_tukar` ON `permintaan_tukar_saldo`.`id_barang_tukar` = `barang_tukar`.`kode_barang_tukar` JOIN `users` ON `permintaan_tukar_saldo`.`id_user` = `users`.`id` WHERE `users`.`id` = ".$id." AND `permintaan_tukar_saldo`.`status` != 'Selesai'";
 	return $this->db->query($query)->result_array();
 }

 public function getAllStatusPermintaanByUser($id) {
 	$query = "SELECT * FROM `permintaan_tambah_saldo` JOIN `barang_sampah` ON `permintaan_tambah_saldo`.`id_barang_sampah` = `barang_sampah`.`kode_barang_sampah` JOIN `users` ON `permintaan_tambah_saldo`.`id_user` = `users`.`id` WHERE `users`.`id` = ".$id." AND `permintaan_tambah_saldo`.`status` != 'Selesai'";
 	return $this->db->query($query)->result_array();
 }

 public function getAllStatusPemesananByUser($id) {
 	$query = "SELECT * FROM `pemesanan_kerajinan` JOIN `barang_jualan` ON `pemesanan_kerajinan`.`kode_barang_pesan` = `barang_jualan`.`kode_barang_jualan` JOIN `users` ON `pemesanan_kerajinan`.`id_user` = `users`.`id` WHERE `users`.`id` = ".$id." AND `pemesanan_kerajinan`.`status` != 'Selesai'";
 	return $this->db->query($query)->result_array();
 }

 public function getPesananById($id_pesan) {
 	$query = "SELECT * FROM `pemesanan_kerajinan` WHERE `id_pesan` = ".$id_pesan;
 	return $this->db->query($query)->row_array();
 }

 public function getPesananDetailById($id_pesan,$id_user) {
 	$query = "SELECT * FROM `pemesanan_kerajinan` JOIN `barang_jualan` ON `pemesanan_kerajinan`.`kode_barang_pesan` = `barang_jualan`.`kode_barang_jualan` WHERE `pemesanan_kerajinan`.`id_user` =".$id_user." AND `pemesanan_kerajinan`.`id_pesan` =".$id_pesan;
 	return $this->db->query($query)->row_array();
 }


 public function UpdateData($tableName, $data,$where) {
		$res = $this->db->Update($tableName,$data,$where);
		return $res;
}

public function getPenukaranById($kode_tukar_saldo) {
	$query = "SELECT * FROM `permintaan_tukar_saldo` WHERE `kode_tukar_saldo` = ".$kode_tukar_saldo;
	return $this->db->query($query)->row_array();
}

public function getPermintaanDetailById($kode_tambah_saldo) {
	$query = "SELECT * FROM `permintaan_tambah_saldo` JOIN `barang_sampah` ON `permintaan_tambah_saldo`.`id_barang_sampah` = `barang_sampah`.`kode_barang_sampah` WHERE `kode_tambah_saldo` = ".$kode_tambah_saldo;
	return $this->db->query($query)->row_array();
}

public function getUserById($id_user) {
	$query = "SELECT * FROM `users` WHERE `id` = ".$id_user;
	return $this->db->query($query)->row_array();
}

}
?>