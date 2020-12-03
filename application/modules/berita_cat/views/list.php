<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
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
	<div class="col-md-8">
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-table"></i>
				Berita category
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>title</th>
								<th>deskripsi</th>
								<th>created</th>
								<th style="text-align: center">action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
								<th>title</th>
								<th>deskripsi</th>
								<th>created</th>
								<th style="text-align: center">action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php $i = 1; ?>
							<?php if (!empty($data)) : ?>
								<?php foreach ($data as $key => $value) : ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $value['title'] ?></td>
										<td><?php echo $value['deskripsi'] ?></td>
										<td><?php echo $value['created'] ?></td>
										<td align="center">
											<a href="<?php echo base_url('berita_cat/edit/' . $value['id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
											| 
											<a href="<?php echo base_url('berita_cat/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus category <?php echo $value['title'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
										</td>
									</tr>
									<?php $i++; ?>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
		</div>
	</div>
</div>