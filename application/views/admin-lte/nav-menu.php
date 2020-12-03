<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <div class="media">
            <img src="<?php $id = get_user()['id']; echo base_url('assets/images/user/' . get_profile($id)); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h2 class="dropdown-item-title" style="padding-top: 10%">
                <strong>
                  <?php echo get_user()['profile']['nama'] ?>
                </strong>
              </h2>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url('user/user_profil/') ?><?php echo get_user()['id'] ?>" class="dropdown-item">
          <div class="media">
            <i class="fas fa-user-cog"></i>
            <div class="media-body">
              <h3 class="dropdown-item-title" style="padding-left: 5px">
                Profil
              </h3>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url('logout') ?>" class="dropdown-item dropdown-footer">Log out</a>
      </div>
    </li>
  </ul>
</nav>
    <!-- /.navbar -->