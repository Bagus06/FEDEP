<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Catatan dari pimpinan</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<p>
					<?php echo $data['pesan']['pesan']; ?>
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Persentase data anda (<?php echo $data['progress'] ?>%)</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="progress mb-1">
					<div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0"
					aria-valuemax="100" style="width: <?php echo $data['progress'] . '%' ?>">
						<span class="sr-only">20% Complete</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<!-- Profile Image -->
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<a data-toggle="modal" data-target="#modal-profle" href="#">
								<img class="profile-user-img img-fluid img-circle"
								src="<?php echo base_url('assets/images/user/' . get_profile(@$data['data']['user_id'])) ?>"
								alt="User profile picture">
							</a>
							<div class="modal fade" id="modal-profle">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<img style=" max-width: 100%; max-height: 100%;" src='<?php echo base_url('assets/images/user/' . get_profile(@$data['data']['user_id'])) ?>'>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
						</div>

						<h3 class="profile-username text-center"><?php echo @$data['data']['nama'] ?></h3>

						<p class="text-muted text-center">
							<?php foreach ($data['role'] as $key => $value): ?>
								<?php echo $value['title']; ?> |
							<?php endforeach ?>
						</p>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Detail Profile</b>
							</li>
						</ul>
						<!-- /.card-header -->
						<div class="card-body">
							<strong><i class="fas fa-user mr-1"></i> Username</strong>

							<p class="text-muted">
								<?php echo $data['data']['username'] ?>
							</p>

							<hr>

							<strong><i class="fas fa-envelope mr-1"></i> Email</strong>

							<p class="text-muted">
								<?php echo $data['data']['email'] ?>
							</p>

							<hr>

							<strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

							<p class="text-muted">
								<?php echo $data['data']['alamat'] ?>
							</p>

							<hr>

							<strong><i class="fas fa-phone-alt mr-1"></i> Telepon</strong>

							<p class="text-muted">
								<?php echo $data['data']['no_tlp'] ?>
							</p>

							<hr>

							<strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>

							<p class="text-muted">
								<?php if ($data['data']['gender'] == 0): ?>
									<?php echo 'perempuan'; ?>
									<?php elseif ($data['data']['gender'] == 1): ?>
										<?php echo 'Laki-laki'; ?>
										<?php else: ?>
											<?php echo 'waria'; ?>
										<?php endif ?>
									</p>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>

	</div>