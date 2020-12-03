<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">

	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Data User
		</div>
		<div class="card-body">
			<?php if (!is_operator()): ?>
				<div style="padding-bottom: 20px; padding-left: 20px">
					<p>Filter</p>
					<div class="row">
						<a style="margin-right: 5px" href="<?php echo base_url('user'); ?>" class="btn btn-sm btn-info">semua</a>
						<?php foreach ($role as $key => $for_filter_role): ?>
							<a style="margin-right: 5px" href="<?php echo base_url('user'); ?>?filter=<?php echo $for_filter_role['id'] ?>" class="btn btn-sm btn-info"><?php echo $for_filter_role['title'] ?></a>
						<?php endforeach ?>
					</div>
				</div>
			<?php endif ?>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>username</th>
							<th>email</th>
							<th>jabatan</th>
							<th style="text-align: center">action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>username</th>
							<th>email</th>
							<th>jabatan</th>
							<th style="text-align: center">action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php if (!empty($data['data'])) : ?>
							<?php foreach ($data['data'] as $key => $value) : ?>
								<tr>
									<td><?php echo ++$data['url']; ?></td>
									<td><?php echo $value['username'] ?></td>
									<td><?php echo $value['email'] ?></td>
									<td>
										<?php $n = 1; ?>
										<?php foreach ($data['user_role'] as $key => $val_has_role): ?>
											<?php if ($val_has_role['user_id'] == $value['id']): ?>
												<?php foreach ($role as $key => $val_role): ?>
													<?php if ($val_role['id'] == $val_has_role['user_role_id']): ?>
														<?php echo $n ?>.
														<?php echo $val_role['title'] ?>
														<br>
														<?php $n++; ?>
													<?php endif ?>
												<?php endforeach ?>
											<?php endif ?>
										<?php endforeach ?>
									</td>
									<td align="center">
										<a href="<?php echo base_url('user/edit/' . $value['id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
										|
										<a href="<?php echo base_url('user/user_profil/' . $value['id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-id-badge"></i> detail</a>
										|
										<a href="<?php echo base_url('user/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['username'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
									</td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
		<div class="card-footer small text-muted">by : FEDEP</div>
	</div>
</div>