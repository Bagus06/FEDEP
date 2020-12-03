<?php defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_model
{	
	public function save($id = 0, $data = array())
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'berita gagal disimpan'];
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('berita', ['judul'=>$data['judul']])->row_array();
				$current_user = $this->db->get_where('berita', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('berita',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'berita berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'berita sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('berita', ['judul'=>$data['judul']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('berita',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'berita berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'berita sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$msg['data'] = $this->db->get_where('berita',['id'=>$id])->row_array();
		}
		return $msg;
	}

	public function all($limit, $start)
	{
		$data = [];
		$data['data'] = $this->db->get('berita', $limit, $start)->result_array();
		$bc = $this->db->get('berita')->result_array();

		$data['semua'] = count($bc);
		$data['perbulan'] = 0;
		foreach ($bc as $key => $value) {
			if (date("F", strtotime($value['created'])) == date("F")) {
				$data['perbulan']++;
			}
		}

		if (!empty($this->input->get('filter'))) {
			$month = date('m');
			$year = date('Y');
			$this->db->where('MONTH(created)', $month);
			$this->db->where('YEAR(created)', $year);
			$this->db->limit($limit, $start);
			$data['data'] = $this->db->get('berita')->result_array();
		}
		return $data;
	}

	public function count_berita()
	{
		$bc = $this->db->get('berita')->result_array();

		$data['semua'] = count($bc);
		$data['perbulan'] = 0;
		foreach ($bc as $key => $value) {
			if (date("F", strtotime($value['created'])) == date("F")) {
				$data['perbulan']++;
			}
		}
		if (!empty($this->input->get('filter'))) {
			return $data['perbulan'];
		}else{
			return  $this->db->get('berita')->num_rows();
		}
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('berita', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'berita berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'berita gagal dihapus'];
			}
		}
	}

	public function category_all()
	{
		return $this->db->get('berita_cat')->result_array();
	}
}
