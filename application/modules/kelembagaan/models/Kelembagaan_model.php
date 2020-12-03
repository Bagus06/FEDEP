<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kelembagaan_model extends CI_model
{	
	public function save($id = 0, $data = array())
	{
		if (is_cluster()) {
			$id = get_user()['id'];
		}
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'profil gagal disimpan'];
			$data = $this->input->post();
			$user = get_user()['id'];
			if(!empty($id))
			{
				if (!empty($_FILES['sk']['name'])) {
					$format = "";
					if ($_FILES['sk']['type'] == "image/png") {
						$format = ".png";
					}elseif ($_FILES['sk']['type'] == "image/jpg") {
						$format = ".jpg";
					}elseif ($_FILES['sk']['type'] == "image/jpeg") {
						$format = ".jpeg";
					}else {
						$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
					}

					$data['sk'] = 'SK-' . $user . $format;

					$config['upload_path']          = FCPATH .'assets/images/sk/';
					$config['allowed_types']        = '*';
					$config['max_size']             = 3048;
					$config['overwrite']			= true;
					$config['file_name'] = $data['sk'];

					$size = $_FILES['sk']['size']/1000;
					if ($size > $config['max_size']) {
						$msg = ['status'=>'danger', 'msg'=>'ukuran gambar terlalu besar, max ukuran gambar 3Mb'];
					}

					$this->load->library('upload');
					$this->upload->initialize($config);
					$this->upload->do_upload('sk');

				}else{
					$this->db->select('sk');
					$find = $this->db->get_where('profil_cluster', ['user_id'=>$user])->row_array();
					$data['sk'] = $find['sk'];
				}

				$this->db->select('id');
				$exist = $this->db->get_where('profil_cluster', ['user_id'=>$user])->row_array();
				if(!empty($exist))
				{
					$data = [
						'visi' => $data['visi'],
						'misi' => $data['misi'],
						'tujuan' => $data['tujuan'],
						'sk' => $data['sk'],
						'anggaran' => $data['anggaran'],
					];
					$this->db->where('user_id',$id);
					if($this->db->update('profil_cluster',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'profil berhasil disimpan'];
					}
				}else{
					$this->db->select('id');
					$exist = $this->db->get_where('profil_cluster', ['user_id'=>$user])->row_array();

					$data = [
						'user_id' => $user,
						'visi' => $data['visi'],
						'misi' => $data['misi'],
						'tujuan' => $data['tujuan'],
						'sk' => $data['sk'],
						'anggaran' => $data['anggaran'],
					];
					if(empty($exist))
					{
						if($this->db->insert('profil_cluster',$data))
						{
							$msg = ['status'=>'success', 'msg'=>'profil berhasil disimpan'];
						}
					}else{
						$msg['msgs'][] = 'profil sudah ada';
					}
				}
			}
		}
		if(!empty($id))
		{
			$this->db->select('a.user_id user_id, nama, visi, misi, tujuan, sk, anggaran');
			$this->db->from('profil_cluster a');
			$this->db->join('user_profile b', 'b.user_id=a.user_id', 'inner');
			$this->db->where('a.user_id', $id);
			$msg['data'] = $this->db->get()->row_array();
		}
		return $msg;
	}

	public function all($limit, $start)
	{
		$data = [];
		$msg['data'] = 0;
		if (is_pimpinan()) {
			$this->db->select('a.user_id user_id, nama, visi, misi, tujuan, sk, anggaran');
			$this->db->from('profil_cluster a');
			$this->db->join('user_profile b', 'b.user_id=a.user_id', 'inner');
			$msg['data'] = $this->db->get()->result_array();
		}
		return $data;
	}

	public function detail($id=0)
	{
		$this->db->select('a.user_id user_id, nama, visi, misi, tujuan, sk, anggaran');
		$this->db->from('profil_cluster a');
		$this->db->join('user_profile b', 'b.user_id=a.user_id', 'inner');
		$this->db->where('a.user_id', $id);
		$msg['data'] = $this->db->get()->row_array();
		return $data;
	}

	public function count_kelembagaan()
	{
		$pc = 0;
		if (is_pimpinan()) {
			$this->db->select('a.user_id user_id');
			$this->db->from('profil_cluster a');
			$this->db->join('user_profile b', 'b.user_id=a.user_id', 'inner');
			$pc = $this->db->get()->num_rows();
		}
		return $pc;
	}
}
