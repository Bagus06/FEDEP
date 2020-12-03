<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
	public function check_login()
	{
		if (empty($this->session->userdata(str_replace('/', '_', base_url() . '_logged_in')))) {
			$curent_url = base_url($_SERVER['PATH_INFO']);
			$curent_url = urlencode($curent_url);
			redirect(base_url('login?redirect_to=' . $curent_url));
		} else {
				if (!empty($_COOKIE[base_url() . '_username'])) {
				$data['username'] = @$_COOKIE[base_url() . '_username'];
				$data['password'] = @$_COOKIE[base_url() . '_password'];
				$data['remember_me'] = @$_COOKIE[base_url() . '_remember_me'];
				$this->set_cookie($data);
				$user = $this->CI->db->query('SELECT * FROM user WHERE username = ? LIMIT 1', @$data['username'])->row_array();
				if (!empty($user)) {
					if (decrypt($data['password'], $user['password'])) {
						$url = @$_GET['redirect_to'];
						if (!empty($url)) {
							$url = urldecode($url);
						} else {
							$url = '';
						}
						$role = $this->CI->db->query('SELECT level,title FROM user_role WHERE id = ? LIMIT 1', @$user['user_role_id'])->row_array();
						if (!empty($role)) {
							$user['role'] = @$role['title'];
							$user['level'] = @$role['level'];
						} else {
							$user['role'] = 'user';
						}
						$this->CI->session->set_userdata(base_url() . '_logged_in', $user);
						$this->save_ip($user['id']);
					}
				}
			}else{

			}
		}
	}

	public function login()
	{
		$data = $this->input->post();
		$msg = [];
		$active = 0;
		if (!empty($data)) {
			$user = $this->db->query('SELECT * FROM user WHERE username = ?', $data['username'])->row_array();
			if (!empty($user)) {
			$user['profile'] = $this->db->get_where('user_profile', ['user_id'=>$user['id']])->row_array();
				$active = @$user['is_active'];
				if ($active == 1) {
					if (!decrypt($data['password'], $user['password'])) {
						$msg = ['status' => 'danger', 'msg' => 'password tidak sesuai'];
					} else {
						$url = @$_GET['redirect_to'];
						if (!empty($url)) {
							$url = urldecode($url);
						} else {
							$url = base_url('dashboard');
						}
						$tmp_role = $this->role_all();
						$role = [];
						if (!empty($tmp_role)) {
							foreach ($tmp_role as $key => $value) {
								$role[$value['id']] = $value['title'];
							}
						}

						$user_role = $this->db->get_where('user_has_role', ['user_id' => $user['id']])->result_array();
						foreach ($user_role as $key => $value) {
							$user['role'][] = ['id' => $value['user_role_id'], 'title' => $role[$value['user_role_id']]];
						}
						$this->session->set_userdata(str_replace('/', '_', base_url() . '_logged_in'), $user);
						redirect($url);
					}
				}else{
					$msg = ['status' => 'danger', 'msg' => 'akun ini belum aktif, mohon menghubungi operator untuk pengaktifan'];
				}
			} else {
				$msg = ['status' => 'danger', 'msg' => 'username tidak diketahui'];
			}
		}

		return $msg;
	}

	public function save($id = 0, $data = array())
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'user gagal disimpan'];
			if (empty($data)) {
				$data = $this->input->post();
			}

			if (!empty($id)) {
				if (is_admin() || get_user()['id'] == $id) {
					$this->db->select('id');
					$exist = $this->db->get_where('user', ['username' => $data['username']])->row_array();
					$current_user = $this->db->get_where('user', ['id' => $id])->row_array();
					if ($current_user['id'] == $exist['id'] || empty($exist)) {

						if (empty($data['password'])) {
							$pass = $current_user['password'];
						} elseif (!empty($data['password'])) {
							$pass = encrypt($data['password']);
						}

						if (!empty($_FILES['img']['name'])) {
							$format = "";
							if ($_FILES['img']['type'] == "image/png") {
								$format = ".png";
							}elseif ($_FILES['img']['type'] == "image/jpg") {
								$format = ".jpg";
							}elseif ($_FILES['img']['type'] == "image/jpeg") {
								$format = ".jpeg";
							}else {
								$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
								return $msg;
							}

							$image_name = $this->input->post('nama') . $format;

							$config['upload_path']          = FCPATH .'assets/images/user/';
							$config['allowed_types']        = '*';
							$config['max_size']             = 3048;
							$config['overwrite']			= true;
							$config['file_name'] = $image_name;

							$this->load->library('upload');
							$this->upload->initialize($config);
							$this->upload->do_upload('img');

						}else{
							$icek = $this->db->get_where('user_profile', ['user_id' => $id])->row_array();
							if ($icek['img'] == null) {
								$image_name = 'admin.jpg';
							}else{
								$image_name = $icek['img'];
							}
						}

						$this->db->where('id', $id);
						if ($this->db->update('user', [
							'password' => $pass,
							'username' => $data['username'],
							'email' => @$data['email'],
							'is_active' => @$data['is_active'],
						])) {
							$this->db->where('user_id', $id);
							if ($this->db->update('user_profile', [
								'nama' => @$data['nama'],
								'img' => @$image_name,
								'no_tlp' => $data['no_tlp'],
								'alamat' => @$data['alamat'],
								'nama_usaha' => @$data['nama_usaha'],
								'gender' => @$data['gender'],
							])) {
								$msg = ['status' => 'success', 'msg' => 'user berhasil disimpan'];
								$this->db->select('*');
								$this->db->where(['user_id' => $id]);
								$current_role = $this->db->get('user_has_role')->result_array();

								if (!empty($data['role'])) {
									$q_delete = [];
									foreach ($current_role as $key => $value) {
										if (!in_array($value['user_role_id'], $data['role'])) {
											$q_delete[] = $value['id'];
										} else {
											$role_key = array_search($value['user_role_id'], $data['role']);
											unset($data['role'][$role_key]);
										}
									}
									$q = [];
									foreach ($data['role'] as $key => $value) {
										$q[] = ['user_id' => $id, 'user_role_id' => $value];
									}
									if (!empty($q)) {
										if (!$this->db->insert_batch('user_has_role', $q)) {
											$msg['msgs'][] = 'role gagal disimpan';
										}
									}
									foreach ($q_delete as $key => $value) {
										$this->db->delete('user_has_role', ['id' => $value]);
									}
								} else {
									$this->db->delete('user_has_role', ['user_id' => $id]);
								}
							}
						}
					} else {
						$msg['msgs'][] = 'username sudah ada';
					}
				}elseif (is_operator()) {
					$this->db->select('id');
					$exist = $this->db->get_where('user', ['username' => $data['username']])->row_array();
					$current_user = $this->db->get_where('user', ['id' => $id])->row_array();
					if ($current_user['id'] == $exist['id'] || empty($exist)) {
						if (empty($data['password'])) {
							$pass = $current_user['password'];
						} elseif (!empty($data['password'])) {
							$pass = encrypt($data['password']);
						}

						if (!empty($_FILES['img']['name'])) {
							$format = "";
							if ($_FILES['img']['type'] == "image/png") {
								$format = ".png";
							}elseif ($_FILES['img']['type'] == "image/jpg") {
								$format = ".jpg";
							}elseif ($_FILES['img']['type'] == "image/jpeg") {
								$format = ".jpeg";
							}else {
								$$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
								return $msg;
							}

							$image_name = $this->input->post('nama') . $format;

							$config['upload_path']          = FCPATH .'assets/images/user/';
							$config['allowed_types']        = '*';
							$config['max_size']             = 3048;
							$config['overwrite']			= true;
							$config['file_name'] = $image_name;

							$this->load->library('upload');
							$this->upload->initialize($config);
							$this->upload->do_upload('img');

						}else{
							$icek = $this->db->get_where('user_profile', ['user_id' => $id])->row_array();
							if ($icek['img'] == null) {
								$image_name = 'admin.jpg';
							}else{
								$image_name = $icek['img'];
							}
						}

						$this->db->where('id', $id);
						if ($this->db->update('user', [
							'password' => $pass,
							'username' => $data['username'],
							'email' => @$data['email'],
							'is_active' => @$data['is_active'],
						])) {
							$this->db->where('user_id', $id);
							if ($this->db->update('user_profile', [
								'nama' => @$data['nama'],
								'img' => @$image_name,
								'no_tlp' => $data['no_tlp'],
								'alamat' => @$data['alamat'],
								'nama_usaha' => @$data['nama_usaha'],
								'gender' => @$data['gender'],
							])) {
								$msg = ['status' => 'success', 'msg' => 'user berhasil disimpan'];
								$this->db->select('*');
								$this->db->where(['user_id' => $id]);
								$current_role = $this->db->get('user_has_role')->result_array();

								if (!empty($data['role'])) {
									$q_delete = [];
									foreach ($current_role as $key => $value) {
										if (!in_array($value['user_role_id'], $data['role'])) {
											$q_delete[] = $value['id'];
										} else {
											$role_key = array_search($value['user_role_id'], $data['role']);
											unset($data['role'][$role_key]);
										}
									}
									$q = [];
									foreach ($data['role'] as $key => $value) {
										$q[] = ['user_id' => $id, 'user_role_id' => $value];
									}
									if (!empty($q)) {
										if (!$this->db->insert_batch('user_has_role', $q)) {
											$msg['msgs'][] = 'role gagal disimpan';
										}
									}
									foreach ($q_delete as $key => $value) {
										$this->db->delete('user_has_role', ['id' => $value]);
									}
								} else {
									$this->db->delete('user_has_role', ['user_id' => $id]);
								}
							}
						}
					} else {
						$msg['msgs'][] = 'username sudah ada';
					}
				}else{
					$msg['msgs'][] = 'anda tidak memiliki akses untuk mengubah';
				}
			} else {
				if (is_admin() || is_operator()) {
					$this->db->select('id');
					$exist = $this->db->get_where('user', ['username' => $data['username']])->row_array();
					if (empty($exist)) {

						if (!empty($_FILES['img']['name'])) {
							$format = "";
							if ($_FILES['img']['type'] == "image/png") {
								$format = ".png";
							}elseif ($_FILES['img']['type'] == "image/jpg") {
								$format = ".jpg";
							}elseif ($_FILES['img']['type'] == "image/jpeg") {
								$format = ".jpeg";
							}else {
								$$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
								return $msg;
							}

							$image_name = $this->input->post('nama') . $format;

							$config['upload_path']          = FCPATH .'assets/images/user/';
							$config['allowed_types']        = '*';
							$config['max_size']             = 3048;
							$config['overwrite']			= true;
							$config['file_name'] = $image_name;

							$this->load->library('upload');
							$this->upload->initialize($config);
							$this->upload->do_upload('img');

						}else{
							$icek = $this->db->get_where('user_profile', ['user_id' => $id])->row_array();
							if ($icek['img'] == null) {
								$image_name = 'admin.jpg';
							}else{
								$image_name = $icek['img'];
							}
						}

						if ($this->db->insert('user', [
							'password' => encrypt($data['password']),
							'username' => $data['username'],
							'email' => @$data['email'],
						])) {
							$msg = ['status' => 'success', 'msg' => 'user berhasil disimpan'];
							$last_id = $this->db->insert_id();
							$msg['user_id'] = $last_id;
							$this->db->insert('user_profile', [
								'user_id' => $last_id,
								'nama' => $data['nama'],
								'img' => $image_name,
								'no_tlp' => $data['no_tlp'],
								'alamat' => $data['alamat'],
								'nama_usaha' => $data['nama_usaha'],
								'gender' => $data['gender'],
							]);

							$q = [];
							foreach ($data['role'] as $key => $value) {
								$q[] = ['user_id' => $last_id, 'user_role_id' => $value];
							}
							if (!$this->db->insert_batch('user_has_role', $q)) {
								$msg['msgs'][] = 'role gagal disimpan';
							}
						}
					} else {
						$msg['msgs'][] = 'username sudah ada';
					}
				}else{
					$msg['msgs'][] = 'anda tidak memiliki akses untuk menambah user';
				}
			}
		}
		if (!empty($id)) {
			$this->db->where(['user.id' => $id]);
			$msg['user'] = $this->db->get('user')->row_array();
			$msg['user_profile'] = $this->db->get_where('user_profile', ['user_id' => $id])->row_array();

			$this->db->select('user_role_id');
			$tmp_user_role = $this->db->get_where('user_has_role', ['user_id' => $id])->result_array();
			foreach ($tmp_user_role as $key => $value) {
				$msg['user_role'][] = $value['user_role_id'];
			}

		}
		return $msg;
	}

	public function role_save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'user gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('user_role', ['title' => $data['title']])->row_array();
				$current_user = $this->db->get_where('user_role', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('user_role', $data)) {
						$msg = ['status' => 'success', 'msg' => 'user role berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'title sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('user_role', ['title' => $data['title']])->row_array();
				if (empty($exist)) {
					if ($this->db->insert('user_role', $data)) {
						$msg = ['status' => 'success', 'msg' => 'user role berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'title sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('user_role', ['id' => $id])->row_array();
		}
		return $msg;
	}

	public function all($limit, $start, $id = 0)
	{
		if (is_admin() || is_operator()) {
			$msg = [];
			$filter = $this->input->get('filter');

			$level = role_by_name('cluster');
			$role_level = $this->db->get_where('user_role', ['level' => $level])->row_array();
			if (is_operator()) {
				$filter = $role_level['id'];
			}
			
			if (!empty($filter)) {
				$tmp_user_role = $this->db->get_where('user_has_role', ['user_role_id' => $filter])->result_array();
				foreach ($tmp_user_role as $key => $value) {
					$msg['user_role'][] = $value;
				}
				$this->db->select('*');
				$this->db->from('user_has_role a'); 
				$this->db->join('user b', 'a.user_id=b.id', 'inner');
				$this->db->where('a.user_role_id',$filter);
				$this->db->limit($limit, $start);
				$msg['data'] = $this->db->get()->result_array();
			}else{
				$tmp_user_role = $this->db->get('user_has_role')->result_array();
				foreach ($tmp_user_role as $key => $value) {
					$msg['user_role'][] = $value;
				}
				$this->db->select('*');
				$this->db->from('user a');
				$this->db->limit($limit, $start);
				$msg['data'] = $this->db->get()->result_array();
			}
			// echo "<pre>";
			// 	print_r($msg['data']);die;
			// echo "</pre>";
			return $msg;
		}
	}

	public function count_user()
	{
		if (!empty($this->input->get('filter'))) {
			return $this->db->get_where('user_has_role', ['user_role_id'=>$this->input->get('filter')])->num_rows();
		}else{
			return $this->db->get('user')->num_rows();
		}
	}

	public function user_profil($id=0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'user gagal disimpan'];
			if (empty($data)) {
				$data = $this->input->post();
			}

			if (!empty($id)) {
				if (!empty($_FILES['img']['name'])) {
					$format = "";
					if ($_FILES['img']['type'] == "image/png") {
						$format = ".png";
					}elseif ($_FILES['img']['type'] == "image/jpg") {
						$format = ".jpg";
					}elseif ($_FILES['img']['type'] == "image/jpeg") {
						$format = ".jpeg";
					}else {
						$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
						return $msg;
					}

					$image_name = $this->input->post('nama') . $format;

					$config['upload_path']          = FCPATH .'assets/images/user/';
					$config['allowed_types']        = '*';
					$config['max_size']             = 3048;
					$config['overwrite']			= true;
					$config['file_name'] = $image_name;

					$this->load->library('upload');
					$this->upload->initialize($config);
					$this->upload->do_upload('img');

				}else{
					$icek = $this->db->get_where('user_profile', ['user_id' => $id])->row_array();
					if ($icek['img'] == null) {
						$image_name = 'admin.jpg';
					}else{
						$image_name = $icek['img'];
					}
				}
				if (get_user()['id'] == $id || is_admin()) {
					$this->db->select('id');
					$exist = $this->db->get_where('user', ['username' => $data['username']])->row_array();
					$current_user = $this->db->get_where('user', ['id' => $id])->row_array();
					// print_r($image_name);die;
					if ($current_user['id'] == $exist['id'] || empty($exist)) {
						if (empty($data['password'])) {
							$pass = $current_user['password'];
						} elseif (!empty($data['password'])) {
							$pass = encrypt($data['password']);
						}
						$this->db->where('id', $id);
						if ($this->db->update('user', [
							'password' => $pass,
							'username' => $data['username'],
							'email' => @$data['email'],
						])) {
							$this->db->where('user_id', $id);
							if ($this->db->update('user_profile', [
								'nama' => @$data['nama'],
								'img' => @$image_name,
								'no_tlp' => $data['no_tlp'],
								'alamat' => @$data['alamat'],
								'nama_usaha' => @$exist['nama_usaha'],
								'gender' => @$data['gender'],
							])) {
								$msg = ['status' => 'success', 'msg' => 'user berhasil disimpan'];
							}
						}
					} else {
						$msg['msgs'][] = 'username sudah ada';
					}
				}else{
					$msg['msgs'][] = 'anda tidak memiliki akses untuk mengubah';
				}
			}
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

		// print_r($msg['role']);die;
		return $msg;
	}

	public function profile_cluster($id=0)
	{
		$msg = [];
		$this->db->select('*');
		$this->db->from('question a'); 
		$this->db->join('responses b', 'b.question_id=a.id', 'inner');
		$this->db->where('b.responden_id',$id);
		$msg['responses'] = $this->db->get()->result_array();
		$msg['profile'] = $this->db->get_where('user_profile', ['user_id'=>$id])->row_array();
		
		return $msg;
	}

	public function filter($id=0)
	{
		$exist = $this->db->get_where('user', ['username' => $data['username']])->row_array();
	}

	public function role_all()
	{
		return $this->db->get('user_role')->result_array();
	}

	public function role_delete($id)
	{
		if (!empty($id)) {
			if ($this->db->delete('user_role', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$bind_name = $this->db->get_where('user_profile',['user_id'=>$id])->row_array();
			$path = "./assets/images/user/" . $bind_name['img'];

			$bind_file = $this->db->get_where('responses', ['responden_id'=>$id])->result_array();
			if (!empty($bind_file)) {
				foreach ($bind_file as $key => $value) {
					if ($value['img'] != null) {
						$path = "./assets/images/archiv/" . $value['img'];
						unlink($path);
					}
				}
			}

			if (get_user()['id'] != $id|| valid_role('admin', $id) == false) {
				if ($bind_name['img'] == 'admin.jpg') {
					if ($this->db->delete('user', ['id' => $id])) {
						return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
					}else {
						return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
					}
				}else{
					if (unlink($path)) {
						if ($this->db->delete('user', ['id' => $id])) {
							return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
						} 
					}else {
						return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
					}
				}
			}else{
				return ['status' => 'danger', 'msg' => 'admin atau user yang login tidak dapat dihapus'];
			}
		}
	}
}
