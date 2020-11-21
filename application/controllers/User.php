<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
	parent::__construct();
	is_logged_in();
	}
	public function index() {
		$data['title'] = "My Profile";
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer_after');
		
	}

	public function edit() {
		$data['title'] = "Edit Profile";
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('name', 'Nama', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|numeric|min_length[10]');
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim');


		if($this->form_validation->run() == false) {
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('user/v_edit-profile',$data);
		$this->load->view('templates/footer_after');
	} else {
		$name = htmlspecialchars($this->input->post('name'));
		$email = $this->input->post('email');
		$no_hp = htmlspecialchars($this->input->post('no_hp'));
		$alamat = htmlspecialchars($this->input->post('alamat'));
		//Cek Jika ada gambar yang diupload
		$upload_image = $_FILES['image'];
		if($upload_image) {
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/profiles/';
			$this->load->library('upload', $config);
			if($this->upload->do_upload('image')) {
				$old_image = $data['user']['image'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/profiles/'.$old_image);
				}
				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			}	else {
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
			}
		}



		$this->db->set('name', $name);
		$this->db->set('no_hp', $no_hp);
		$this->db->set('alamat', $alamat);
		$this->db->where('email',$email);
		$this->db->update('users');
		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Your Profile has been Updated</strong>
				</div>');
		redirect('user');
	}
	}

	public function ubahPassword() {
		$data['title'] = "Change Password";
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('currentPassword','Current Password','required|trim');
		$this->form_validation->set_rules('new_password1','New Password','required|trim|min_length[8]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2','Confirm New Password','required|trim|min_length[8]|matches[new_password1]');
		
		if($this->form_validation->run() == false) {
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('user/v_changepassword',$data);
		$this->load->view('templates/footer_after');			
		} else {
			$currentPassword = $this->input->post('currentPassword');
			$new_password = $this->input->post('new_password1');
			if(!password_verify($currentPassword, $data['user']['password'])) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Wrong Current Password</strong>
				</div>');
				redirect('user/ubahpassword');	
			} else {
				if($currentPassword == $new_password) {
					$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>New Password Cannot Be The Same As Current Password!</strong>
				</div>');
				redirect('user/ubahpassword');

				} else {
					//password sudah ok
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$this->db->set('password',$password_hash);
					$this->db->where('email',$this->session->userdata('email'));
					$this->db->update('users');
					$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Password Changed!</strong>
				</div>');
					redirect('user/ubahpassword');

				}
			}
		}


	}

}