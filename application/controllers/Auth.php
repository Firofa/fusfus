<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index() {
		$this->goToDefaultPage();
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password','password','trim|required');
		if($this->form_validation->run() == false) {
			$data['title'] = "Login Fusfus";
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			// Validasi Lolos Jalankan Login
			$this->_login();
		}

	
	}

	private function goToDefaultPage() {
	  if ($this->session->userdata('role_id') == 1) {
	    redirect('admin');
	  } else if ($this->session->userdata('role_id') == 2) {
	    redirect('user');
	  }
	}

	private function _login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('users', ['email' => $email] )->row_array();
		//Jika User ada
		if($user) {
			//Jika User Aktif
			if ($user['is_active'] == 1) {
				//Cek Password
				if(password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					//Cek Role
					if($user['role_id'] == 1){
						redirect('admin');
					} else {
						redirect('user');
					}

				} else {
					$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Wrong password!</strong>
				</div>');
				redirect('auth');
				}
			} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>This email has not been activated!</strong>
				</div>');
				redirect('auth');
			}
		} else {
		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Email is not registered!</strong> Please create an account first!
				</div>');
				redirect('auth');	
		}
	}

	public function registration_fus() {
		$this->goToDefaultPage();
		// Trim digunakan jika ada spasi di depan dan di belakang dihilangkan/tidak masuk database
		$this->form_validation->set_rules('name', 'name', 'required|trim');
		$this->form_validation->set_rules('email','email','required|trim|valid_email|is_unique[users.email]', [
					'is_unique' => 'This Email has already registered!'
			]);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]' , [
					'matches' => 'Password dont match!',
					'min_length' => 'Password too short!',

			]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');
		$this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|trim|numeric|min_length[10]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['title'] = "Registration Fusfus";
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');	
		} else {
			$email = $this->input->post('email', true);
			$no_hp = $this->input->post('no_hp');
			$alamat = $this->input->post('alamat');
			$data = [
				// true untuk menghindari XSS
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'saldo_user' => 0,
				'no_hp' => htmlspecialchars($no_hp),
				'alamat' => htmlspecialchars($alamat),
				'date_created' => time()
			];

			//Siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->load->model('Mfusfusmodel');
			$this->Mfusfusmodel->InsertData('users',$data);
			$this->Mfusfusmodel->InsertData('users_token',$user_token);
			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well done!</strong> You successfully created account! Please Activate Your Account.
				</div>');
			redirect('auth');	
		}
	}


		private function _sendEmail($token, $type) {

			$this->load->library('email');
			$config = array();
		        $config['protocol'] = 'smtp';
		        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
		        $config['smtp_user'] = 'firizkismurf@gmail.com';
		        $config['smtp_pass'] = 'beruanghibernasi123';
		        $config['smtp_port'] = 465;
		        $config['mailtype'] = 'html';
		        $config['charset'] = 'utf-8';
        	$this->email->initialize($config);

        	$this->email->set_newline("\r\n");
			// $this->email->initialize($config);

			$this->email->from('firizkismurf@gmail.com','FusFus Admin');
			$this->email->to($this->input->post('email'));
			if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click This Link To Verify Your Account: <a href="'.base_url().'auth/verify?email='.$this->input->post('email').'&token='.urlencode($token).'"> Activate </a>');
			} else if($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click This Link To Reset Your Password: <a href="'.base_url().'auth/resetpassword?email='.$this->input->post('email').'&token='.urlencode($token).'"> Reset Password </a>');	
			}

			if($this->email->send()) {
				return true;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		}

	public function verify() {
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('users', ['email' => $email])->row_array();
		if($user) {
			$user_token = $this->db->get_where('users_token', ['token' => $token])->row_array();
			if($user_token) {
				if(time() - $user_token['date_created'] < (60*60*24*2) ) {
				$this->db->set('is_active',1);
				$this->db->where('email', $email);
				$this->db->update('users');
				$this->db->delete('users_token', ['email' => $email] );
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>'.$email.'</strong>  has been Activated! Please Login
				</div>');
			redirect('auth');
				} else {
				$this->db->delete('users', ['email' => $email]);
				$this->db->delete('users_token', ['email' => $email]);
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Account Activation Failed!</strong>  Token Expired.!
				</div>');
			redirect('auth');					
				}

			} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Account Activation Failed!</strong>  Token Invalid!
				</div>');
			redirect('auth');	
			}
		} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Account Activation Failed!</strong>  Wrong Email!
				</div>');
			redirect('auth');
		}
	}	


	public function logout() {
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>You have been logged out!</strong>  Please Come Back Again Later..
				</div>');
			redirect('auth');
	}


	public function blocked() {
		$this->load->view('auth/blocked');
	}

	public function forgotPassword() {
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		if($this->form_validation->run() == false) {
			$data['title'] = "Forgot Password";
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('users',['email' => $email, 'is_active' => 1])->row_array();

			if($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('users_token', $user_token);
				$this->_sendEmail($token, 'forgot');
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Please Check Your Email to reset your password!</strong>  
				</div>');
			redirect('auth');	
			} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Email Is Not Registered Or  Activated!</strong>  
				</div>');
			redirect('auth/forgotPassword');	
			}
		}
	}

	public function resetPassword() {
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('users',['email' => $email])->row_array();
		if($user) {
			$user_token = $this->db->get_where('users_token', ['token' => $token])->row_array();
			if($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();

			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Reset Password Failed!</strong> Wrong Token..  
				</div>');
			redirect('auth');		
			}
		} else {
		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Reset Password Failed!</strong> Wrong Email..  
				</div>');
			redirect('auth');	
		}
	}

	public function changePassword() {

		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]' , [
					'matches' => 'Password dont match!',
					'min_length' => 'Password too short!',

			]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');
		if($this->form_validation->run() == false) {
		$data['title'] = "Change Password";
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/change-password');
			$this->load->view('templates/auth_footer');
		} else {
			$password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');
			$this->db->set('password',$password);
			$this->db->where('email',$email);
			$this->db->update('users');
			$this->session->unset_userdata('reset_email');
			$this->db->delete('users_token', ['email' => $email]);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Password has been Changed!</strong> Please Login..  
				</div>');
			redirect('auth');	
		}
	}


}