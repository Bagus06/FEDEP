<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Pengajuan Produk Baru
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Fungsi / Deskripsi</th>
							<th>Status</th>
							<th style="text-align: center">action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Fungsi / Deskripsi</th>
							<th>Status</th>
							<th style="text-align: center">action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php if (!empty($data['data'])) : ?>
							<?php foreach ($data['data'] as $key => $value) : ?>
								<tr>
									<td><?php echo ++$data['url']; ?></td>
									<td><?php echo $value['nama'] ?></td>
									<td><?php echo $value['fungsi'] ?></td>
									<td>
										<?php if ($value['status'] == 0): ?>
											<button class="btn btn-block btn-outline-warning btn-sm">Belum di diskusikan</button>
										<?php elseif ($value['status'] == 1): ?>
											<button class="btn btn-block btn-outline-info btn-sm">Sedang Didiskusikan</button>
										<?php elseif ($value['status'] == 2): ?>
											<button class="btn btn-block btn-outline-success btn-sm">Pengajuan diterima</button>
										<?php elseif ($value['status'] == 3): ?>
											<button class="btn btn-block btn-outline-danger btn-sm">Pengajuan ditolak</button>
										<?php endif ?>
									</td>
									<td align="center">
										<?php if ($value['status'] == 0): ?>
											<a href="<?php echo base_url('produk/edit/') . $value['id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Edit</a>
											|
											<a href="<?php echo base_url('produk/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus pengajuan produk <?php echo $value['nama'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
											|
										<?php elseif($value['status'] == 3): ?>
											<a href="<?php echo base_url('produk/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus pengajuan produk <?php echo $value['nama'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
										<?php endif ?>
										<?php if ($value['status'] != 3): ?>
											<a href="<?php echo base_url('produk/detail/' . $value['id']) ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> view</a>
										<?php endif ?>
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