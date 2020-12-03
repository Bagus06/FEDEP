<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<section class="content">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">berita</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
						<div class="row">
							<a href="<?php echo base_url('berita') ?>" class="col-12 col-sm-4">
								<div class="info-box bg-light">
									<div class="info-box-content">
										<span class="info-box-text text-center text-muted">Post semua berita</span>
										<span class="info-box-number text-center text-muted mb-0"><?php echo @$data['semua'] ?></span>
									</div>
								</div>
							</a>
							<a href="<?php echo base_url('berita') ?>?filter=1" class="col-12 col-sm-4">
								<div class="info-box bg-light">
									<div class="info-box-content">
										<span class="info-box-text text-center text-muted">Post berita bulan ini</span>
										<span class="info-box-number text-center text-muted mb-0"><?php echo @$data['perbulan']; ?></span>
									</div>
								</div>
							</a>
							<div class="col-12 col-sm-4" align="right">
								<a href="<?php echo base_url("berita/edit") ?>" class="btn btn-block btn-outline-primary"><i class="fas fa-edit"></i> tambah berita</a>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<h4>postingan</h4>
								<?php if (!empty($data['data'])): ?>
									<?php foreach ($data['data'] as $key => $value): ?>
										<div class="post">
											<span class="username">
												<a href="<?php echo base_url('web/single_content/') . '?single=' . $value['id'] ?>" target="_blank"><?php echo $value['judul'] ?></a>
											</span><br>
											<span class="description">
												<?php foreach ($category as $key => $category_val): ?>
													<?php if ($category_val['id'] == $value['cat_id']): ?>
														<?php echo 'category content : ' . $category_val['title'] ?>
													<?php endif ?>
												<?php endforeach ?>
											</span><br>
											<span class="description">terakhir di update - <?php echo date("g:i a F j, Y ", strtotime($value['updated'])) ?></span><br>
											<p class="berita-content">
												<?php echo word_limiter($value['kontent'],120); ?>
											</p>
											<div class="text-right mt-12 mb-3">
												<a href="<?php echo base_url("berita/edit/" . $value['id']) ?>" class="btn btn-sm btn-primary">edit</a>
												<a href="<?php echo base_url("berita/delete/" . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus berita ini?')){}else{return false;};" class="btn btn-sm btn-danger">hapus</a>
											</div>
										</div>
									<?php endforeach ?>
								<?php endif ?>
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</span>
	</section>

</div>