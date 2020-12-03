<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function check_login()
	{
		$this->user_model->check_login();
	}

	public function login()
	{
		$this->load->view('user/login',['data'=>$this->user_model->login()]);
	}

	public function register()
	{
		$this->load->view('user/register',['data'=>$this->user_model->login()]);
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}

	public function edit($id = 0)
	{
		$data = $this->user_model->save($id);

		
		$this->load->library('upload');
		// $data['photo'] = $this->upload->data('photo');
		$this->load->view('index',['data'=>$data,'role'=>$this->user_model->role_all(), 'gender' => ['0' => ['id' => '0', 'title' => 'Perempuan'], '1' => ['id' => '1', 'title' => 'Laki-laki']], 'is_active' => ['0' => ['id' => '0', 'title' => 'not active'], '1' => ['id' => '1', 'title' => 'active']]]);
	}
	public function list()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('user/list');
		$config['total_rows'] = $this->user_model->count_user();
		$config['per_page'] = 12;

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

		$data = $this->user_model->all($config['per_page'], $url);
		$data['url'] = $url;
		$this->load->view('index', ['data'=>$data, 'role'=>$this->user_model->role_all()]);
	}

	public function user_profil($id = 0)
	{
		$data = $this->user_model->user_profil($id);
		$this->load->view('index', ['data'=>$data, 'gender' => ['0' => ['id' => '0', 'title' => 'Perempuan'], '1' => ['id' => '1', 'title' => 'Laki-laki']]]);
	}

	public function profile_cluster($id=0)
	{
		$data = $this->user_model->profile_cluster($id);
		$this->load->view('index', ['data'=>$data['responses'], 'profiles'=>$data['profile']]);
	}

	public function role()
	{
		$data = $this->user_model->role_save();
		$data['data'] = $this->user_model->role_all();
		$this->load->view('index',['data'=>$data]);
	}

	public function role_edit($id = 0)
	{
		if(!empty($id))
		{
			$data = $this->user_model->role_save($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}

	public function role_delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->user_model->role_delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->user_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}

	public function file_download($id='')
	{
		$this->load->helper('download');
		if(!empty($this->uri->rsegments[3]))
		{
			$data  = file_get_contents(base_url('assets/images/user/') . $this->uri->rsegments[3]); 
		}
		$name   = $this->uri->rsegments[3];
		force_download($name, $data);
		exit;
	}
}