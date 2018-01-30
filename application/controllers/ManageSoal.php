<?php
	class managesoal extends CI_Controller
	{
		public function create(){

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$soal = $this->input->post('soal');
			$jawab1 = $this->input->post('jawab1');
			$jawab2 = $this->input->post('jawab2');
			$jawab3 = $this->input->post('jawab3');
			$jawab4 = $this->input->post('jawab4');
			$jawab5 = $this->input->post('jawab5');
			$jawab6 = $this->input->post('jawab6');

			$this->load->model('Admin_model');
			
			$create = $this->Admin_model->create_soal($soal,$jawab1,$jawab2,$jawab3,$jawab4,$jawab5,$jawab6);

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
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/soal/read');
			$this->load->view('templates/admin/footer');	
		}
		public function update(){
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/soal/update');
			$this->load->view('templates/admin/footer');
		}
		public function delete(){
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/soal/delete');
			$this->load->view('templates/admin/footer');
		}
	}