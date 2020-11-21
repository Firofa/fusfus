<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->goToDefaultPage();
		$this->load->view('templates/header');
		$this->load->view('index');
		$this->load->view('templates/footer');
	}

	private function goToDefaultPage() {
	  if ($this->session->userdata('role_id') == 1) {
	    redirect('admin');
	  } else if ($this->session->userdata('role_id') == 2) {
	    redirect('user');
	  }
	}
}
