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
	}