<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_model
{	
	public function save($id = 0, $data = array())
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'produk gagal disimpan'];
			$data = $this->input->post();
			$user = get_user()['id'];
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('produk', ['nama'=>$data['nama']])->row_array();
				$current_user = $this->db->get_where('produk', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$data_produk = [
						'user_id' => $user,
						'nama' => $data['nama']
					];
					$this->db->where('id',$id);
					if($this->db->update('produk',$data_produk))
					{
						$data_detail = [
							'fungsi' => $data['fungsi']
						];
						$this->db->set($data_detail);
						$this->db->where('produk_id',$id);
						$this->db->update('detail_produk');
						$msg = ['status'=>'success', 'msg'=>'produk berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'produk sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('produk', ['nama'=>$data['nama']])->row_array();
				$avalable0 = $this->db->get_where('produk', ['user_id'=>$user, 'status'=>0])->row_array();
				$avalable1 = $this->db->get_where('produk', ['user_id'=>$user, 'status'=>1])->row_array();

				
				$data_produk = [
					'user_id' => $user,
					'nama' => $data['nama']
				];
				if ((empty($avalable0)) && (empty($avalable1))) {
					if(empty($exist))
					{
						if($this->db->insert('produk',$data_produk))
						{
							$last_id = $this->db->insert_id();
							$data_detail = [
								'produk_id' => $last_id,
								'fungsi' => $data['fungsi']
							];
							$this->db->insert('detail_produk',$data_detail);
							$msg = ['status'=>'success', 'msg'=>'produk berhasil disimpan'];
						}
					}else{
						$msg['msgs'][] = 'produk sudah ada';
					}
				}else{
					$msg['msgs'][] = 'Sudah ada produk yang di ajukan.';
				}
			}
		}
		if(!empty($id))
		{
			$this->db->select('a.id id, nama, fungsi');
			$this->db->from('produk a');
			$this->db->join('detail_produk b', 'b.produk_id=a.id', 'inner');
			$this->db->where('a.id', $id);
			$msg['data'] = $this->db->get()->row_array();
		}
		return $msg;
	}

	public function all($limit, $start)
	{
		$data = [];
		if (is_pimpinan()) {
			$this->db->select('a.id produk_id, a.user_id user_id, a.nama nama_produk, b.nama nama_user, fungsi, status');
			$this->db->from('produk a');
			$this->db->join('user_profile b', 'b.user_id=a.user_id', 'inner');
			$this->db->join('detail_produk c', 'c.produk_id=a.id', 'inner');
			$data['data'] = $this->db->get()->result_array();
			// print_r($data['data']);die;
		}elseif(is_cluster()){
			$this->db->select('a.id id, nama, fungsi, status');
			$this->db->from('produk a');
			$this->db->join('detail_produk b', 'b.produk_id=a.id', 'inner');
			$this->db->where('user_id', get_user()['id']);
			$data['data'] = $this->db->get()->result_array();
			if (empty($data['data'])) {
				return redirect(base_url('produk/edit'));
			}
		}
		return $data;
	}

	public function detail($id=0)
	{
		$this->db->select('a.nama, fungsi, tanggung_jawab, volume, harga, hasil_diskusi, sumber_dana, b.updated updated, status');
		if (is_pimpinan()) {
			$this->db->select('c.nama nama_user');
		}
		$this->db->from('produk a');
		$this->db->join('detail_produk b', 'b.produk_id=a.id', 'inner');
		if (is_pimpinan()) {
			$this->db->join('user_profile c', 'c.user_id=a.user_id', 'inner');
		}
		$this->db->where('a.id', $id);
		$data['data'] = $this->db->get()->row_array();
		return $data;
	}

	public function count_produk()
	{
		$pc = 0;
		if (is_pimpinan()) {
			$this->db->select('a.id produk_id');
			$this->db->from('produk a');
			$this->db->join('user_profile b', 'b.user_id=a.user_id', 'inner');
			$this->db->join('detail_produk c', 'c.produk_id=a.id', 'inner');
			$pc = $this->db->get()->num_rows();
		}elseif(is_cluster()){
			$this->db->select('a.id id');
			$this->db->from('produk a');
			$this->db->join('detail_produk b', 'b.produk_id=a.id', 'inner');
			$this->db->where('user_id', get_user()['id']);
			$pc = $this->db->get()->num_rows();
		}
		return $pc;
	}

	public function perubahan_status($id=0)
	{
		$status = $this->input->get('status');
		$data = $this->input->post();
		if (!empty($id)) {
			if (!empty($status)) {
				if ($status == 1) {
					$text = 'di diskusikan.';
				}elseif ($status == 2) {
					$text = 'di terima.';
				}elseif ($status == 3) {
					$text = 'di ditolak.';
				}
				$this->db->set(['status'=> $status]);
				$this->db->where('id', $id);
				if ($this->db->update('produk')) {

					if (!empty($data)) {
						$this->db->set($data);
						$this->db->where('produk_id', $id);
						$this->db->update('detail_produk');
					}

					return ['status' => 'success', 'msg' => 'produk berhasil diubah status menjadi ' . $text];
				} else {
					return ['status' => 'danger', 'msg' => 'produk gagal diubah status menjadi ' . $text];
				}
			}else{
				return ['status' => 'danger', 'msg' => 'maaf gagal mengubah status, status tanpa keterangan.'];
			}
		}
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('produk', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'produk berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'produk gagal dihapus'];
			}
		}
	}
}
