<?php defined('BASEPATH') or exit('No direct script access allowed');

class Galery_model extends CI_model
{	
	public function save($id = 0, $data = array())
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			if ($this->input->post('folder_id') == 0) {
				$msg = ['status'=>'danger', 'msg'=>'Pilih folder'];
			}else{
				$msg = ['status'=>'danger', 'msg'=>'gambar gagal disimpan'];

				$format = "";
				if ($_FILES['img']['type'] == "image/png") {
					$format = ".png";
				}elseif ($_FILES['img']['type'] == "image/jpg") {
					$format = ".jpg";
				}elseif ($_FILES['img']['type'] == "image/jpeg") {
					$format = ".jpeg";
				}else {
					$msg = ['status'=>'danger', 'msg'=>'format file yang anda masukkan tidak didukung'];
					return $msg;
				}

				$t=time();
				$image_name = date("Y-m-d") . $t . $format;
				$this->db->select('id');
				$exist = $this->db->get_where('galery', ['img'=>$image_name])->row_array();
				$fselectc = $this->db->get_where('folder', ['deskripsi'=>'for-corousel'])->row_array();
				$fselectg = $this->db->get_where('folder', ['deskripsi'=>'for-galery'])->row_array();
				if(empty($exist))
				{
					if ($this->input->post('folder_id') == $fselectc['id']) {
						$bind_num = $this->db->get_where('galery', ['folder_id'=>$fselectc['id']])->num_rows();
						$bind_num = $bind_num + 1;
						$new_name = "corousel_" . $image_name;
					}elseif ($this->input->post('folder_id') == $fselectg['id']) {
						$bind_num = $this->db->get_where('galery', ['folder_id'=>$fselectg['id']])->num_rows();
						$bind_num = $bind_num + 1;
						$new_name = "post_" . $image_name;
					}else{
						$new_name = $image_name;
					}

					$data = [
						'folder_id' => $this->input->post('folder_id'),
						'img' => $new_name
					];

					if (!empty($_FILES['img'])) {
						$config['upload_path']          = FCPATH .'assets/upload_img/';
						$config['allowed_types']        = '*';
						$config['max_size']             = 3048;
						$config['file_name'] = $new_name;
						$config['overwrite']			= true;

						$this->load->library('upload');
						$this->upload->initialize($config);

						$size = $_FILES['img']['size']/1000;
						if ($size > $config['max_size']) {
							$msg = ['status'=>'danger', 'msg'=>'ukuran gambar terlalu besar, max ukuran gambar 3Mb'];
							return $msg;
						}
						
						if($this->upload->do_upload('img'))
						{
							if ($this->db->insert('galery', $data)) {
								$msg = ['status'=>'success', 'msg'=>'gambar berhasil disimpan'];
							} else {
								echo $this->upload->display_errors();
							}
						}
					}
				}else{
					$msg['msgs'][] = 'gambar sudah ada';
				}
			}
			if(!empty($id))
			{
				$msg['data'] = $this->db->get_where('galery',['id'=>$id])->row_array();
			}
		}
		return $msg;
	}

	public function all($id = 0)
	{
		$msg=[];
		$msg['data'] = $this->db->get_where('galery',['folder_id'=>$id])->result_array();
		$msg['folder_name'] = $this->db->get_where('folder',['id'=>$id])->row_array();

		return $msg;
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$bind_name = $this->db->get_where('galery',['id'=>$id])->row_array();
			$path = "./assets/upload_img/" . $bind_name['img'];
			
			if (unlink($path)) {
				if ($this->db->delete('galery', ['id' => $id])) {
					return ['status' => 'success', 'msg' => 'gambar berhasil dihapus'];
				} else {
					return ['status' => 'danger', 'msg' => 'gambar gagal dihapus'];
				}
			}else {
				return ['status' => 'danger', 'msg' => 'gambar gagal dihapus'];
			}
		}
	}
}
