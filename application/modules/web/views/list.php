<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php $no=1; ?>
                <?php $class = 'carousel-item active'; ?>
                <?php foreach ($image as $key => $value): ?>
                    <?php if ($no != 1): ?>
                        <?php $class = 'carousel-item'; ?>
                    <?php endif ?>
                    <div class="<?php echo $class; ?>">
                      <img src="<?php echo base_url("assets/upload_img/") ?><?php echo $value['img'] ?>" class="d-block w-100" alt="...">
                  </div>
                  <?php $no++; ?>
                <?php endforeach ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div><!-- end masonry -->
</div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Berita Terbaru <a href="#"><i class="fa fa-rss"></i></a></h4>
                    </div><!-- end blog-top -->

                    <div class="blog-list clearfix">
                        <?php foreach ($data['berita'] as $key => $value): ?>
                            <div class="blog-box row">
                                <div class="blog-meta big-meta col-md-12">
                                    <h4><a href="<?php echo base_url('web/single_content/') . '?single=' . $value['id'] ?>" title="" target="_blank"><?php echo $value['judul'] ?></a></h4>
                                    <p>
                                        <?php echo word_limiter($value['kontent'],70); ?>
                                    </p>
                                    <small class="firstsmall">
                                        <a class="bg-orange" href="#" title="">
                                            <?php foreach ($berita_cat as $key => $category_val): ?>
                                                <?php if ($category_val['id'] == $value['cat_id']): ?>
                                                    <?php echo $category_val['title'] ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </a>
                                    </small>
                                    <small><a href="#" title=""><?php echo date("j F Y | g:i a", strtotime($value['updated'])) ?></a></small></a></small>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->

                            <hr class="invis">
                        <?php endforeach ?>
                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                <hr class="invis">
                
                <?php echo $this->pagination->create_links(); ?>
                
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>