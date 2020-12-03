<?php defined('BASEPATH') or exit('No direct script access allowed');

class Question_model extends CI_model
{	
	public function save($id = 0, $data = array())
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'question gagal disimpan'];
			$data = $this->input->post();
			// print_r($data);die;

			// statment sub soal
			if (@$data['sub_ceklist'] != 'on') {
				@$data['sub_ceklist'] = 0;
			}elseif (@$data['sub_ceklist'] == 'on') {
				@$data['sub_ceklist'] = 1;
				if (empty(@$data['sub_title'])) {
					$msg['msgs'][] = 'jika sub soal di centang, maka anda harus menuliskan sub soalnya!';
					return $msg;
				}
			}

			if (!empty(@$data['sub_title'])) {
				if (@$data['sub_ceklist'] == 0) {
					$msg['msgs'][] = 'jika sub soal di isi, maka ceklist sub soal harus di centang';
					return $msg;
				}
			}

			// statment jawaban ceklist
			if (@$data['jawaban_ceklist'] == 'on') {
				if (empty(@$data['isi_ceklist'])) {
					$msg['msgs'][] = 'jika jawaban ceklist di centang, maka anda harus menuliskan menu ceklistnya!';
					return $msg;
				}
				@$data['type_jawaban'] = 2; 
			}

			if (!empty(@$data['isi_ceklist'])) {
				if (@$data['jawaban_ceklist'] != 'on') {
					$msg['msgs'][] = 'jika jawaban berupa ceklist, centang ceklis pada jawaban ceklist!';
					return $msg;
				}
			}

			if (@$data['type_jawaban'] == 0) {
				if (@$data['jawaban_ceklist'] != 'on') {
					$msg['msgs'][] = 'Jika type jawaban tidak berupa ceklist, maka anda harus memilih type jawaban.' . $data['type_jawaban'];
					return $msg;
				}
			}

			$data = [
				'score'					=>	$data['score'],
				'number'				=>	$data['number'],
				'type_jawaban'			=>	$data['type_jawaban'],
				'title'					=>	$data['soal'],
				'ceklist'				=>	@$data['isi_ceklist'],
				'sub_question'			=>	@$data['sub_ceklist'],
				'question_title_sub'	=>	@$data['sub_title'],
			];

			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('question', ['number'=>$data['number']])->row_array();
				$current_user = $this->db->get_where('question', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('question',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'question berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'question sudah ada';
				}
			}else{
				$this->db->select('id');
				if (empty($data['question_title_sub'])) {
					$exist = $this->db->get_where('question', ['title'=>$data['title']])->row_array();
				}
				$no_exist = $this->db->get_where('question', ['number'=>$data['number']])->row_array();
				if(empty($exist))
				{
					if (empty($no_exist)) {
						if($this->db->insert('question',$data))
						{
							$msg = ['status'=>'success', 'msg'=>'question berhasil disimpan'];
						}
					}else{
						$msg['msgs'][] = 'nomor question sudah ada';
					}
				}else{
					$msg['msgs'][] = 'question sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$msg['data'] = $this->db->get_where('question',['id'=>$id])->row_array();
		}
		return $msg;
	}

	public function all($limit, $start)
	{
		return $this->db->get('question', $limit, $start)->result_array();
	}

	public function count_question()
	{
		return $this->db->get('question')->num_rows();
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('question', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'question berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'question gagal dihapus'];
			}
		}
	}

	public function type_jawaban()
	{
		$msg = [];
		$msg = [
			0 => 'none',
			1 => 'isian',
			3 => 'files'
		];
		return $msg;
	}
}
