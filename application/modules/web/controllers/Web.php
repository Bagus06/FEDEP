<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('web_model');
		$this->load->model('berita/berita_model');
	}

	public function list($id=0)
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('web/list');
		$config['total_rows'] = $this->web_model->count_berita();
		$config['per_page'] = 5;

		if ($this->input->get('berita')) {
			$config['reuse_query_string'] = TRUE;
			$config['suffix'] = '?berita=' . $this->input->get('berita');
			$config['use_global_url_suffix'] = TRUE;
		}


		$config['full_tag_open'] = '<div class="row"><div class="col-md-12"><nav aria-label="Page navigation"><ul class="pagination justify-content-start">';
		$config['full_tag_close'] = '</ul></nav></div></div>';

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

		$config['cur_tag_open'] = '<li class="page-item"><a class="page-link" href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		// $config['num_links'] = ; 
		
		$this->pagination->initialize($config);

		$url = 0;
		$url = @$this->uri->rsegments[3];

		$data = $this->web_model->content($config['per_page'], $url, $id);
		$category = $this->web_model->berita_cat();
		$image_for = $this->web_model->image_for();


		$this->load->view('index', ['data'=>$data, 'berita_cat'=>$category, 'image'=>$image_for]);
	}

	public function single_content($id=0)
	{
		$data = $this->web_model->single_content($id);
		$category = $this->web_model->berita_cat();

		$this->load->view('index', ['data'=>$data, 'berita_cat'=>$category]);
	}

	public function single_kontak($id=0)
	{
		$category = $this->web_model->berita_cat();
		$this->load->view('index', ['berita_cat'=>$category]);
	}

	public function galery($id=0)
	{
		$data = $this->web_model->image_for();
		$this->load->view('index', ['data'=>$data]);
	}
}