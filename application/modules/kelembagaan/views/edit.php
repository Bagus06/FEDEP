<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-12">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<!-- Main content -->
	<?php 
		$readonly = '';
		if (empty($data['data']['user_id'])) {
			$readonly = '';
		}elseif ($data['data']['user_id'] != get_user()['id']) {
			$readonly = 'readonly';
		}
	 ?>
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
									<?php if (is_cluster()): ?>
										ubah
									<?php endif ?>
								<?php endif ?> profil kelembagaan
								<?php if (is_pimpinan()): ?>
									<?php echo get_profile_all($data['data']['user_id'])['nama']; ?>
								<?php endif ?>
							</h3>
						</div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<label for="visi">Visi</label>
									<input type="text" name="visi" class="form-control" id="visi" placeholder="visi" value="<?php echo @$data['data']['visi'] ?>" required <?php echo $readonly; ?>>
								</div>
								<div class="form-group">
									<label for="misi">Misi</label>
									<input type="text" name="misi" class="form-control" id="misi" placeholder="misi" value="<?php echo @$data['data']['misi'] ?>" required <?php echo $readonly; ?>>
								</div>
								<div class="form-group">
									<label for="tujuan">Tujuan</label>
									<input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="tujuan" value="<?php echo @$data['data']['tujuan'] ?>" required <?php echo $readonly; ?>>
								</div>
								<div class="form-group">
									<label class="col-form-label" for="photo">photo (max file size 3Mb)</label>
									<?php if (!empty($data['data']['sk'])): ?>
										<a href="<?php echo base_url("assets/images/sk/" . $data['data']['sk']) ?>" data-toggle="lightbox" data-title="<?php echo $data['data']['sk'] ?>" data-gallery="gallery" target="blank_">
											<img style="display: block;max-width: 100%;object-fit: cover;height: 150px; width: 110px;" src="<?php echo base_url("assets/images/sk/" . $data['data']['sk']) ?>" class="img-fluid mb-2" alt="white sample"/>
											<?php echo $data['data']['sk'] ?>
										</a>
									<?php endif ?>
									<?php if (($data['data']['user_id'] == get_user()['id']) || empty($data['data']['user_id'])): ?>
										<div class="custom-file">
											<input type="file" name="sk" class="form-control custom-file-label" id="photo">
										</div>
									<?php endif ?>
								</div>
								<div class="form-group">
									<label for="anggaran">Anggaran</label>
									<input type="number" name="anggaran" class="form-control" id="anggaran" placeholder="anggaran" value="<?php echo @$data['data']['anggaran'] ?>" required <?php echo $readonly; ?>>
								</div>
							</div>
							<?php if (($data['data']['user_id'] == get_user()['id']) || empty($data['data']['user_id'])): ?>
								<div class="card-footer" align="right">
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							<?php endif ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>