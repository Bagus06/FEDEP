<?php defined('BASEPATH') or exit('No direct script access allowed');

class Berita_cat_model extends CI_model
{	
	public function save($id = 0, $data = array())
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'berita cat gagal disimpan'];
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('berita_cat', ['title'=>$data['title']])->row_array();
				$current_user = $this->db->get_where('berita_cat', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('berita_cat',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'berita cat berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'berita cat sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('berita_cat', ['title'=>$data['title']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('berita_cat',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'berita cat berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'berita cat sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$msg['data'] = $this->db->get_where('berita_cat',['id'=>$id])->row_array();
		}
		return $msg;
	}

	public function all()
	{
		return $this->db->get('berita_cat')->result_array();
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('berita_cat', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'berita cat berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'berita cat gagal dihapus'];
			}
		}
	}
}
