<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Galery extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('galery_model');
		$this->load->model('folder/folder_model');
		// $this->check_login();
	}

	public function edit($id = 0)
	{
		$data['data'] = $this->galery_model->save($id);
		$data['folder'] = $this->folder_model->all();
		$this->load->view('index', ['data'=>$data]);
	}

	public function list_folder($id = 0)
	{
		if (!empty($this->input->get('switch'))) {
			$this->folder_model->switch($id);
		}
		$data = $this->folder_model->save($id);
		$data['folder'] = $this->folder_model->all();


		$this->load->view('index', ['data'=>$data]);
	}

	public function folder($id=0)
	{
		$data = $this->galery_model->all($id);

		$this->load->view('index', ['data'=>$data]);
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->galery_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}
}