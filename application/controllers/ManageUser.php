<?php 
	class manageuser extends CI_Controller
	{
		public function create(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$ktp = $this->input->post('noktp');
				$nama = $this->input->post('fullname');
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$gender = $this->input->post('gender');
				$pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

				$this->load->model('Admin_model');
				
				$create = $this->Admin_model->create_user($ktp,$nama,$username,$email,$gender,$pass);
				
				if ($create) {
				redirect('/admin/manage/user/create?=sukses');
				} else
				{
				$this->session->set_flashdata('item', 'Creation Fail');
				redirect('/admin/manage/user/create?=gagal');
				}

			}
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/create');
			$this->load->view('templates/admin/footer');
		}
		public function read(){
			$this->load->model('Admin_model');

			$user = $this->Admin_model->read_user();

			$data['user'] = $user;

			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/read',$data);
			$this->load->view('templates/admin/footer');
		}
		public function update(){
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/update');
			$this->load->view('templates/admin/footer');
		}
		public function delete(){
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/delete');
			$this->load->view('templates/admin/footer');
		}
	}