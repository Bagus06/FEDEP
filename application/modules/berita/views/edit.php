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
								<?php endif ?> berita
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form method="post">
							<div class="card-body">
								<div class="form-group">
									<label for="judul">Judul</label>
									<input type="text" name="judul" class="form-control" id="judul" placeholder="judul" value="<?php echo @$data['data']['judul'] ?>" required>
								</div>
								<div class="form-group ">
									<label for="category">Category</label>
									<select name="cat_id" class="form-control select2" style="width: 100%;" required>
										<option value="0">None</option>
										<?php if (!empty($category)): ?>
											<?php foreach ($category as $key => $value): ?>
												<?php $selected = ''; ?>
												<?php if ($value['id'] == @$data['data']['cat_id']): ?>
													<?php $selected = 'selected'; ?>
												<?php endif ?>
												<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
								<div class="form-group">
									<label for="kontent">kontent</label>
									<textarea id="kontent" class="textarea" placeholder="Tulis kontent berita disini"
											style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="kontent" value="<?php echo @$data['data']['kontent'] ?>" required><?php echo @$data['data']['kontent'] ?></textarea>
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