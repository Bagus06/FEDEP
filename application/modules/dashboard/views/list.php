<?php if (is_cluster()): ?>
	<?php $this->load->view('cluster'); ?>
<?php elseif(is_operator()): ?>
	<?php $this->load->view('operator'); ?>
<?php elseif(is_pimpinan()): ?>
	<?php $this->load->view('pimpinan'); ?>
<?php endif ?>