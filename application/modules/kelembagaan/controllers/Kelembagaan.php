<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelembagaan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kelembagaan_model');
	}

	public function index()
	{

	}

	public function edit($id = 0)
	{
		$data = $this->kelembagaan_model->save($id);
		
		$this->load->view('index',['data'=>$data]);
	}

	public function list()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('Kelembagaan/list');
		$config['total_rows'] = $this->kelembagaan_model->count_kelembagaan();
		$config['per_page'] = 10;

		if ($this->input->get('filter')) {
			$config['reuse_query_string'] = TRUE;
			$config['suffix'] = '?filter=' . $this->input->get('filter');
			$config['use_global_url_suffix'] = TRUE;
		}


		$config['full_tag_open'] = '<ul class="pagination m-0 justify-content-center">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		$config['num_links'] = 2; 
		
		$this->pagination->initialize($config);

		$url = 0;
		$url = @$this->uri->rsegments[3];
		if (empty($this->uri->rsegments[3])) {
			$url = 0;
		}

		$data = $this->kelembagaan_model->all($config['per_page'], $url);
		$data['url'] = $url;
		
		$this->load->view('index', ['data'=>$data]);
	}
}