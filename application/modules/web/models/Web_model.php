<?php defined('BASEPATH') or exit('No direct script access allowed');

class Web_model extends CI_model
{
	public function content($limit, $start, $id = 0)
	{
		$msg=[];

		if (!empty($this->input->get('berita'))) {
			$msg['berita'] = $this->db->get_where('berita', ['cat_id'=>$this->input->get('berita')], $limit, $start)->result_array();
		}elseif(!empty($this->input->get('single'))){
			$msg['berita'] = $this->db->get_where('berita', $limit, $start, ['id'=>$this->input->get('single')])->row_array();
		}else{
			$msg['berita'] = $this->db->get('berita', $limit, $start)->result_array();
		}
		$msg['data'] = $this->db->get_where('galery',['folder_id'=>$id])->result_array();

		return $msg;
	}

	public function single_content($id=0)
	{
		return $this->db->get_where('berita', ['id'=>$this->input->get('single')])->row_array();
	}

	public function count_berita()
	{
		if (!empty($this->input->get('berita'))) {
			return $this->db->get_where('berita', ['cat_id'=>$this->input->get('berita')])->num_rows();
		}else{
			return $this->db->get('berita')->num_rows();
		}
	}

	public function berita_cat($id = 0)
	{
		return $this->db->get('berita_cat')->result_array();
	}

	public function image_for()
	{
		if ($this->uri->rsegments[2] == 'list') {
			$fselect = $this->db->get_where('folder', ['deskripsi'=>'for-corousel'])->row_array();
			$msg = $this->db->get_where('galery', ['folder_id'=>$fselect['id']])->result_array();
		}elseif ($this->uri->rsegments[2] == 'galery') {
			$fselect = $this->db->get_where('folder', ['deskripsi'=>'for-galery'])->row_array();
			$msg = $this->db->get_where('galery', ['folder_id'=>$fselect['id']])->result_array();
		}
		return $msg;
	}
}
