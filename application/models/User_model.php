<?php 
	class User_model extends CI_Model
	{		
		public function __construct(){
		$this->load->database();	
		}

		public function registrasi($ktp,$nama,$username,$email,$gender,$pass){
		$query = $this->db->insert('t_user', array('noktp' => $ktp,'fullname' => $nama,'username' => $username,'email' => $email,'gender' => $gender,'password' => $pass, 'result' => "belum mengerjakan"));
		return $query;
		}
		

		public function cek_login($user,$pass){
			$query = $this->db->get_where('t_user', array('username' => $user), 1, 0);

			$row = $query->row();

			if($row && password_verify( $pass, $row->password))
			{
				return $row;
			} else {
				return false;
			}
		}

		public function lihat_profil($user)
		{
			$query = $this->db->get_where('t_user', array('username' => $user), 1, 0);
			$row = $query->row();

			return $row;
		}
		public function get_system_answer(){
			$query = $this->db->query('SELECT system_answer,system_answer2,system_answer3,system_answer4,system_answer5,system_answer6 FROM t_soal');

			return $query->result_array();
		}
	}