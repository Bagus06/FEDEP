<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card card-primary">
							<div class="card-header">
								<div class="card-title">
									<?php echo $data['folder_name']['title']; ?>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<?php foreach ($data['data'] as $key => $value): ?>
										<div class="col-sm-2">
												<div class="row" style="margin: 2px">
													<a href="<?php echo base_url('galery/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus gambar <?php echo $value['img'] ?>')){}else{return false;};"><i class="fa fa-trash"></i></a>
												</div>
											<a href="<?php echo base_url("assets/upload_img/" . $value['img']) ?>" data-toggle="lightbox" data-title="<?php echo $value['img'] ?>" data-gallery="gallery">
												<img style="display: block;max-width: 100%;object-fit: cover;height: 100px;" src="<?php echo base_url("assets/upload_img/" . $value['img']) ?>" class="img-fluid mb-2" alt="white sample"/>
											</a>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
	</div>
</div>