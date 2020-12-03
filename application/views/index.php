<?php defined('BASEPATH') OR exit('No direct script access allowed');


if ($this->uri->rsegments[1] != 'web' || empty($this->uri->rsegments[1])) {
	$this->user_model->check_login();
	$this->load->view('admin-lte/index');
}elseif ($this->uri->rsegments[1] == 'web') {
	$this->load->view('web/index');
}