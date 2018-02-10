<?php 
	class admin extends CI_Controller 
	{
		public function login(){	
			//redirect kalo dah login
			if ($sesi = $this->session->username) {
				redirect('admin/home');
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$this->load->model('Admin_model');

				$login = $this->Admin_model->Get_DataAdmin($username, $password);
				if ($login) {
					$this->session->set_userdata('username', $username);
					redirect('/admin/home');
				} else
				{
					$this->session->set_flashdata('item', 'Authentication Error');
					redirect('/admin/login');
				}
			}
			$this->load->view('templates/admin/header');
			$this->load->view('admin/login');
			$this->load->view('templates/admin/footer');
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('admin');
		}

		public function home($page = 'home'){
			if (!$sesi = $this->session->username) {
			redirect('admin/login');
			}

			$this->load->model('Admin_model');

			$jumlah_user = $this->Admin_model->get_JumlahUser();
			$jumlah_pria = $this->Admin_model->get_JumlahPria();
			$jumlah_wanita = $this->Admin_model->get_JumlahWanita();
			$jumlah_lolos = $this->Admin_model->get_JumlahLolos();
			$jumlah_gagal = $this->Admin_model->get_JumlahGagal();
			
			$persentase = array( 
				'persenpria' => number_format(($jumlah_pria/$jumlah_user*100),2),
				'persenwanita' => number_format(($jumlah_wanita/$jumlah_user*100),2),
				'persenlolos' => number_format(($jumlah_lolos/$jumlah_user*100),2),
				'persengagal' => number_format(($jumlah_gagal/$jumlah_user*100),2)
			);

			$data = array(
				'jumlah_user' => $jumlah_user,
				'jumlah_pria' => $jumlah_pria,
				'jumlah_wanita' => $jumlah_wanita,
				'jumlah_lolos' => $jumlah_lolos,
				'jumlah_gagal' => $jumlah_gagal,
				'persenpria' => $persentase['persenpria'],
				'persenwanita' => $persentase['persenwanita'],
				'persenlolos' => $persentase['persenlolos'],
				'persengagal' => $persentase['persengagal']
				 );

			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/'.$page,$data);
			$this->load->view('templates/admin/footer');
		}

		public function result(){
			if (!$sesi = $this->session->username) {
			redirect('admin/login');
			}
			$this->load->model('Admin_model');
			$read = $this->Admin_model->read_user();
			$lolos = $this->Admin_model->result_lolos();
			$gagal = $this->Admin_model->result_gagal();
			$belum = $this->Admin_model->result_belum();


			
			$data['lolos'] = $lolos;
			$data['gagal'] = $gagal;
			$data['user'] = $read;
			$data['belum']= $belum;

			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/result',$data);
			$this->load->view('templates/admin/footer');
		}


	}