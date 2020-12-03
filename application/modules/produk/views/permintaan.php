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
							<th>Anggota</th>
							<th>Nama Produk</th>
							<th style="text-align: center">action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Anggota</th>
							<th>Nama Produk</th>
							<th style="text-align: center">action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php if (!empty($data['data'])) : ?>
							<?php foreach ($data['data'] as $key => $value) : ?>
								<tr>
									<td><?php echo ++$data['url']; ?></td>
									<td><?php echo $value['nama_user'] ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td align="center">
										<?php if ($value['status'] == 3): ?>
											<button class="btn btn-sm btn-danger">Ditolak</button>
										<?php elseif ($value['status'] == 2): ?>
											<button class="btn btn-sm btn-success">Diterima</button>
										<?php else: ?>
											<?php if ($value['status'] == 1): ?>
												<button style="margin-bottom: 5px" class="btn btn-sm btn-primary">Di Diskusikan</button>
												<br>
											<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-terima<?php echo $value['produk_id'] ?>"><i class="fa fa-check"></i> Terima</a>
											<div class="modal fade" id="modal-terima<?php echo $value['produk_id'] ?>">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Form hasil diskusi</h4>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<form action="<?php echo base_url('produk/perubahan_status/' . $value['produk_id'] . '?status=2') ?>" method="post">
															<div class="modal-body" align="left">
																<div class="form-group">
																	<label for="tanggung_jawab">Penanggungjawab</label>
																	<input type="text" name="tanggung_jawab" class="form-control" id="tanggung_jawab" placeholder="tanggung_jawab" value="<?php echo @$data['data']['tanggung_jawab'] ?>" onkeyup="this.value = this.value.toUpperCase()" required>
																</div>
																<div class="form-group">
																	<label for="volume">Volume</label>
																	<input type="text" name="volume" class="form-control" id="volume" placeholder="volume" value="<?php echo @$data['data']['volume'] ?>" required>
																</div>
																<div class="form-group">
																	<label for="harga">Harga</label>
																	<input type="number" name="harga" class="form-control" id="harga" placeholder="harga" value="<?php echo @$data['data']['harga'] ?>" required>
																</div>
																<div class="form-group">
																	<label for="hasil_diskusi">Hasil diskusi</label>
																	<textarea name="hasil_diskusi" class="form-control" id="hasil_diskusi" rows="3" placeholder="hasil diskusi" value="<?php echo @$data['data']['hasil_diskusi'] ?>" required><?php echo @$data['data']['hasil_diskusi'] ?></textarea>
																</div>
																<div class="form-group">
																	<label for="sumber_dana">Sumber dana</label>
																	<input type="text" name="sumber_dana" class="form-control" id="sumber_dana" placeholder="sumber_dana" value="<?php echo @$data['data']['sumber_dana'] ?>" onkeyup="this.value = this.value.toUpperCase()" required>
																</div>
															</div>
															<div class="modal-footer justify-content-between">
																<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																<button type="submit" class="btn btn-primary">Simpan</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											|
											<a href="<?php echo base_url('produk/perubahan_status/' . $value['produk_id'] . '?status=3') ?>" onclick="if(confirm('apakah anda yakin ingin menolak pengajuan produk <?php echo $value['nama_produk'] ?> dari anggota <?php echo $value['nama_user'] ?>.')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Tolak</a>
											<?php endif ?>
											<?php if ($value['status'] == 0): ?>
												<a href="<?php echo base_url('produk/perubahan_status/' . $value['produk_id'] . '?status=1') ?>" class="btn btn-sm btn-primary"><i class="fa fa-bookmark"></i> Diskusikan</a>
											<?php endif ?>
										<?php endif ?>
										<?php if ($value['status'] != 3): ?>
											<a href="<?php echo base_url('produk/detail/' . $value['produk_id']) ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> view</a>
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