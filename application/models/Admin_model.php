<?php 
	class Admin_model extends CI_Model
	{	
		public function __construct(){
		$this->load->database();	
		}
		//Model untuk data Dashboard	
		public function get_DataAdmin($user,$pass){
			$query = $this->db->get_where('admin', array('username' => $user), 1, 0);

			$row = $query->row();
			if($anu = $row && $row->password)
			{
				return $row;
			} else {
				return false;
			}
		}

		public function get_JumlahUser(){
			$query = $this->db->query('SELECT * FROM t_user');
			$row = $query->num_rows();
			return $row;
		}

		public function get_JumlahPria(){
			$query = $this->db->query('SELECT * FROM t_user WHERE gender="male"');
			$row = $query->num_rows();
			return $row;
		}

		public function get_JumlahWanita(){
			$query = $this->db->query('SELECT * FROM t_user WHERE gender="female"');
			$row = $query->num_rows();
			return $row;
		}

		public function get_JumlahLolos(){
			$query = $this->db->query('SELECT * FROM t_user WHERE result BETWEEN 5 AND 11');
			$row = $query->num_rows();
			return $row;
		}

		public function get_JumlahGagal(){
			$query = $this->db->query('SELECT * FROM t_user WHERE result BETWEEN 0 AND 5');
			$row = $query->num_rows();
			return $row;
		}

		//Model untuk data Soal
		public function create_soal($data){
			$query = $this->db->insert('t_soal', $data);
			return $query;
		}

		public function read_soal(){
			$query = $this->db->query('SELECT * FROM t_soal');

			return $query->result_array();
		}

		public function update_soal($data,$nomor){
			$this->db->where('no',$nomor);
			$query = $this->db->update('t_soal',$data);

			return $query;
		}

		public function delete_soal($nomor){
			$this->db->where('no',$nomor);
			$query = $this->db->delete('t_soal');

			return $query;
		}

		//MModel untuk data User
		public function create_user($data){
			$query = $this->db->insert('t_user',$data);
			return $query;
		}

		public function read_user(){
			$query = $this->db->query('SELECT * FROM t_user');

			return $query->result_array();
		}

		public function update_user($data,$id){
			$this->db->where('userID',$id);
			$query = $this->db->update('t_user',$data);

			return $query;
		}

		public function delete_user($id){
			$this->db->where('userID',$id);
			$query = $this->db->delete('t_user');

			return $query;
		}

	}