<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfusfusmenumodel extends CI_Model {

	public function getSubMenu() {
		$query = "SELECT `users_sub_menu`.*, `users_menu`.`menu`
				 FROM `users_sub_menu` JOIN `users_menu` ON `users_sub_menu`.`menu_id` = `users_menu`.`id`
		";

		return $this->db->query($query)->result_array();

	}

	public function getSubMenuWhere($where) {
		$query = "SELECT `users_sub_menu`.*, `users_menu`.`menu`
				 FROM `users_sub_menu` JOIN `users_menu` ON `users_sub_menu`.`menu_id` = `users_menu`.`id` WHERE `users_sub_menu`.
		".$where;
		return $this->db->query($query)->row_array();

	}

}