<?php defined('BASEPATH') OR exit('No direct script access allowed');

class responses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('responses_model');
	}

	public function view()
	{
		$data = $this->responses_model->all();
		$this->load->view('index', ['data'=>$data]);
	}

	public function list($id=0)
	{
		$data = $this->responses_model->save($id);
		$this->load->view('index', ['data'=>$data]);
	}
}