<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('folder_model');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function edit($id = 0)
	{
		$data = $this->folder_model->save($id);
		$this->load->view('index',['data'=>$data]);
	}

	public function list($id = 0)
	{
		$data['data'] = $this->folder_model->save($id);
		$data = $this->folder_model->all();
		
		$this->load->view('index', ['data'=>$data]);
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->folder_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}
}