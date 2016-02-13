<?php 
	/**
	* 
	*/
	class Image extends CI_Model
	{
		
		public function insert($data)
		{
			$this->db->insert('tblgambar',$data);	
		}
		public function getData($param)
		{
			$this->db->where('image',$param);
			return $this->db->get('tblgambar');
		}

	}