<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function is_logged_in()
{
	$fusthis = get_instance(); //memanggil library ci ke function
	if(!$fusthis->session->userdata('email')) {
		redirect('auth');
	} else {
		$role_id = $fusthis->session->userdata('role_id');
		$menu = $fusthis->uri->segment(1);

		$queryMenu = $fusthis->db->get_where('users_menu',['menu' => $menu])->row_array();
		$menu_id = $queryMenu['id'];
		$userAccess = $fusthis->db->get_where('users_access_menu',['role_id' => $role_id, 'menu_id' => $menu_id]);
		if($userAccess->num_rows() < 1) {
			redirect('auth/blocked');
		}	
	}
}

function check_access($role_id, $menu_id) 
{
	$fusthis = get_instance();

	$fusthis->db->where('role_id', $role_id);
	$fusthis->db->where('menu_id', $menu_id);
	$result = $fusthis->db->get("users_access_menu");
	if ($result->num_rows() > 0) {
			return "checked='checked'";
		}	
}
