<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('admin-lte/meta') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php if ($this->uri->rsegments[1] == 'responses' && $this->uri->rsegments[2] == 'list'): ?>
    <div class="wrapper" style="margin: 10px">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          $this->load->view($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2]);
          ?>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  <?php else: ?>
    <div class="wrapper">

      <?php $this->load->view('admin-lte/nav-menu') ?>

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="<?php $id = get_user()['id']; echo base_url('assets/images/user/' . get_profile($id)); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?php echo get_user()['profile']['nama'] ?></a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <?php $this->load->view('admin-lte/sidebar') ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?php echo $this->uri->rsegments[1]; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url() . $this->uri->rsegments[1] ?>"><?php echo $this->uri->rsegments[1]; ?></a></li>
                <?php if (!empty($this->uri->rsegments[3])): ?>
                  <li class="breadcrumb-item"><a href="<?php echo base_url() . $this->uri->rsegments[1] . '/' . $this->uri->rsegments[2] ?>"><?php echo @$this->uri->rsegments[2]; ?></a></li>
                  <li class="breadcrumb-item active"><?php echo @$this->uri->rsegments[3]; ?></li>
                <?php else: ?>
                  <li class="breadcrumb-item active"><?php echo @$this->uri->rsegments[2]; ?></li>
                <?php endif ?>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          $this->load->view($this->uri->rsegments[1] . '/' . $this->uri->rsegments[2]);
          ?>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 </strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  <?php endif ?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin-lte/js') ?>

</body>

</html>