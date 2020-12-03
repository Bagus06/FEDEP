<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>FEDEP | Home Page</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo-kab-min.png">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo base_url("assets/webtemplate/") ?> images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo base_url("assets/webtemplate/") ?> images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("assets/webtemplate/") ?>css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="<?php echo base_url("assets/webtemplate/") ?>css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("assets/webtemplate/") ?>style.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="<?php echo base_url("assets/webtemplate/") ?>css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="<?php echo base_url("assets/webtemplate/") ?>css/colors.css" rel="stylesheet">

    <!-- Version Tech CSS for this template -->
    <link href="<?php echo base_url("assets/webtemplate/") ?>css/version/tech.css" rel="stylesheet">

    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/ekko-lightbox/ekko-lightbox.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('web') ?>"><img style="width: 65px; margin-right:" src="<?php echo base_url('assets/images/logofedeppati.png') ?>" alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('web'); ?>">Home</a>
                            </li>
                            <?php if ($this->uri->rsegments[2] != 'galery'): ?>
                                <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Berita</a>
                                    <ul class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                                        <li>
                                            <div class="container">
                                                <div class="mega-menu-content clearfix">
                                                    <div class="tab">
                                                        <button class="tablinks" onclick="window.location.href='<?php echo base_url('web'); ?>'">All</button>
                                                        <?php foreach ($berita_cat as $key => $bcat): ?>
                                                            <button class="tablinks" onclick="window.location.href='<?php echo base_url('web/') . '?berita=' . $bcat['id'] ?>'"><?php echo $bcat['title'] ?></button>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div><!-- end mega-menu-content -->
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('web/galery') ?>">Galery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('web/single_kontak') ?>">Kontak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('login') ?>">Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->

        <?php
            $this->load->view($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2]);
        ?>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="widget">
                            <div class="footer-text text-left">
                                <a href="<?php echo base_url('web') ?>"><img style="width: 100px; margin-right:" src="<?php echo base_url('assets/images/logofedeppati.png') ?>" alt="" class="img-fluid"></a>
                                <p>-</p>

                                <hr class="invis">
                            </div><!-- end footer-text -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Kontak</h2>
                            <div class="link">
                                <ul>
                                    <li><a href="#">-</a></li>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Tentang kami</h2>
                            <div class="link">
                                <ul>
                                    <li><a href="<?php echo base_url('web/single_kontak') ?>">About us</a></li>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>

                        <div class="copyright"><strong>Copyright FEDEP &copy; 2020 </strong>All rights reserved.</div>
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer -->

        <div class="dmtop">Scroll Ke Atas</div>
        
    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="<?php echo base_url("assets/webtemplate/") ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url("assets/webtemplate/") ?>js/tether.min.js"></script>
    <script src="<?php echo base_url("assets/webtemplate/") ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("assets/webtemplate/") ?>js/custom.js"></script>
    <!-- Ekko Lightbox -->
    <script src="<?php echo base_url(); ?>assets/vendor/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>

</body>
</html>