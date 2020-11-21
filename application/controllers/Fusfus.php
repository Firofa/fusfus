<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fusfus extends CI_Controller {

	public function __construct() {
	parent::__construct();
	is_logged_in();
	}

	public function index() {
		$data['title'] = "Fusfus";
		$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();
		$data['nama'] = $data['user']['name'];
		$this->load->model('Mfusfusshop');
		$data['produkKerajinan'] = $this->Mfusfusshop->getAllDataKerajinan();
		$data['produkTukar'] = $this->Mfusfusshop->getAllDataPenukaranSampah();
		$data['opsiTambahSaldo'] = $this->Mfusfusshop->getAllDataOpsiTambahSaldo();

		$this->load->view('fusfus/templates/header',$data);
		$this->load->view('fusfus/index',$data);
		$this->load->view('fusfus/templates/footer',$data);
		
		
	}



	public function pesanKerajinan($id = 0) {
      	$data['title'] = "Fusfus";
        $data['user'] = $this->db->get_where('users', [
      'email' => $this->session->userdata('email')])->row_array();
       $id_user = $data['user']['id'];
       $this->load->model('Mfusfusshop');
       $data['detail_produk'] = $this->Mfusfusshop->getDetailProductKerajinan($id);
       if($data['detail_produk'] == NULL) {
        redirect('fusfus/index');
        } else {
              $inputData = [
                'kode_barang_pesan' => $data['detail_produk']['kode_barang_jualan'],
                'id_user' => $data['user']['id'],
                'tanggal_pesan' => time(),             
                'jumlah_pesan' => 1,
                'total' => $data['detail_produk']['harga'],
                'resi' => 'polsub.png',
                'status' => "Sedang Diproses"
              ];  
              	$this->load->view('fusfus/templates/header',$data);
				$this->load->view('fusfus/v_checkoutKerajinan',['data' => $data, 'inputData' => $inputData]);
			 	$this->load->view('fusfus/templates/footer',$data);
          } 
          
        }
    

    public function doPesanKerajinan() {
    	$data['title'] = "Fusfus";
        $data['user'] = $this->db->get_where('users', [
      	'email' => $this->session->userdata('email')])->row_array();
    	$kode_barang_pesan = $this->input->post('kode_barang_pesan');
    	$jumlah_pesan = $this->input->post('jumlah_pesan');
    	if ($jumlah_pesan == 0 || $jumlah_pesan < 0) {
    		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-info">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Jumlah Pesanan tidak boleh kurang dari 1</strong>
				</div>');
          	redirect('fusfus/pesanKerajinan'.$kode_barang_jualan);
    	}
    	$harga_satuan = $this->input->post('harga');
    	$harga = $harga_satuan * $jumlah_pesan;
    	$upload_image = $_FILES['image'];
			if($upload_image['name'] == '') { 
				$upload_image = 'polsub.png';
        $resi = $upload_image;
        $inputData = [
                'kode_barang_pesan' => $kode_barang_pesan,
                'id_user' => $data['user']['id'],
                'tanggal_pesan' => time(),             
                'jumlah_pesan' => $jumlah_pesan,
                'total' => $harga,
                'resi' => $resi,
                'status' => "Sedang Diproses"
              ];
        $this->load->model('Mfusfusshop'); 
        $this->Mfusfusshop->InsertData('pemesanan_kerajinan',$inputData);
        $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Pemesanan Kerajinan Berhasil! Silahkan Upload Bukti Pembayaran jika belum upload.</strong>
        </div>');
        redirect('fusfus/statusPemesanan'); 
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/buktipembayaran/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$resi = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('fusfus/pesanKerajinan'.$kode_barang_jualan); 
				}
    	$inputData = [
                'kode_barang_pesan' => $kode_barang_pesan,
                'id_user' => $data['user']['id'],
                'tanggal_pesan' => time(),             
                'jumlah_pesan' => $jumlah_pesan,
                'total' => $harga,
                'resi' => $resi,
                'status' => "Sedang Diproses"
              ];
        $this->load->model('Mfusfusshop'); 
        $this->Mfusfusshop->InsertData('pemesanan_kerajinan',$inputData);
        $this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Pemesanan Kerajinan Berhasil! Silahkan Upload Bukti Pembayaran jika belum upload.</strong>
				</div>');
        redirect('fusfus/statusPemesanan'); 



               }
    }

    public function tukarSaldoSampah($id = 0) {
    $data['title'] = "Fusfus";
        $data['user'] = $this->db->get_where('users', [
      'email' => $this->session->userdata('email')])->row_array();
       $id_user = $data['user']['id'];
       $this->load->model('Mfusfusshop');
       $data['detail_produk'] = $this->Mfusfusshop->getDetailProductTukarSaldo($id);
       if($data['detail_produk'] == NULL) {
        redirect('fusfus/index');
        } else {
              $inputData = [
                'id_barang_tukar' => $data['detail_produk']['kode_barang_tukar'],
                'id_user' => $data['user']['id'],
                'tanggal_pesan' => time(),             
                'jumlah_pesan' => 1,
                'harga_saldo' => $data['detail_produk']['harga_saldo'],
                'harga_uang' => $data['detail_produk']['harga_uang'],
                'status' => "Sedang Diproses"
              ];  
              	$this->load->view('fusfus/templates/header',$data);
				$this->load->view('fusfus/v_checkoutTukarSaldo',['data' => $data, 'inputData' => $inputData]);
			 	$this->load->view('fusfus/templates/footer',$data);
          } 
          
        }

     public function doTukarSaldo() {
     	$data['title'] = "Fusfus";
        $data['user'] = $this->db->get_where('users', [
      	'email' => $this->session->userdata('email')])->row_array();
      	$id_user = $data['user']['id'];
     	$id_barang_tukar = $this->input->post('id_barang_tukar');
     	$pemakaian_saldo = $this->input->post('harga_saldo');
     	$saldo_saat_ini = $data['user']['saldo_user'];
     	$this->load->model('Mfusfusshop');
     	$sisa_saldo = $saldo_saat_ini - $pemakaian_saldo;
     	if($sisa_saldo < 0) {
     		 $this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-warning">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Saldo Anda Tidak Mencukupi Untuk Melakukan Penukaran!</strong>
				</div>');
       		 redirect('fusfus/tukarSaldoSampah/'.$id_barang_tukar); 
     	} else {
     		$saldo = [
     			'saldo_user' => $sisa_saldo
     		];
     		$where = [
     			'id' => $id_user
     		];
     		$this->Mfusfusshop->UpdateData('users',$saldo,$where);
     		$inputData = [
     			'id_barang_tukar' => $id_barang_tukar,
     			'id_user' => $id_user,
     			'tanggal_permintaan' => time(),
     			'status' => "Sedang Diproses"
     		];
     		$this->Mfusfusshop->InsertData('permintaan_tukar_saldo',$inputData);
     		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Permintaan Penukaran Berhasil! Saldo dikurangi sesuai saldo yg diperlukan</strong>
				</div>');
        	redirect('fusfus/statusPenukaran'); 


     	}
     }

     public function tambahSaldoSampah($id = 0) {
     	$data['title'] = "Fusfus";
        $data['user'] = $this->db->get_where('users', [
      	'email' => $this->session->userdata('email')])->row_array();
      	$this->load->model('Mfusfusshop');
       	$data['detail_produk'] = $this->Mfusfusshop->getDetailProductTambahSaldo($id);
       	 if($data['detail_produk'] == NULL) {
        redirect('fusfus/index');
        } else { 
        	$inputData = [
                'id_barang_sampah' => $data['detail_produk']['kode_barang_sampah'],
                'id_user' => $data['user']['id'],            
                'saldo_tambah' => $data['detail_produk']['saldo_tambah'],
              ];  
              	$this->load->view('fusfus/templates/header',$data);
				$this->load->view('fusfus/v_checkoutTambahSaldo',['data' => $data, 'inputData' => $inputData]);
			 	$this->load->view('fusfus/templates/footer',$data);
        }
     }

     public function doTambahSaldoSampah() {
     	$data['title'] = "Fusfus";
        $data['user'] = $this->db->get_where('users', [
      	'email' => $this->session->userdata('email')])->row_array();
      	$id_user = $data['user']['id'];
      	$id_barang_sampah = $this->input->post('id_barang_sampah');
      	$saldo_diterima = $this->input->post('saldo_tambah');
      	$inputData = [
      		'id_barang_sampah' => $id_barang_sampah,
      		'id_user' => $id_user,
      		'tanggal_permintaan' => time(),
      		'status' => "Sedang Diproses"
      	];
      	$this->load->model('Mfusfusshop');
      	$this->Mfusfusshop->InsertData('permintaan_tambah_saldo',$inputData);
      	$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Permintaan Penambahan Saldo Berhasil! Saldo akan ditambah saat status sudah dikonfirmasi</strong>
				</div>');
        redirect('fusfus/statusTambahSaldo');
     }

	public function statusPenukaran() {
	$data['title'] = "Status Penukaran";
	$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();
	$this->load->model('Mfusfusstatus');
	$data['barang_tukar'] = $this->Mfusfusstatus->getAllStatusPenukaranByUser($data['user']['id']);

	$this->load->view('templates/header_after',$data);
	$this->load->view('templates/sidebar_after',$data);
	$this->load->view('templates/topbar_after',$data);
	$this->load->view('fusfus/v_statusPenukaran',$data);
	$this->load->view('templates/footer_after');
	}

	public function statusPemesanan() {
	$data['title'] = "Status Pemesanan";
	$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();
	$this->load->model('Mfusfusstatus');
	$data['barang_jualan'] = $this->Mfusfusstatus->getAllStatusPemesananByUser($data['user']['id']);

	$this->load->view('templates/header_after',$data);
	$this->load->view('templates/sidebar_after',$data);
	$this->load->view('templates/topbar_after',$data);
	$this->load->view('fusfus/v_statusPemesanan',$data);
	$this->load->view('templates/footer_after');
			
	}

	public function statusTambahSaldo() {
	$data['title'] = "Status Tambah Saldo";
	$data['user'] = $this->db->get_where('users', [
			'email' => $this->session->userdata('email')])->row_array();
	$this->load->model('Mfusfusstatus');
	$data['barang_sampah'] = $this->Mfusfusstatus->getAllStatusPermintaanByUser($data['user']['id']);

	$this->load->view('templates/header_after',$data);
	$this->load->view('templates/sidebar_after',$data);
	$this->load->view('templates/topbar_after',$data);
	$this->load->view('fusfus/v_statusPermintaan',$data);
	$this->load->view('templates/footer_after');
	}

  public function uploadpembayaran($id) {
  $data['title'] = "Upload Bukti Pembayaran";
  $data['user'] = $this->db->get_where('users', [
      'email' => $this->session->userdata('email')])->row_array();
  $id_pesan = $id;
  $this->load->model('Mfusfusshop');
  $pesan = $this->Mfusfusshop->getDataPembayaranDetail($id_pesan);
  $this->load->view('templates/header_after',$data);
  $this->load->view('templates/sidebar_after',$data);
  $this->load->view('templates/topbar_after',$data);
  $this->load->view('fusfus/v_uploadpembayaran',['data' => $data, 'pesan' => $pesan]);
  $this->load->view('templates/footer_after');
  }

  public function douploadpembayaran($id) {
    //Cek gambar
      $upload_image = $_FILES['image'];
      if($upload_image == '') {
        $upload_image = 'polsub.png';
      } else {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img/buktipembayaran/';
        $this->load->library('upload', $config);
        if($this->upload->do_upload('image')) {
          $new_image = $this->upload->data('file_name');
          $data['resi'] = $new_image;
        } else {
          echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
        }
      } $where = [
        'id_pesan' => $id
        ];
      $this->load->model('Mfusfusshop');
      $result = $this->Mfusfusshop->updateData('pemesanan_kerajinan',$data,$where);
      if($result >= 1) {
        $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Bukti Pembayaran Berhasil di Upload
        </div>');
        redirect('fusfus/statusPemesanan');
      } else {
        $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Bukti Pembayaran Gagal Di Upload
        </div>');
        redirect('fusfus/statusPemesanan/');
      }
  }

  public function likeproductjual($id) {
    $kode_barang_jualan = $id;
    $this->load->model('Mfusfusshop');
    $data = $this->Mfusfusshop->getDetailProductKerajinan($id);
    $like_before = $data['product_like'];
    $like_after = $like_before + 1;
    $like = ['product_like' => $like_after];
    $where = ['kode_barang_jualan' => $kode_barang_jualan];
    $result = $this->Mfusfusshop->updateData('barang_jualan',$like,$where);
    if($result >= 1) {
        $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Product '.$data['nama_produk'].' Di Like!
        </div>');
        redirect('fusfus');
      } else {
        $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Product Gagal Di Like!
        </div>');
        redirect('fusfus');
      }

  }

  public function detailProduct($id) {
    $data['title'] = "Fusfus";
    $data['user'] = $this->db->get_where('users', [
      'email' => $this->session->userdata('email')])->row_array();
    $kode_barang_jualan = $id;
    $this->load->model('Mfusfusshop');
    $data['barang'] = $this->Mfusfusshop->getDetailProductKerajinan($id);
    $data['komentar'] = $this->Mfusfusshop->getKomentarByIdBarang($id);
    
    $this->load->view('fusfus/templates/header',$data);
    $this->load->view('fusfus/v_singleProduct',$data);
    $this->load->view('fusfus/templates/footer',$data);
    
  }

  public function inputKomentar() {
    $komentar = htmlspecialchars($this->input->post('komentar'));
    $email = $this->input->post('email');
    $id_barang = $this->input->post('id_barang');
    $id_user = $this->input->post('id_user');
    $data = [
      'komentar' => $komentar,
      'kode_barang_jualan' => $id_barang,
      'id_user' => $id_user,
      'date_comment' => time()
    ];
    $this->load->model('Mfusfuskomentar','komentar');
    $res = $this->komentar->InsertData('komentar_jualan',$data);
    $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Komentar Berhasil Di inputkan!</strong>
        </div>');
      redirect('fusfus/detailProduct/'.$id_barang);

  }

  public function kirimkeluhan() {
    $data['title'] = 'Kirim Keluhan';
    $data['user'] = $this->db->get_where('users', [
      'email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('keluhan','Keluhan','required|trim');
    if ($this->form_validation->run() == false) {          
      $this->load->view('templates/header_after',$data);
      $this->load->view('templates/sidebar_after',$data);
      $this->load->view('templates/topbar_after',$data);
      $this->load->view('fusfus/v_kirimkeluhan',$data);
      $this->load->view('templates/footer_after');
    } else {
      $keluhan = $this->input->post('keluhan');
      $data = [
        'keluhan' => $keluhan,
        'id_user' => $data['user']['id'],
        'date_keluhan' => time()
      ];
      $this->load->model('Mfusfuskomentar','keluhan');
      $res = $this->keluhan->InsertData('keluhan_user',$data);
      $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Keluhan Berhasil Di Kirim!</strong>
        </div>');
      redirect('fusfus/kirimkeluhan');      
  }
}
}