<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_model
{
	public function cluster($id=0)
	{
		$msg = [];

		$id = get_user()['id'];

		$bind_question = $this->db->get('question')->num_rows();
		$bind_responses = $this->db->get_where('responses', ['responden_id'=>$id])->result_array();

		$rest = 0;
		foreach ($bind_responses as $key => $value) {
			if (!empty($value['isian']) || !empty($value['img']) || !empty($value['ceklist'])) {
				$rest++;
			}
		}

		// print_r($rest);die;

		$msg['progress'] = 0;
		if (!empty($bind_question)) {
			$msg['progress'] = round($rest/$bind_question * 100,2);
		}

		$this->db->select('*');
		$this->db->from('user a'); 
		$this->db->join('user_profile b', 'b.user_id=a.id', 'inner');
		$this->db->where('a.id',$id);
		$msg['data'] = $this->db->get()->row_array();

		$this->db->select('*');
		$this->db->from('user_role a'); 
		$this->db->join('user_has_role b', 'b.user_role_id=a.id', 'inner');
		$this->db->where('b.user_id',$id);
		$msg['role'] =  $this->db->get()->result_array();

		$msg['pesan'] = $this->db->get_where('cluster_pesan', ['user_id'=>$id])->row_array();

		// print_r($msg['role']);die;
		return $msg;
	}

	public function operator($limit,$start)
	{
		$msg = [];
		$filter = role_by_name('cluster');
		$this->db->select('*');
		$this->db->from('user_profile a'); 
		$this->db->join('user b', 'a.user_id=b.id', 'inner');
		$this->db->join('user_has_role c', 'c.user_id=b.id', 'inner');
		$this->db->where('c.user_role_id',$filter);
		$this->db->limit($limit, $start);
		$msg['data'] = $this->db->get()->result_array();

		foreach ($msg['data'] as $key => $data) {
			$ida = $data['user_id'];
			$bind_question = $this->db->get('question')->num_rows();
			$bind_responses = $this->db->get_where('responses', ['responden_id'=>$ida])->result_array();

			$rest = 0;
			foreach ($bind_responses as $key => $value) {
				if (!empty($value['isian']) || !empty($value['img']) || !empty($value['ceklist'])) {
					$rest++;
				}
			}

			$msg['progress'][$ida] = 0;
			if (!empty($bind_question)) {
				$msg['progress'][$ida] = round($rest/$bind_question * 100,2);
			}
		}
		
		return $msg;
	}

	public function pimpinan($limit,$start)
	{
		if (!empty($this->input->post())) {
			$data = $this->input->post();
			$id = $data['user_id'];
			$exits = $this->db->get_where('cluster_pesan', ['user_id'=>$id])->row_array();
			if (!empty($exits)) {
				$this->db->where('user_id',$id);
				$this->db->update('cluster_pesan',$data);
			}else{
				$this->db->insert('cluster_pesan',$data);
			}
		}

		$msg = [];
		$filter = role_by_name('cluster');
		$this->db->select('*');
		$this->db->from('user_profile a'); 
		$this->db->join('user b', 'a.user_id=b.id', 'inner');
		$this->db->join('user_has_role c', 'c.user_id=b.id', 'inner');
		$this->db->where('c.user_role_id',$filter);
		$this->db->limit($limit, $start);
		$msg['data'] = $this->db->get()->result_array();


		foreach ($msg['data'] as $key => $data) {
			$ida = $data['user_id'];
			$bind_question = $this->db->get('question')->num_rows();
			$bind_responses = $this->db->get_where('responses', ['responden_id'=>$ida])->result_array();
			$bind_pesan = $this->db->get_where('cluster_pesan', ['user_id'=>$ida])->result_array();

			$rest = 0;
			foreach ($bind_responses as $key => $value) {
				if (!empty($value['isian']) || !empty($value['img']) || !empty($value['ceklist'])) {
					$rest++;
				}
			}

			$msg['progress'][$ida] = 0;
			if (!empty($bind_question)) {
				$msg['progress'][$ida] = round($rest/$bind_question * 100,2);
			}

			if (!empty($bind_pesan)) {
				foreach ($bind_pesan as $key => $value) {
					if ($ida == $value['user_id']) {
						$msg['pesan'][$ida] = $value['pesan'];
					}
				}
			}
		}

		// print_r($msg['pesan']);
		// die;
		return $msg;
	}

	public function pesan_update()
	{
		$data = $this->input->post();
		if (!empty($this->input->post())) {
			$id = $data['user_id'];
			$exits = $this->db->get_where('cluster_pesan', ['user_id'=>$id])->row_array();
			if (!empty($exits)) {
				$this->db->where('user_id',$id);
				$this->db->update('cluster_pesan',$data);
			}else{
				$this->db->insert('cluster_pesan',$data);
			}
		}
		return;
	}

	public function count_cluster()
	{
		$filter = role_by_name('cluster');
		return $this->db->get_where('user_has_role', ['user_role_id'=>$filter])->num_rows();
	}
}