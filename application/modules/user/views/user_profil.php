<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<!-- Main content -->
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
							<div class="card-header">
								<h3 class="card-title">Detail Profil</h3>
							</div>
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
				<?php if (get_user()['id'] == $data['data']['user_id'] || is_admin()): ?>
					<div class="col-md-12">
						<?php if (!empty($data['msg'])): ?>
							<?php echo alert($data['status'],$data['msg']) ?>
							<?php if (!empty($data['msgs'])): ?>
								<?php foreach ($data['msgs'] as $key => $value): ?>
									<?php echo alert($data['status'], $value) ?>
								<?php endforeach ?>	
							<?php endif ?>
						<?php endif ?>
						<div class="card">
							<div class="card-header p-2">
								<ul class="nav nav-pills">
									<li class="nav-item"><a class="nav-link active" href="#edit" data-toggle="tab">Edit Profil</a></li>
								</ul>
							</div><!-- /.card-header -->
							<div class="card-body">
								<div class="tab-content">
									<div class="active tab-pane" id="edit">
										<form class="form-horizontal" method="post" enctype="multipart/form-data">
											<div class="form-group row">
												<label for="username" class="col-sm-2 col-form-label">Username</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="username" placeholder="username" name="username" value="<?php echo @$data['data']['username'] ?>" required="">
												</div>
											</div>
											<div class="form-group row">
												<label for="email" class="col-sm-2 col-form-label">Email</label>
												<div class="col-sm-10">
													<input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo @$data['data']['email'] ?>" required="">
												</div>
											</div>
											<div class="form-group row">
												<label for="password" class="col-sm-2 col-form-label">Password</label>
												<div class="col-sm-10">
													<input type="password" class="form-control" id="password" placeholder="password" name="password">
												</div>
											</div>
											<div class="form-group row">
												<label for="nama" class="col-sm-2 col-form-label">Nama</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="nama" placeholder="Name" name="nama" value="<?php echo @$data['data']['nama'] ?>" required="">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-2 col-form-label" for="photo">photo (max file size 3Mb)</label>
												<div class="custom-file col-sm-10">
													<input type="file" name="img" class="form-control custom-file-label" id="photo">
												</div>
											</div>
											<div class="form-group row">
												<label for="no_tlp" class="col-sm-2 col-form-label">No telepon</label>
												<div class="col-sm-10">
													<input type="number" class="form-control" id="no_tlp" placeholder="Name" name="no_tlp" value="<?php echo @$data['data']['no_tlp'] ?>" required="">
												</div>
											</div>
											<div class="form-group row">
												<label for="no_tlp" class="col-sm-2 col-form-label">alamat</label>
												<div class="col-sm-10">
													<textarea type="text" class="form-control" rows="3" name="alamat" placeholder="alamat" value="<?php echo @$data['data']['alamat'] ?>" required><?php echo @$data['data']['alamat'] ?></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label for="inputName2" class="col-sm-2 col-form-label">Gender</label>
												<div class="col-sm-10">
													<?php $id_gender[] = @$data['data']['gender'] ?>
													<?php if (!empty($gender)) : ?>
														<?php foreach ($gender as $key => $value) : ?>
															<?php $selected = ''; ?>
															<?php if (in_array($value['id'], $id_gender)) : ?>
																<?php $selected = 'checked'; ?>
															<?php endif ?>
															<div class="custom-control custom-radio">
																<input class="custom-control-input" type="radio" id="gender<?php echo $value['id'] ?>" name="gender" value="<?php echo $value['id'] ?>" <?php echo $selected ?> required>
																<label for="gender<?php echo $value['id'] ?>" class="custom-control-label"><?php echo $value['title'] ?></label>
															</div>
														<?php endforeach ?>
													<?php endif ?>
												</div>
											</div>
											<div class="form-group row">
												<div class="offset-sm-2 col-sm-10">
													<button type="submit" class="btn btn-danger">simpan</button>
												</div>
											</div>
										</form>
									</div>
									<!-- /.tab-pane -->
								</div>
								<!-- /.tab-content -->
							</div><!-- /.card-body -->
						</div>
						<!-- /.nav-tabs-custom -->
					</div>
				<?php endif ?>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>

</div>