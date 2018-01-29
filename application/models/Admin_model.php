<?php 
	class Admin_model extends CI_Model
	{		
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
	}