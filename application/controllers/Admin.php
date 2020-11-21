<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
	parent::__construct();
	is_logged_in();
	}

	public function index() {
		$data['title'] = "Dashboard";
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$data['jumlahPesanan'] = $this->Mfusfusmodel->GetJumlahPesanan();
		$data['jumlahPenambahan'] = $this->Mfusfusmodel->GetJumlahPenambahan();
		$data['jumlahPenukaran'] = $this->Mfusfusmodel->GetJumlahPenukaran();
		$data['jumlahKomentar'] = $this->Mfusfusmodel->GetJumlahKomentar();
		$data['jumlahKeluhan'] = $this->Mfusfusmodel->GetJumlahKeluhan();


		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/footer_after');
		
	}

	public function role() {
		$data['title'] = "Role";
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('users_role')->result_array();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_role',$data);
		$this->load->view('templates/footer_after');
		
	}

	public function roleAccess($role_id) {
		$data['title'] = "Role Access";
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('users_role',['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('users_menu')->result_array();


		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_role_access',$data);
		$this->load->view('templates/footer_after');
		
	}

	public function changeAccess() {

		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('users_access_menu',$data);

		if($result->num_rows() < 1) {
			$this->db->insert('users_access_menu', $data);
		} else {
			$this->db->delete('users_access_menu', $data);
		}

		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Acccess Changed!</strong>
				</div>');		
	}

	public function dataAnggota() {
		$data['title'] = 'Data Anggota';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();



		$data['anggota'] =	$this->db->get('users')->result_array();


		
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_data-anggota',$data);
		$this->load->view('templates/footer_after');


	}

	public function dataJualan() {
		$data['title'] = 'Data Jualan Produk Rumah Inspirasi';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		     
		$this->load->model('Mfusfusjualanmodel','jualan');
		
		$data['barang_jualan'] = $this->jualan->getCategoryName();
		$data['category'] =	$this->jualan->getCategoryTypeJualan();

		$this->form_validation->set_rules('nama_produk','Nama Produk','required|trim');
		$this->form_validation->set_rules('id_category','Kategori','required|trim');
		$this->form_validation->set_rules('stok','Stok','required|trim|numeric');
		$this->form_validation->set_rules('harga','Harga','required|trim|numeric');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('admin/v_data-jualan',$data);
			$this->load->view('templates/footer_after');
		} else {
			$data = [
				'nama_produk' => $this->input->post('nama_produk'),
				'id_category' => $this->input->post('id_category'),
				'stok' => $this->input->post('stok'),
				'harga' => $this->input->post('harga'),
				'keterangan' => $this->input->post('keterangan'),
				'date_created' => time()
			];
			//Cek gambar
			$upload_image = $_FILES['image'];
			if($upload_image == '') {
				$upload_image = 'polsub.png';
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/product/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
				}
			}
			$this->load->model('Mfusfusjualanmodel','jualan');
			$this->jualan->InsertData('barang_jualan', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Barang Berhasil Ditambahkan!</strong>
				</div>');
			redirect('admin/datajualan');
		
		}
		
	}

	public function editJualan($id) {
		$data['title'] = 'Edit Data Jualan';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_produk','Nama Produk','required|trim');
		$this->form_validation->set_rules('id_category','Kategori','required|trim');
		$this->form_validation->set_rules('stok','Stok','required|trim|numeric');
		$this->form_validation->set_rules('harga','Harga','required|trim|numeric');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if ($this->form_validation->run() == false) {			     
			$this->load->model('Mfusfusjualanmodel','jualan');
			$data['barang_jualan'] = $this->jualan->getDataJualanById($id);
			$data['category'] =	$this->jualan->getCategoryTypeJualan();
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('admin/v_editJualan',$data);
			$this->load->view('templates/footer_after');
		} else {
			$data = [
				'nama_produk' => $this->input->post('nama_produk'),
				'id_category' => $this->input->post('id_category'),
				'stok' => $this->input->post('stok'),
				'harga' => $this->input->post('harga'),
				'keterangan' => $this->input->post('keterangan'),
				'date_created' => time()
			];
			//Cek gambar
			$upload_image = $_FILES['image'];
			if($upload_image == '') {
				$upload_image = 'polsub.png';
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/product/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
				}
			}
			$this->load->model('Mfusfusjualanmodel','jualan');
			$where = [
				'kode_barang_jualan' => $id
				];
			$this->load->model('Mfusfusjualanmodel');
			$result = $this->Mfusfusjualanmodel->updateData('barang_jualan',$data,$where);
			if($result >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Data Jualan Telah Diupdate!
				</div>');
				redirect('admin/datajualan');
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Gagal Diupdate
				</div>');
				redirect('admin/editjualan/'.$id);
			}
		}
	}

	public function deleteJualan($id) {
		$where = array('kode_barang_jualan' => $id);
			$this->load->model('Mfusfusjualanmodel');
			$res = $this->Mfusfusjualanmodel->DeleteData('barang_jualan',$where);
			if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Berhasil Dihapus!
				</div>');
				redirect('admin/datajualan');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Gagal Dihapus!
				</div>');
				redirect('admin/datajualan');
			}

	}

	public function dataBarangTukar() {
		$data['title'] = 'Data Barang Tukar';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		     
		$this->load->model('Mfusfusjualanmodel','jualan');
		
		$data['barang_tukar'] = $this->jualan->getCategoryTukarName();
		$data['category'] =	$this->jualan->getCategoryTypeTukar();

		$this->form_validation->set_rules('nama_produk','Nama Produk','required|trim');
		$this->form_validation->set_rules('id_category','Kategori','required|trim');
		$this->form_validation->set_rules('stok','Stok','required|trim|numeric');
		$this->form_validation->set_rules('harga_saldo','Harga Saldo','required|trim|numeric');
		$this->form_validation->set_rules('harga_uang','Harga Uang','required|trim|numeric');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('admin/v_data-tukar',$data);
			$this->load->view('templates/footer_after');
		} else {
			$data = [
				'nama_produk' => $this->input->post('nama_produk'),
				'id_category' => $this->input->post('id_category'),
				'stok' => $this->input->post('stok'),
				'harga_saldo' => $this->input->post('harga_saldo'),
				'harga_uang' => $this->input->post('harga_uang'),
				'keterangan' => $this->input->post('keterangan'),
				'date_updated' => time()
			];
			//Cek gambar
			$upload_image = $_FILES['image'];
			if($upload_image == '') {
				$upload_image = 'polsub.png';
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/product/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
				}
			}
			$this->load->model('Mfusfusjualanmodel','jualan');
			$this->jualan->InsertData('barang_tukar', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Barang Berhasil Ditambahkan!</strong>
				</div>');
			redirect('admin/dataBarangTukar');
		
		}
	}

	public function editBarangTukar($id) {
		$data['title'] = 'Edit Data Barang Tukar';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_produk','Nama Produk','required|trim');
		$this->form_validation->set_rules('id_category','Kategori','required|trim');
		$this->form_validation->set_rules('stok','Stok','required|trim|numeric');
		$this->form_validation->set_rules('harga_saldo','Harga Saldo','required|trim|numeric');
		$this->form_validation->set_rules('harga_uang','Harga Uang','required|trim|numeric');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if ($this->form_validation->run() == false) {			     
			$this->load->model('Mfusfusjualanmodel','jualan');
			$data['barang_tukar'] = $this->jualan->getDataTukarById($id);
			$data['category'] =	$this->jualan->getCategoryTypeTukar();
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('admin/v_editTukar',$data);
			$this->load->view('templates/footer_after');
		} else {
			$data = [
				'nama_produk' => $this->input->post('nama_produk'),
				'id_category' => $this->input->post('id_category'),
				'stok' => $this->input->post('stok'),
				'harga_saldo' => $this->input->post('harga_saldo'),
				'harga_uang' => $this->input->post('harga_uang'),
				'keterangan' => $this->input->post('keterangan'),
				'date_updated' => time()
			];
			//Cek gambar
			$upload_image = $_FILES['image'];
			if($upload_image == '') {
				$upload_image = 'polsub.png';
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/product/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
				}
			}
			$this->load->model('Mfusfusjualanmodel','jualan');
			$where = [
				'kode_barang_tukar' => $id
				];
			$this->load->model('Mfusfusjualanmodel');
			$result = $this->Mfusfusjualanmodel->updateData('barang_tukar',$data,$where);
			if($result >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Data Tukar Telah Diupdate!
				</div>');
				redirect('admin/dataBarangTukar');
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Data Tukar Gagal Diupdate!
				</div>');
				redirect('admin/editBarangTukar/'.$id);
			}
		
		}
	}

	public function hapusBarangTukar($id) {
		$where = array('kode_barang_tukar' => $id);
			$this->load->model('Mfusfusjualanmodel');
			$res = $this->Mfusfusjualanmodel->DeleteData('barang_tukar',$where);
			if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Berhasil Dihapus!
				</div>');
				redirect('admin/dataBarangTukar');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Gagal Dihapus!
				</div>');
				redirect('admin/dataBarangTukar');
			}

	}

	public function dataSampah() {
		$data['title'] = 'Opsi Penukaran Sampah Jadi Saldo';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		     
		$this->load->model('Mfusfusjualanmodel','jualan');
		
		$data['barang_sampah'] = $this->jualan->getCategorySampahName();
		$data['category'] =	$this->jualan->getCategoryTypeSampah();

		$this->form_validation->set_rules('opsi_penukaran','Opsi Penukaran','required|trim');
		$this->form_validation->set_rules('id_category','Kategori','required|trim');
		$this->form_validation->set_rules('saldo_tambah','Saldo Tambah','required|trim|numeric');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('admin/v_data-sampah',$data);
			$this->load->view('templates/footer_after');
		} else {
			$data = [
				'opsi_penukaran' => $this->input->post('opsi_penukaran'),
				'id_category' => $this->input->post('id_category'),
				'saldo_tambah' => $this->input->post('saldo_tambah'),
				'keterangan' => $this->input->post('keterangan'),
				'date_updated' => time()
			];
			//Cek gambar
			$upload_image = $_FILES['image'];
			if($upload_image == '') {
				$upload_image = 'polsub.png';
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/product/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
				}
			}
			$this->load->model('Mfusfusjualanmodel','jualan');
			$this->jualan->InsertData('barang_sampah', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Barang Berhasil Ditambahkan!</strong>
				</div>');
			redirect('admin/dataSampah');
		
		}
	}

	public function editDataSampah($id) {
		$data['title'] = 'Edit Data Penukaran Saldo';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();
		$this->load->model('Mfusfusjualanmodel','jualan');

		$this->form_validation->set_rules('opsi_penukaran','Opsi Penukaran','required|trim');
		$this->form_validation->set_rules('id_category','Kategori','required|trim');
		$this->form_validation->set_rules('saldo_tambah','Saldo Tambah','required|trim|numeric');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if($this->form_validation->run() == false) {
			$data['barang_sampah'] = $this->jualan->getDataSampahById($id);
			$data['category'] =	$this->jualan->getCategoryTypeSampah();
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('admin/v_editSampah',$data);
			$this->load->view('templates/footer_after');
		} else {
			$data = [
				'opsi_penukaran' => $this->input->post('opsi_penukaran'),
				'id_category' => $this->input->post('id_category'),
				'saldo_tambah' => $this->input->post('saldo_tambah'),
				'keterangan' => $this->input->post('keterangan'),
				'date_updated' => time()
			];
			//Cek gambar
			$upload_image = $_FILES['image'];
			if($upload_image == '') {
				$upload_image = 'polsub.png';
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/product/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
				}
			} $where = [
				'kode_barang_sampah' => $id
				];
			$this->load->model('Mfusfusjualanmodel');
			$result = $this->Mfusfusjualanmodel->updateData('barang_sampah',$data,$where);
			if($result >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Data Sampah Telah Diupdate!
				</div>');
				redirect('admin/dataSampah');
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Data Sampah Gagal Diupdate!
				</div>');
				redirect('admin/editDataSampahr/'.$id);
			}
		}

		



	}

	public function hapusDataSampah($id) {
		$where = array('kode_barang_sampah' => $id);
			$this->load->model('Mfusfusjualanmodel');
			$res = $this->Mfusfusjualanmodel->DeleteData('barang_sampah',$where);
			if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Berhasil Dihapus!
				</div>');
				redirect('admin/dataSampah');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Gagal Dihapus!
				</div>');
				redirect('admin/dataSampah');
			}

	}

	public function pemesananKerajinan() {
		$data['title'] = 'Data Pembelian Kerajinan Dari Sampah';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Mfusfusjualanmodel','jualan');
		$data['pesanKerajinan'] = $this->jualan->getPemesananDetail();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_data-pembelian-kerajinan',$data);
		$this->load->view('templates/footer_after');


	}

	public function permintaanTukar() {
		$data['title'] = 'Data Permintaan Tukar Saldo Jadi Barang Tukar';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Mfusfusjualanmodel','jualan');
		$data['tukarSaldo'] = $this->jualan->getPermintaanTukarDetail();
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_data-permintaan-penukaran',$data);
		$this->load->view('templates/footer_after');
	}

	public function permintaantambah() { //permintaan tambah saldo
		$data['title'] = 'Data Permintaan Penambahan Saldo';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();
	
		$this->load->model('Mfusfusjualanmodel','jualan');
		$data['tambahSaldo'] = $this->jualan->getPermintaanTambahSaldoDetail();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_data-permintaan-tambah-saldo',$data);
		$this->load->view('templates/footer_after');
	}

	public function dataKategori() {
		$data['title'] = 'Data Kategori';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Mfusfuskategori');
		$data['category'] = $this->Mfusfuskategori->getAllCategory();

		$this->form_validation->set_rules('category','Kategori','required|trim');
		$this->form_validation->set_rules('jenis_category','Jenis Kategori','required|trim');

		if($this->form_validation->run() == false) {
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_dataKategori',$data);
		$this->load->view('templates/footer_after');
		} else {
			$data = [
				'category' => $this->input->post('category'),
				'jenis_category' => $this->input->post('jenis_category')
			];
			$this->Mfusfuskategori->InsertData('category', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Barang Berhasil Ditambahkan!</strong>
				</div>');
			redirect('admin/dataKategori');


		}
	}

	public function editKategori($id) {
		$data['title'] = 'Edit Kategori';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('category','Kategori','required|trim');
		$this->form_validation->set_rules('jenis_category','Jenis Kategori','required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->model('Mfusfuskategori');
			$hasil = $this->Mfusfuskategori->getCategoryById($id);
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('admin/v_editKategori',$hasil);
			$this->load->view('templates/footer_after');
		} else {
			$id = $this->input->post('id');
			$category = $this->input->post('category');
			$jenis_category = $this->input->post('jenis_category');
			$data = [
				'category' => $category,
				'jenis_category' => $jenis_category
			];
			$where = [
				'id' => $id
				];
			$this->load->model('Mfusfuskategori');
			$result = $this->Mfusfuskategori->updateData('category',$data,$where);
			if($result >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Telah Diupdate!
				</div>');
				redirect('admin/datakategori');
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Gagal Diupdate
				</div>');
				redirect('admin/editkategori/'.$id);
			}
		}
	}	

		public function deleteKategori($id) {
			$where = array('id' => $id);
			$this->load->model('Mfusfuskategori');
			$res = $this->Mfusfuskategori->DeleteData('category',$where);
			if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Berhasil Dihapus!
				</div>');
				redirect('admin/datakategori');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Gagal Dihapus!
				</div>');
				redirect('admin/datakategori');
			}
		
		

	}

	public function changeStatusSendPesanan($id_pesan) {
		$this->load->model('Mfusfusstatus');
		$data = $this->Mfusfusstatus->getPesananById($id_pesan);
		$where = [
		'id_pesan' => $id_pesan
		];
		$data = [
		'status' => 'Sedang Dikirim'
		];
		$res = $this->Mfusfusstatus->updateData('pemesanan_kerajinan',$data,$where);
		if($res >= 1) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Pesanan diubah jadi Sedang Dikirim
				</div>');
				redirect('admin/pemesananKerajinan');
		} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Pesanan Gagal di update!
				</div>');
				redirect('admin/pemesananKerajinan');

		}

	}

	public function changeStatusPesanan($id_pesan) {
		$this->load->model('Mfusfusstatus');
		$cekPesanan = $this->Mfusfusstatus->getPesananById($id_pesan);
		$id_user = $cekPesanan['id_user'];
		$cekStok = $this->Mfusfusstatus->getPesananDetailById($id_pesan,$id_user);
		if($cekStok['stok'] < $cekStok['jumlah_pesan']) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Stok Barang Tidak Mencukupi!
				</div>');
				redirect('admin/pemesananKerajinan');
		} else {		
		$where = [
		'id_pesan' => $id_pesan
		];
		$data = [
		'status' => 'Selesai'
		];
		$kode_barang_jualan = $cekStok['kode_barang_jualan'];
		$where_barang = [
		'kode_barang_jualan' => $kode_barang_jualan
		];
		$stok = $cekStok['stok'] - $cekStok['jumlah_pesan'];
		$data_barang = [
		'stok' => $stok
		];
		$res = $this->Mfusfusstatus->updateData('pemesanan_kerajinan',$data,$where);
		$res = $this->Mfusfusstatus->updateData('barang_jualan',$data_barang,$where_barang);
		if($res >= 1) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Pesanan diubah jadi Selesai
				</div>');
				redirect('admin/pemesananKerajinan');
		} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Pesanan Gagal di update!
				</div>');
				redirect('admin/pemesananKerajinan');

		}
	}

	} 

	public function changeStatusTukarToSiapAmbil($kode_tukar_saldo) {
		$this->load->model('Mfusfusstatus');
		$cekPenukaran = $this->Mfusfusstatus->getPenukaranById($kode_tukar_saldo);
		if($cekPenukaran == null) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penukaran Saldo Gagal Diupdate!
				</div>');
			redirect('admin/permintaantukar');
		} else {
			$data = [
			'status' => "Siap Ambil"
			];

			$where = [
			'kode_tukar_saldo' => $cekPenukaran['kode_tukar_saldo']
			];

			$res = $this->Mfusfusstatus->updateData('permintaan_tukar_saldo',$data,$where);
			if($res >= 1) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penukaran Saldo diubah jadi Siap Ambil, Mengirim Notifikasi Ke Member Untuk Ambil Barang
				</div>');
				redirect('admin/permintaanTukar');
		} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penukaran Saldo Gagal Diupdate!
				</div>');
				redirect('admin/permintaanTukar');

		}
		}
	}

	public function changeStatusTukarToSelesai($kode_tukar_saldo) {
		$this->load->model('Mfusfusstatus');
		$cekPenukaran = $this->Mfusfusstatus->getPenukaranById($kode_tukar_saldo);
		if($cekPenukaran == null) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penukaran Saldo Gagal Diupdate!
				</div>');
			redirect('admin/permintaantukar');
		} else {
			$data = [
			'status' => "Selesai"
			];

			$where = [
			'kode_tukar_saldo' => $cekPenukaran['kode_tukar_saldo']
			];

			$res = $this->Mfusfusstatus->updateData('permintaan_tukar_saldo',$data,$where);
			if($res >= 1) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penukaran Saldo diubah jadi Selesai
				</div>');
				redirect('admin/permintaanTukar');
		} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penukaran Saldo Gagal Diupdate!
				</div>');
				redirect('admin/permintaanTukar');

		}
		}
	}

	public function changeStatusTambahToTerkonfirmasi($kode_tambah_saldo) {
		$this->load->model('Mfusfusstatus');
		$cekPermintaan = $this->Mfusfusstatus->getPermintaanDetailById($kode_tambah_saldo);
		if($cekPermintaan == null) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penambahan Saldo Gagal Diupdate!
				</div>');
			redirect('admin/permintaantambah');
		} else {
			$id_user = $cekPermintaan['id_user'];
			$user = $this->Mfusfusstatus->getUserById($id_user);
			$saldo_terbaru = $cekPermintaan['saldo_tambah'] + $user['saldo_user'];
			$saldo = [
				'saldo_user' => $saldo_terbaru
			];

			$id = [
			'id' => $id_user
			];

			$this->Mfusfusstatus->updateData('users',$saldo,$id);

			$status = [
			'status' => "Terkonfirmasi"
			];

			$where = [
			'kode_tambah_saldo' => $cekPermintaan['kode_tambah_saldo']
			];

			$res = $this->Mfusfusstatus->updateData('permintaan_tambah_saldo',$status,$where);
			if($res >= 1) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penambahan Saldo Terkonfirmasi, Menambahkan Saldo user bersangkutan..
				</div>');
				redirect('admin/permintaanTambah');
		} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penambahan Saldo Gagal Diupdate!
				</div>');
				redirect('admin/permintaanTambah');

		}
}
}
		public function changeStatusTambahToSelesai($kode_tambah_saldo) {
		$this->load->model('Mfusfusstatus');
		$cekPermintaan = $this->Mfusfusstatus->getPermintaanDetailById($kode_tambah_saldo);
		if($cekPermintaan == null) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penambahan Saldo Gagal Diupdate!
				</div>');
			redirect('admin/permintaantambah');
		} else {
			$data = [
			'status' => "Selesai"
			];

			$where = [
			'kode_tambah_saldo' => $cekPermintaan['kode_tambah_saldo']
			];

			$res = $this->Mfusfusstatus->UpdateData('permintaan_tambah_saldo',$data,$where);
			if($res >= 1) {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penambahan Saldo diubah jadi Selesai
				</div>');
				redirect('admin/permintaantambah');
		} else {
			$this->session->set_flashdata('message',
			'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Status Permintaan Penukaran Saldo Gagal Diupdate!
				</div>');
				redirect('admin/permintaantambah');

		}
		}
	}

	public function datakomentar() {
		$data['title'] = 'Data Komentar';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Mfusfusjualanmodel','jualan');
		$data['dataKomentar'] = $this->jualan->getAllKomentar();
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_data-komentar',$data);
		$this->load->view('templates/footer_after');
	}

	public function deletekomentar($id) {
			$where = array('id_komentar' => $id);
			$this->load->model('Mfusfusjualanmodel','jualan');
			$res = $this->jualan->DeleteData('komentar_jualan',$where);
			if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kommentar Berhasil Dihapus!
				</div>');
				redirect('admin/dataKomentar');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Komentar Gagal Dihapus!
				</div>');
				redirect('admin/dataKomentar');
			}

}

	public function datakeluhan() {
		$data['title'] = 'Data Keluhan';
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Mfusfusjualanmodel','jualan');
		$data['dataKeluhan'] = $this->jualan->getAllKeluhan();
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/v_data-keluhan',$data);
		$this->load->view('templates/footer_after');
	}

	public function deletekeluhan($id) {
			$where = array('id_keluhan' => $id);
			$this->load->model('Mfusfusjualanmodel','jualan');
			$res = $this->jualan->DeleteData('keluhan_user',$where);
			if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Keluhan Berhasil Dihapus!
				</div>');
				redirect('admin/datakeluhan');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Keluhan Gagal Dihapus!
				</div>');
				redirect('admin/datakeluhan');
			}

}




	

	}