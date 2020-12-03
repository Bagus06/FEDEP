<?php defined('BASEPATH') or exit('No direct script access allowed');

class Folder_model extends CI_model
{	
	public function save($id = 0, $data = array())
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'folder gagal disimpan'];
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('folder', ['title'=>$data['title']])->row_array();
				$current_user = $this->db->get_where('folder', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('folder',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'folder berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'folder sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('folder', ['title'=>$data['title']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('folder',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'folder berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'folder sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$msg['data'] = $this->db->get_where('folder',['id'=>$id])->row_array();
		}
		return $msg;
	}

	public function all()
	{
		return $this->db->get('folder')->result_array();
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$check = $this->db->get_where('folder', ['id'=>$id])->row_array();

			if ($check['protect'] == 1) {
				return ['status' => 'danger', 'msg' => 'Protect (folder tidak dapat dihapus)'];
			}if ($check['deskripsi'] == 'for-corousel' || $check['deskripsi'] == 'for-galery') {
				return ['status' => 'danger', 'msg' => 'Protect paten (folder tidak dapat dihapus)'];
			}

			if ($this->db->delete('folder', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'folder berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'folder gagal dihapus'];
			}
		}
	}

	public function switch($id = 0)
	{
		$data = $this->input->get('switch');
		$switch = 1;
		if ($data == 1) {
			$switch = 2;
		}
		if (!empty($id)) {
			$this->db->set('protect', $switch);
			$this->db->where('id', $id);
			if ($this->db->update('folder')) {
				redirect(base_url('galery'),'refresh');
			}
		}
	}
}
