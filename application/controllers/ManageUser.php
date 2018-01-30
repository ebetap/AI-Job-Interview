<?php 
	class manageuser extends CI_Controller
	{
		public function create(){
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/create');
			$this->load->view('templates/admin/footer');
		}
		public function read(){
			$this->load->view('templates/admin/dashboard');
			$this->load->view('admin/manage/user/read');
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