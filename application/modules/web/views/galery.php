<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="page-title lb single-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<h2><i class="fa fa-gears bg-orange"></i> Galery </h2>
			</div><!-- end col -->
			<div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('web') ?>">Home</a></li>
					<li class="breadcrumb-item active">Galery</li>
				</ol>
			</div><!-- end col -->                    
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end page-title -->

<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="page-wrapper">
					<div class="blog-grid-system">
						<div class="row">
							<?php foreach ($data as $key => $value): ?>
								<div class="col-md-3">
									<div class="blog-box">
										<div class="post-media">
											<a  data-toggle="lightbox" data-title="<?php echo $value['img']; ?>" href="<?php echo base_url('assets/upload_img/' . $value['img']) ?>" title="">
												<img style="display: block;max-width: 100%;object-fit: cover;height: 150px;" src="<?php echo base_url('assets/upload_img/' . $value['img']) ?>" alt="" class="img-fluid">
												<div class="hovereffect">
													<span></span>
												</div><!-- end hover -->
											</a>
										</div>
									</div><!-- end blog-box -->
								</div><!-- end col -->
							<?php endforeach ?>
						</div><!-- end row -->
					</div><!-- end blog-grid-system -->
				</div><!-- end page-wrapper -->
				<hr class="invis3">
			</div><!-- end col -->
		</div><!-- end row -->
	</div><!-- end container -->
</section>