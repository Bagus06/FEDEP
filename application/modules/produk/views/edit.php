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
								<?php endif ?> pengajuan produk
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form method="post">
							<div class="card-body">
								<div class="form-group">
									<label for="nama">Nama produk</label>
									<input type="text" name="nama" class="form-control" id="nama" placeholder="nama" value="<?php echo @$data['data']['nama'] ?>" required>
								</div>
								<div class="form-group">
									<label for="fungsi">Fungsi / Deskripsi produk</label>
									<input type="text" name="fungsi" class="form-control" id="fungsi" placeholder="fungsi" value="<?php echo @$data['data']['fungsi'] ?>" required>
								</div>
							</div>
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