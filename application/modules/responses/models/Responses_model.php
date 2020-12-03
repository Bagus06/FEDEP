<?php defined('BASEPATH') or exit('No direct script access allowed');

class Responses_model extends CI_model
{
	public function all()
	{
		$id = get_user()['id'];
		$this->db->select('*');
		$this->db->from('question a'); 
		$this->db->join('responses b', 'b.question_id=a.id', 'inner');
		$this->db->where('b.responden_id',$id);
		$this->db->order_by('number ASC');
		return $this->db->get()->result_array();
	}
	
	public function save($id=0)
	{
		$msg = [];
		$time = time();
		if (!empty($this->input->post())) {
			$msg = ['status'=>'danger', 'msg'=>'responses gagal disimpan, pastikan form ada yang terisi atau jika data tidak ada anda bisa click button batal. pastikan anda menginputkan file sesuai peraturan'];
			$id = get_user()['id'];

			$question_id = $this->input->post('question_id');
			$isian = $this->input->post('isian');
			$ceklist = $this->input->post('ceklist');
			$ket = $this->input->post('ket');
			$img = @$_FILES['img']['name'];

			$data = array();

			if (is_cluster()) {
				$index = 0;
				foreach($question_id as $dataq){
					if (!empty($img[$index])) {
						$img[$index] = $time . $img[$index];
					}
					array_push($data, array(
						'responden_id'=>$id,
						'question_id'=>$dataq,
						'isian'=>$isian[$index],
						'ceklist'=>$ceklist[$index],
						'ket'=>$ket[$index],
						'img'=>str_replace(" ","_",$img[$index]),
					));

					$index++;
				}

				$exits = $this->db->get_where('responses', ['responden_id'=>$id])->row_array();
				if (empty($exits)) {
					if(!empty($_FILES['img']['name']) && count(array_filter($_FILES['img']['name'])) > 0){
						$errorUploadType = $statusMsg = '';
						$filesCount = count($_FILES['img']['name']); 
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['file']['name']     = $_FILES['img']['name'][$i]; 
							$_FILES['file']['type']     = $_FILES['img']['type'][$i]; 
							$_FILES['file']['tmp_name'] = $_FILES['img']['tmp_name'][$i]; 
							$_FILES['file']['error']     = $_FILES['img']['error'][$i]; 
							$_FILES['file']['size']     = $_FILES['img']['size'][$i]; 

							if (!empty($_FILES['file']['name']) && !empty($_FILES['file']['type']) && !empty($_FILES['file']['tmp_name']) && $_FILES['file']['error'] == 0 && !empty($_FILES['file']['size'])) {

								$config['upload_path']          = FCPATH .'/assets/images/archiv/';
								$config['allowed_types']        = 'jpg|jpeg|png|pdf';
								$config['max_size']             = 5048;
								$config['file_name'] 			= $time . $_FILES['file']['name'];
								$config['overwrite']			= true;

								$this->load->library('upload');
								$this->upload->initialize($config);
								if($this->upload->do_upload('file')){

								}else{
									$msg['msgs'][] = 'updating file responses gagal. file terlalu besar atau format file tidak di dukung';
									$msg['data'] = $this->db->get('question')->result_array();
									return $msg;
								}
							}
						}
					}
					if ($this->db->insert_batch('responses', $data)) {
						$msg = ['status'=>'success', 'msg'=>'responses berhasil disimpan'];
					}
				}else{
					$bind_file = $this->db->get_where('responses', ['responden_id'=>$id])->result_array();
					if ($this->db->delete('responses', ['responden_id'=>$id])) {
						if (!empty($bind_file)) {
							foreach ($bind_file as $key => $value) {
								if ($value['img'] != null) {
									$path = "./assets/images/archiv/" . $value['img'];
									unlink($path);
								}
							}
						}

						if(!empty($_FILES['img']['name']) && count(array_filter($_FILES['img']['name'])) > 0){
							$errorUploadType = $statusMsg = '';
							$filesCount = count($_FILES['img']['name']); 
							for($i = 0; $i < $filesCount; $i++){
								$_FILES['file']['name']     = $_FILES['img']['name'][$i]; 
								$_FILES['file']['type']     = $_FILES['img']['type'][$i]; 
								$_FILES['file']['tmp_name'] = $_FILES['img']['tmp_name'][$i]; 
								$_FILES['file']['error']     = $_FILES['img']['error'][$i]; 
								$_FILES['file']['size']     = $_FILES['img']['size'][$i]; 

								if (!empty($_FILES['file']['name']) && !empty($_FILES['file']['type']) && !empty($_FILES['file']['tmp_name']) && $_FILES['file']['error'] == 0 && !empty($_FILES['file']['size'])) {

									$config['upload_path']          = FCPATH .'/assets/images/archiv/';
									$config['allowed_types']        = 'jpg|jpeg|png|pdf';
									$config['max_size']             = 5048;
									$config['file_name'] 			= $time . $_FILES['file']['name'];
									$config['overwrite']			= true;

									$this->load->library('upload');
									$this->upload->initialize($config);
									if($this->upload->do_upload('file')){
										if ($this->db->insert_batch('responses', $data)) {
											$msg = ['status'=>'success', 'msg'=>'updating responses berhasil'];
										}
									}else{
										$msg['msgs'][] = 'updating file responses gagal. file terlalu besar atau format file tidak di dukung';
										$msg['data'] = $this->db->get('question')->result_array();
										return $msg;
									}
								}
							}
						}
					}else{
						$msg['msgs'][] = 'updating responses gagal';
					}

				}
			}else{
				$msg['msgs'][] = 'pengisian form quesioner hanya dilakukan oleh cluster.';
			}

		}
		$msg['data'] = $this->db->get('question')->result_array();

		return $msg;
	}
}
