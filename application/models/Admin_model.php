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
		public function create_soal($soal,$jawab1,$jawab2,$jawab3,$jawab4,$jawab5,$jawab6){
		$query = $this->db->insert('t_soal', array('soal' => $soal,'system_answer' => $jawab1,'system_answer2' => $jawab2,'system_answer3' => $jawab3,'system_answer4' => $jawab4,'system_answer5' => $jawab5,'system_answer6' => $jawab6));
		return $query;
		}

		//MModel untuk data User
		public function create_user($ktp,$nama,$username,$email,$gender,$pass){
		$query = $this->db->insert('t_user', array('noktp' => $ktp,'fullname' => $nama,'username' => $username,'email' => $email,'gender' => $gender,'password' => $pass));
		return $query;
		}
	}