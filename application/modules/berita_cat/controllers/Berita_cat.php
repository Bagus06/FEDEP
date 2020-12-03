<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_cat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('berita_cat_model');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function edit($id = 0)
	{
		$data = $this->berita_cat_model->save($id);
		$this->load->view('index',['data'=>$data]);
	}

	public function list($id = 0)
	{
		$data['data'] = $this->berita_cat_model->save($id);
		$data = $this->berita_cat_model->all();
		
		$this->load->view('index', ['data'=>$data]);
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->berita_cat_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}
}