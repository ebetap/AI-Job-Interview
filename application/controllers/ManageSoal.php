<?php
	class managesoal extends CI_Controller
	{
		public function create(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	 	
			$data = array
			('soal' => $this->input->post('soal'), 
			'system_answer' => $this->input->post('jawab1'), 
			'system_answer2' => $this->input->post('jawab2'), 
			'system_answer3' => $this->input->post('jawab3'), 
			'system_answer4' => $this->input->post('jawab4'), 
			'system_answer5' => $this->input->post('jawab5'), 
			'system_answer6' => $this->input->post('jawab6'));

			$this->load->model('Admin_model');
			$create = $this->Admin_model->create_soal($data);

			if ($create) {
			redirect('/admin/manage/soal/create?=sukses');
			} else
			{
			$this->session->set_flashdata('item', 'Creation Fail');
			redirect('/create?=gagal');
			}

			}
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/soal/create');
			$this->load->view('templates/admin/footer');
		}
		public function read(){
			$this->load->model('Admin_model');
			$read = $this->Admin_model->read_soal();

			$data['soal'] = $read;

			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/soal/read',$data);
			$this->load->view('templates/admin/footer');	
		}
		public function update(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$nomor = $this->input->post('nomor');

			$data = array
			('soal' => $this->input->post('soal'), 
			'system_answer' => $this->input->post('jawab1'), 
			'system_answer2' => $this->input->post('jawab2'), 
			'system_answer3' => $this->input->post('jawab3'), 
			'system_answer4' => $this->input->post('jawab4'), 
			'system_answer5' => $this->input->post('jawab5'), 
			'system_answer6' => $this->input->post('jawab6'));

			$this->load->model('Admin_model');
			$update = $this->Admin_model->update_soal($data,$nomor);

			if ($update) {
			redirect('/admin/manage/soal/update?=sukses');
			} else
			{
			$this->session->set_flashdata('item', 'Creation Fail');
			redirect('/update?=gagal');
			}
			}
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/soal/update');
			$this->load->view('templates/admin/footer');
		}
		public function delete(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$nomor = $this->input->post('nomor');

			$this->load->model('Admin_model');
			$delete = $this->Admin_model->delete_soal($nomor);
			if ($delete) {
			redirect('/admin/manage/soal/delete?=sukses');
			} else
			{
			$this->session->set_flashdata('item', 'Creation Fail');
			redirect('/delete?=gagal');
			}
			}
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/soal/delete');
			$this->load->view('templates/admin/footer');
		}
	}