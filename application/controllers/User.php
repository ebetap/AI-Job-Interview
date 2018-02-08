<?php 
	class User extends CI_Controller 
	{
		public function view($page = 'index'){
			if (!file_exists(APPPATH.'views/user/'.$page.'.php')) {
				show_404();
			}

			$data['title'] = ucfirst($page);
			
			$this->load->view('user/'.$page, $data);
			$this->load->view('templates/user/footer');
		}

		public function home($page = 'home'){	
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

		public function register(){
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

				if ($daftar) {
				$this->session->set_userdata('username', $username);
				redirect('/home');
				} else
				{
					$this->session->set_flashdata('item', 'Authentication Error');
					redirect('user/login');
				}

			}
			$this->load->view('templates/user/header');
			$this->load->view('user/register');
			$this->load->view('templates/user/footer');
		}

		public function login(){	
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

		public function logout(){
			$this->session->sess_destroy();
			redirect('/user/login');
		}

		public function profil(){
			if (!$sesi = $this->session->username) {
				redirect('user/login');
			}

			$this->load->model('User_model');
			$fetch = $this->User_model->lihat_profil($sesi);
			

			$this->load->view('templates/user/dashboard');
			$this->load->view('user/profil');
			$this->load->view('templates/user/footer');
		}

		public function interview(){
			$this->load->model('Admin_model');
			$this->load->model('User_model');

			if (!$sesi = $this->session->username) {
				redirect('user/login');
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$jawab = $this->input->post('answer');
				$system_answer = $this->User_model->get_system_answer();
				$stop_word = $this->User_model->get_stopword();
				$stopword = array();

				foreach ($stop_word as $key => $value) 
				{
					foreach ($value as $key1 => $value1) 
					{
						$stopword[] = $value1;
					}
				}

				foreach ($jawab as $value){
					$answer [] = $value;
				}

				foreach ($answer as $key => $value) 
				{
					$parser[] = strtolower(preg_replace('/[^a-zA-Z ]/', '',$value));
				}
				foreach ($parser as $key => $value) 
				{
					$filter[] = preg_replace('/\b('.implode('|',$stopword).')\b/','',$value);
				}
				
				foreach ($filter as $key => $value) 
				{
					$stm[] = str_word_count($value, 1);
				}

				foreach ($stm as $key => $value) 
				{
					foreach ($value as $key1 => $value1) 
					{
						$stmm[$key][]= hapusakhiran(hapusawalan2(hapusawalan1(hapuspp(hapuspartikel($value1))))); 
					}
				}
				foreach ($stmm as $key => $value) 
				{
					$steamming[]= implode(' ', $value); 
				}
				var_dump($stemming);
				exit();
				foreach ($steamming as $key => $value) 
				{
					$no_space[] = preg_replace('/\s+/', '', $value);
				}
				 		for($i = 0; $i < count($no_space); $i++)
				{
				$kgram_2[$i] = array();				    
					for($j = 0; $j < (strlen($no_space[$i]) - 1); $j++)
					{	
					   $kgram_2[$i][] = substr($no_space[$i], $j, 2);
					}
				}
				$change_to_ascii_indek_0 = array();
				foreach ($kgram_2 as $key => $value) 
				{
					foreach ($value as $key1 => $value1) 
					{
						$change_to_ascii_indek_0[$key][] = ord($value1[0])*10;
					}
				}
				$change_to_ascii_indek_1 = array();
				foreach ($kgram_2 as $key => $value) 
				{
					foreach ($value as $key1 => $value1) 
					{
						$change_to_ascii_indek_1[$key][] = ord($value1[1])*1;
					}
				}
				$plus_indek_0_and_indek_1 = array();
				for($i = 0; $i < count($no_space); $i++)
				{
					for($j = 0; $j < (strlen($no_space[$i]) -1); $j++) 
					{
				  		$plus_indek_0_and_indek_1[$i][$j] = $change_to_ascii_indek_0[$i][$j] + $change_to_ascii_indek_1[$i][$j];
				  	}
				}
				$count_same_value = array();
				foreach ($plus_indek_0_and_indek_1_system as $key => $value) 
				{
					$count_same_value[] = count(array_intersect($value, $plus_indek_0_and_indek_1_user[$key]));
				}
				$sum_array_user = array();
					for($i = 0; $i < count($no_space_user); $i++)
					{
						for($j = 0; $j < (strlen($no_space_user[$i]) -1); $j++) 
						{
							$sum_array_user[$i] = count($plus_indek_0_and_indek_1_user[$i]);
						}
					}

				$sum_array_system = array();
					for($i = 0; $i < count($no_space_system); $i++)
					{
						for($j = 0; $j < (strlen($no_space_system[$i]) -1); $j++) 
						{
							$sum_array_system[$i] = count($plus_indek_0_and_indek_1_system[$i]);
						}
					}
			
				$sum_array = array();
					foreach ($sum_array_system as $key => $value) 
					{
						$count_rkr[] = $value + $sum_array_user[$key];
					}
					$textSimilarity = array();
				foreach ($sum_array as $key => $value) 
				{
					$textSimilarity[] = 2*$count_same_value[$key] / $value;
				}
			}
			$soal = $this->Admin_model->read_soal();	

			$data['soal'] = $soal;

			$this->load->view('templates/user/dashboard');
			$this->load->view('user/interview',$data);
			$this->load->view('templates/user/footer');
		}			
	}