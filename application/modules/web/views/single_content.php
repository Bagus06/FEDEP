<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('web'); ?>"><?php echo $this->uri->rsegments[1]; ?></a></li>
                            <li class="breadcrumb-item"><a href="#"><?php echo $this->uri->rsegments[2]; ?></a></li>
                            <li class="breadcrumb-item active"><?php echo $data['judul'] ?></li>
                        </ol>

                        <span class="color-orange">
                            <?php foreach ($berita_cat as $key => $category_val): ?>
                                <?php if ($category_val['id'] == $data['cat_id']): ?>
                                    <a href="<?php echo base_url('web/') . '?berita=' . $category_val['id'] ?>" title="">
                                        <?php echo $category_val['title'] ?>
                                    </a>
                                <?php endif ?>
                            <?php endforeach ?>
                        </span>

                        <h3><?php echo $data['judul'] ?></h3>

                        <div class="blog-meta big-meta">
                            <small><a href="tech-single.html" title="">
                                <?php echo date("j F Y | g:i a", strtotime($data['updated'])) ?>
                            </a></small>
                            <small><a href="tech-author.html" title="">by Jessica</a></small>
                        </div><!-- end meta -->
                    </div><!-- end title -->

                    <div class="blog-content">  
                        <div class="pp">
                            <p><?php echo $data['kontent'] ?></p>
                        </div><!-- end pp -->
                    </div><!-- end content -->

                    <div class="blog-title-area">
                        <div class="tag-cloud-single">
                            <span>Kategori</span>
                            <?php foreach ($berita_cat as $key => $category_val): ?>
                                <small><a href="<?php echo base_url('web/') . '?berita=' . $category_val['id'] ?>" title=""><?php echo $category_val['title'] ?></a></small>
                            <?php endforeach ?>
                        </div><!-- end meta -->
                    </div><!-- end title -->

                    <hr class="invis1">

                    <div class="custombox authorbox clearfix">
                        <h4 class="small-title">Tentang Penulis</h4>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <img src="upload/author.jpg" alt="" class="img-fluid rounded-circle"> 
                            </div><!-- end col -->

                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <h4><a href="#">Jessica</a></h4>
                                <p>Quisque sed tristique felis. Lorem <a href="#">visit my website</a> amet, consectetur adipiscing elit. Phasellus quis mi auctor, tincidunt nisl eget, finibus odio. Duis tempus elit quis risus congue feugiat. Thanks for stop Tech Blog!</p>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end author-box -->
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>