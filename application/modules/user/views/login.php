<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->uri->rsegments[2]; ?></title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo-kab-min.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition">
  <div class="container col-md-12" style="padding: 0px;">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-light " id="navigation" role="navigation" style="background-image: url(<?php echo base_url('assets/images/bapeda.jpeg') ?>); height: 170px; object-fit: cover; background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="container-fluid-nav text-center" style=" position: absolute;left: 50%;transform: translatex(-50%);">
        <a href="#">
          <img style="width: 50px; margin-right: 4px;margin-top: 5px" src="<?php echo base_url('assets/images/logo-kab.png') ?>" alt="">
          <h1 style="color: white; -webkit-text-stroke: 1px black;"><strong>BAPEDA KAB PATI</strong></h1>
        </a>
      </div>
    </nav> 
      <div style="height: auto; background-color: white;">
        <div style="margin: 5px">
          <h6>Telephone :  | Fax :  | Email :  | Website : <a href=""></a> | Alamat :  </h6>
        </div>
      </div>
  </div>

<div class="hold-transition login-page" style="background-image: url(<?php echo base_url('assets/images/bg_login.jpeg') ?>); object-fit: cover; background-size: cover; background-position: center; background-repeat: no-repeat;">
    <!-- /.login-logo -->
  <div class="login-box" style="margin-top: -300px;">
    
    <div class="card">
      <div class="login-logo" style="padding-top: 15px">
        <img style="width: 50px; margin-right:" src="<?php echo base_url('assets/images/logofedeppati.png') ?>" alt="">
        <a href="<?php echo base_url(); ?>" style="color: black; "><b>FED</b>EP</a>
        <p class="login-box-msg" style="font-size: 15px">Sign in untuk mengakses website</p>
      </div>
      <div class="card-body login-card-body" style="margin-top: 0px;padding-top: 0px">
        <?php if (!empty($data['msg'])): ?>
          <?php echo alert($data['status'],$data['msg']) ?>
          <?php if (!empty($data['msgs'])): ?>
            <?php foreach ($data['msgs'] as $key => $value): ?>
              <?php echo alert($data['status'], $value) ?>
            <?php endforeach ?> 
          <?php endif ?>
        <?php endif ?>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>

</body>
</html>

