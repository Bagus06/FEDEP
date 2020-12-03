<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-4">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
				<?php echo alert($data['status'], $value) ?>
			<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<?php if (empty($data['data'])): ?>
									tambah
									<?php else: ?>
										ubah
										<?php endif ?> berita cat
									</h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form method="post">
									<div class="card-body">
										<div class="form-group">
											<label for="title">title</label>
											<input type="text" name="title" class="form-control" id="title" placeholder="title" value="<?php echo @$data['data']['title'] ?>" required>
										</div>
										<div class="form-group">
											<label for="deskripsi">deskripsi</label>
											<input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="deskripsi" value="<?php echo @$data['data']['deskripsi'] ?>">
										</div>
									</div>
									<!-- /.card-body -->

									<div class="card-footer" align="right">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>