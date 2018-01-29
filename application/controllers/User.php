<?php 
	class User extends CI_Controller 
	{
		public function view($page = 'index')
		{
			if (!file_exists(APPPATH.'views/user/'.$page.'.php')) {
				show_404();
			}

			$data['title'] = ucfirst($page);

			$this->load->view('templates/user/header');
			$this->load->view('user/'.$page, $data);
			$this->load->view('templates/user/footer');
		}

		public function home($page = 'home')
		{	
			if (!$sesi = $this->session->username) {
				redirect('user/login');
			}
			if (!file_exists(APPPATH.'views/user/home.php')) {
				show_404();
			}
			$this->load->library('session');
			$data['title'] = ucfirst($page);

			$this->load->view('templates/user/dashboard');
			$this->load->view('user/home', $data);
			$this->load->view('templates/user/footer');
		}

		public function register()
		{
			if ($sesi = $this->session->username) {
				redirect('/home');
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$ktp = $this->input->post('noktp');
				$nama = $this->input->post('fullname');
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$gender = $this->input->post('gender');
				$pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

				$this->load->model('User_model');
				
				$daftar = $this->User_model->registrasi($ktp,$nama,$username,$email,$gender,$pass);

			}
			$this->load->view('templates/user/header');
			$this->load->view('user/register');
			$this->load->view('templates/user/footer');
		}

		public function login()
		{	
			//redirect kalo dah login
			if ($sesi = $this->session->username) {
				redirect('/home');
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$this->load->model('User_model');

				$login = $this->User_model->cek_login($username, $password);
				if ($login) {
					$this->session->set_userdata('username', $username);
					redirect('/home');
				} else
				{
					$this->session->set_flashdata('item', 'Authentication Error');
					redirect('user/login');
				}
			}
			$this->load->view('templates/user/header');
			$this->load->view('user/login');
			$this->load->view('templates/user/footer');
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('/user/login');
		}

		public function profil()
		{
			if (!$sesi = $this->session->username) {
				redirect('user/login');
			}

			$this->load->model('User_model');
			$fetch = $this->User_model->lihat_profil($sesi);
			

			$this->load->view('templates/user/dashboard');
			$this->load->view('user/profil');
			$this->load->view('templates/user/footer');
		}

		public function test()
		{

		}			
	}