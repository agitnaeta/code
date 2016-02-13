<?php 
	/**
	* 
	*/
	class Upload extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('image');

		}
		public function index()
		{
			$this->load->view('form_upload');
		}
		public function do_upload()
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name']=TRUE;
			$config['max_size']	= '5000';
			$config['max_width']  = '5000';
			$config['max_height']  = '5000';

			$this->load->library('upload', $config);

			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload())
			{
				echo $this->upload->display_errors();
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$namaFile=$data['upload_data']['file_name'];
				$data = array('image' => $namaFile);
				$this->image->insert($data); #method pada model image
				echo "Berhasil Upload";
			
			}
		}
		public function displayImage($param)
		{
			$data=$this->image->getData($param);
			foreach ($data->result() as $row)
			{
				echo "<img src=".base_url("uploads/$row->image").">";
			}
		}
	}