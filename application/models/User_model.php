<?php 
	class User_model extends CI_Model
	{		
		public function __construct(){
		$this->load->database();	
		}

		public function registrasi($ktp,$nama,$username,$email,$gender,$pass){
		$query = $this->db->insert('t_user', array('noktp' => $ktp,'fullname' => $nama,'username' => $username,'email' => $email,'gender' => $gender,'password' => $pass));
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
		public function get_system_answer1(){
			$query = $this->db->query('SELECT system_answer FROM t_soal');

			return $query->result_array();
		}
		public function get_system_answer2(){
			$query = $this->db->query('SELECT system_answer2 FROM t_soal');

			return $query->result_array();
		}
		public function get_system_answer3(){
			$query = $this->db->query('SELECT system_answer3 FROM t_soal');

			return $query->result_array();
		}
		public function get_system_answer4(){
			$query = $this->db->query('SELECT system_answer4 FROM t_soal');

			return $query->result_array();
		}
		public function get_system_answer5(){
			$query = $this->db->query('SELECT system_answer5 FROM t_soal');

			return $query->result_array();
		}
		public function get_system_answer6(){
			$query = $this->db->query('SELECT system_answer6 FROM t_soal');

			return $query->result_array();
		}

		public function get_stopword(){
			$query = $this->db->query('SELECT * FROM stopword');
			return $query->result_array();
		}
		public function get_katadasar($kata){
			$query = $this->db->query("SELECT * FROM tb_katadasar WHERE katadasar='$kata'");
			
			$anu =  $query->result_array();
			
			$row = $query->row_array();
			 
			return $row;
		}
		public function get_result($sesi){
			$query =$this->db->query("SELECT result FROM t_user WHERE username='$sesi'");

			return $query->num_rows();
		}
		public function post_result($result,$sesi){
			$this->db->set('result', $result, FALSE);
			$this->db->where('username', $sesi);
			$query = $this->db->update('t_user');
			
			return $query;
		}
	}