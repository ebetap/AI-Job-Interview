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
				$get_sa1 = $this->User_model->get_system_answer1();
				$get_sa2 = $this->User_model->get_system_answer2();
				$get_sa3 = $this->User_model->get_system_answer3();
				$get_sa4 = $this->User_model->get_system_answer4();
				$get_sa5 = $this->User_model->get_system_answer5();
				$get_sa6 = $this->User_model->get_system_answer6();
				
				$system_answer = array();
					foreach ($get_sa1 as $key => $value) 
					{
						$system_answer[$key] = $value["system_answer"];
					}
				$system_answer2 = array();
					foreach ($get_sa2 as $key => $value) 
					{
						$system_answer2[$key] = $value["system_answer2"];
					}
				$system_answer3 = array();
					foreach ($get_sa3 as $key => $value) 
					{
						$system_answer3[$key] = $value["system_answer3"];
					}
				$system_answer4 = array();
					foreach ($get_sa4 as $key => $value) 
					{
						$system_answer4[$key] = $value["system_answer4"];
					}
				$system_answer5 = array();
					foreach ($get_sa5 as $key => $value) 
					{
						$system_answer5[$key] = $value["system_answer5"];
					}
				$system_answer6 = array();
					foreach ($get_sa6 as $key => $value) 
					{
						$system_answer6[$key] = $value["system_answer6"];
					}

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

				$parse_answer  = parser($answer);
		 		$parse_answer1 = parser($system_answer);
		 		$parse_answer2 = parser($system_answer2);
		 		$parse_answer3 = parser($system_answer3);
		 		$parse_answer4 = parser($system_answer4);
		 		$parse_answer5 = parser($system_answer5);
		 		$parse_answer6 = parser($system_answer6);
		 		 		
		 		$filter_answer  = filter($parse_answer, $stopword);
		 		// var_dump($filter_answer);
		 		// exit;
		 		$filter_answer1 = filter($parse_answer1, $stopword);
		 		$filter_answer2 = filter($parse_answer2, $stopword);
		 		$filter_answer3 = filter($parse_answer3, $stopword);
		 		$filter_answer4 = filter($parse_answer4, $stopword);
		 		$filter_answer5 = filter($parse_answer5, $stopword);
		 		$filter_answer6 = filter($parse_answer6, $stopword);

		 		$steamming_answer = steamming($filter_answer);
		 		$steamming_answer1 = steamming($filter_answer1);
		 		$steamming_answer2 = steamming($filter_answer2);
		 		$steamming_answer3 = steamming($filter_answer3);
		 		$steamming_answer4 = steamming($filter_answer4);
		 		$steamming_answer5 = steamming($filter_answer5);
		 		$steamming_answer6 = steamming($filter_answer6);

		 		$no_space_answer = no_space($steamming_answer);
		 		$no_space_answer1 = no_space($steamming_answer1);
		 		$no_space_answer2 = no_space($steamming_answer2);
		 		$no_space_answer3 = no_space($steamming_answer3);
		 		$no_space_answer4 = no_space($steamming_answer4);
		 		$no_space_answer5 = no_space($steamming_answer5);
		 		$no_space_answer6 = no_space($steamming_answer6);

		 		$kgram_2_answer = kgram_2($no_space_answer);
		 		$kgram_2_answer1 = kgram_2($no_space_answer1);
		 		$kgram_2_answer2 = kgram_2($no_space_answer2);
		 		$kgram_2_answer3 = kgram_2($no_space_answer3);
		 		$kgram_2_answer4 = kgram_2($no_space_answer4);
		 		$kgram_2_answer5 = kgram_2($no_space_answer5);
		 		$kgram_2_answer6 = kgram_2($no_space_answer6);

		 		$change_to_ascii_indek_0_answer = change_to_ascii_indek_0($kgram_2_answer);
		 		$change_to_ascii_indek_0_answer1 = change_to_ascii_indek_0($kgram_2_answer1);
		 		$change_to_ascii_indek_0_answer2 = change_to_ascii_indek_0($kgram_2_answer2);
		 		$change_to_ascii_indek_0_answer3 = change_to_ascii_indek_0($kgram_2_answer3);
		 		$change_to_ascii_indek_0_answer4 = change_to_ascii_indek_0($kgram_2_answer4);
		 		$change_to_ascii_indek_0_answer5 = change_to_ascii_indek_0($kgram_2_answer5);
		 		$change_to_ascii_indek_0_answer6 = change_to_ascii_indek_0($kgram_2_answer6);
		 		
		 		$change_to_ascii_indek_1_answer = change_to_ascii_indek_1($kgram_2_answer);
		 		$change_to_ascii_indek_1_answer1 = change_to_ascii_indek_1($kgram_2_answer1);
		 		$change_to_ascii_indek_1_answer2 = change_to_ascii_indek_1($kgram_2_answer2);
		 		$change_to_ascii_indek_1_answer3 = change_to_ascii_indek_1($kgram_2_answer3);
		 		$change_to_ascii_indek_1_answer4 = change_to_ascii_indek_1($kgram_2_answer4);
		 		$change_to_ascii_indek_1_answer5 = change_to_ascii_indek_1($kgram_2_answer5);
		 		$change_to_ascii_indek_1_answer6 = change_to_ascii_indek_1($kgram_2_answer6);

		 		$plus_indek_0_and_indek_1_answer  = plus_indek_0_and_indek_1($no_space_answer,  $change_to_ascii_indek_0_answer,   $change_to_ascii_indek_1_answer);
		 		$plus_indek_0_and_indek_1_answer1 = plus_indek_0_and_indek_1($no_space_answer1, $change_to_ascii_indek_0_answer1, $change_to_ascii_indek_1_answer1);
		 		$plus_indek_0_and_indek_1_answer2 = plus_indek_0_and_indek_1($no_space_answer2, $change_to_ascii_indek_0_answer2, $change_to_ascii_indek_1_answer2);
		 		$plus_indek_0_and_indek_1_answer3 = plus_indek_0_and_indek_1($no_space_answer3, $change_to_ascii_indek_0_answer3, $change_to_ascii_indek_1_answer3);
		 		$plus_indek_0_and_indek_1_answer4 = plus_indek_0_and_indek_1($no_space_answer4, $change_to_ascii_indek_0_answer4, $change_to_ascii_indek_1_answer4);
		 		$plus_indek_0_and_indek_1_answer5 = plus_indek_0_and_indek_1($no_space_answer5, $change_to_ascii_indek_0_answer5, $change_to_ascii_indek_1_answer5);
		 		$plus_indek_0_and_indek_1_answer6 = plus_indek_0_and_indek_1($no_space_answer6, $change_to_ascii_indek_0_answer6, $change_to_ascii_indek_1_answer6);

		 		$count_same_value_answer1 = count_same_value($plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer1);
		 		$count_same_value_answer2 = count_same_value($plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer2);
		 		$count_same_value_answer3 = count_same_value($plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer3);
		 		$count_same_value_answer4 = count_same_value($plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer4);
		 		$count_same_value_answer5 = count_same_value($plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer5);
		 		$count_same_value_answer6 = count_same_value($plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer6);

		 		$sum_array_answer1 = sum_array($no_space_answer, $no_space_answer1, $plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer1);
		 		$sum_array_answer2 = sum_array($no_space_answer, $no_space_answer2, $plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer2);
		 		$sum_array_answer3 = sum_array($no_space_answer, $no_space_answer3, $plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer3);
		 		$sum_array_answer4 = sum_array($no_space_answer, $no_space_answer4, $plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer4);
		 		$sum_array_answer5 = sum_array($no_space_answer, $no_space_answer5, $plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer5);
		 		$sum_array_answer6 = sum_array($no_space_answer, $no_space_answer6, $plus_indek_0_and_indek_1_answer, $plus_indek_0_and_indek_1_answer6);

		 		$textSimilarity1 = textSimilarity($count_same_value_answer1, $sum_array_answer1);
		 		$textSimilarity2 = textSimilarity($count_same_value_answer2, $sum_array_answer2);
		 		$textSimilarity3 = textSimilarity($count_same_value_answer3, $sum_array_answer3);
		 		$textSimilarity4 = textSimilarity($count_same_value_answer4, $sum_array_answer4);
		 		$textSimilarity5 = textSimilarity($count_same_value_answer5, $sum_array_answer5);
		 		$textSimilarity6 = textSimilarity($count_same_value_answer6, $sum_array_answer6);
				

			 		$compare = array();
					foreach ($textSimilarity1 as $key => $value) 
					{
						if (
							$value >= $textSimilarity2[$key] &&
							$value >= $textSimilarity3[$key] &&
							$value >= $textSimilarity4[$key] &&
							$value >= $textSimilarity4[$key] &&
							$value >= $textSimilarity6[$key]
						   ) 
						{
							$compare[] = $value;	
						}
						else if (
								 $textSimilarity2 >= $value &&
								 $textSimilarity2 >= $textSimilarity3 &&
								 $textSimilarity2 >= $textSimilarity4 &&
								 $textSimilarity2 >= $textSimilarity5 &&
								 $textSimilarity2 >= $textSimilarity6 
								)
						{
							$compare[] = $textSimilarity2[$key];
						}
						else if (
								 $textSimilarity3 >= $value &&
								 $textSimilarity3 >= $textSimilarity2 &&
								 $textSimilarity3 >= $textSimilarity4 &&
								 $textSimilarity3 >= $textSimilarity5 &&
								 $textSimilarity3 >= $textSimilarity6 
								) 
						{
							$compare[] = $textSimilarity3[$key];
						}
						else if (
								 $textSimilarity4 >= $value &&
								 $textSimilarity4 >= $textSimilarity2 &&
								 $textSimilarity4 >= $textSimilarity3 &&
								 $textSimilarity4 >= $textSimilarity5 &&
								 $textSimilarity4 >= $textSimilarity6 
								) 
						{
							$compare[] = $textSimilarity4[$key];
						}
						else if (
								 $textSimilarity5 >= $value &&
								 $textSimilarity5 >= $textSimilarity2 &&
								 $textSimilarity5 >= $textSimilarity3 &&
								 $textSimilarity5 >= $textSimilarity4 &&
								 $textSimilarity5 >= $textSimilarity6 
								) 
						{
							$compare[] = $textSimilarity5[$key];
						}
						else 
						{
							$compare[] = $textSimilarity6[$key];
						}
					}
					$pembulatan = array();	
					foreach ($compare as $key => $value) 
					{
						if ($value >= 0.5) 
						{
							$pembulatan[] = 1;
						}
						else
						{
							$pembulatan[] = 0;
						}
					}
					$result = array_sum($compare);
					var_dump($result);
					exit;
					$anoo = $this->User_model->post_result($result,$sesi);
			}
			$soal = $this->Admin_model->read_soal();	

			$data['soal'] = $soal;

			$this->load->view('templates/user/dashboard');
			$this->load->view('user/interview',$data);
			$this->load->view('templates/user/footer');
		}			
	}