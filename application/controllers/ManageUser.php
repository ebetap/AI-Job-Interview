<?php 
	class manageuser extends CI_Controller
	{
		public function create(){			
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){

			$data = array(
			'noktp' => $this->input->post('noktp'),
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'result' => -1);

			$this->load->model('Admin_model');
			$create = $this->Admin_model->create_user($data);
			
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
			$read = $this->Admin_model->read_user();

			$data['user'] = $read;

			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/read',$data);
			$this->load->view('templates/admin/footer');
		}
		public function update(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id = $this->input->post('userid');

			$data = array(
			'noktp' => $this->input->post('noktp'),
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT));

			$this->load->model('Admin_model');
			$update = $this->Admin_model->update_user($data,$id);

			if ($update) {
			redirect('/admin/manage/user/update?=sukses');
			} else
			{
			$this->session->set_flashdata('item', 'Creation Fail');
			redirect('/update?=gagal');
			}

			}
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/update');
			$this->load->view('templates/admin/footer');
		}
		public function delete(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id = $this->input->post('userid');

			$this->load->model('Admin_model');
			$delete = $this->Admin_model->delete_user($id);
			if ($delete) {
			redirect('/admin/manage/user/delete?=sukses');
			} else
			{
			$this->session->set_flashdata('item', 'Creation Fail');
			redirect('/delete?=gagal');
			}

			}
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/delete');
			$this->load->view('templates/admin/footer');
		}
	}