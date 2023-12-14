<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e($title); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/adminlte.min.css')); ?>">
  <?php echo $__env->yieldContent('cssfile'); ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-cogs"></i>
            
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
            
            <div class="dropdown-divider"></div>
            <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt"></i> Keluar
              
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
              <?php echo csrf_field(); ?>
            </form>
            <div class="dropdown-divider"></div>
            
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo e(route('dashboard')); ?>" class="brand-link">
        <img src="<?php echo e(asset('admin/dist/img/logo_dashboard.png')); ?>" alt="Logo Muhammadiyah"
          class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-light">E-Rapot</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo e(url('datafoto_user/' . auth()->user()->foto_user)); ?>" class="img-circle elevation-2"
              alt="Foto <?php echo e(auth()->user()->nama); ?>">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo e(auth()->user()->nama); ?></a>
          </div>
        </div>

        

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            
            <li class="nav-item">
              <a href="<?php echo e(route('dashboard')); ?>"
                class="nav-link <?php echo e($title == 'Dashboard E-Kepegawaian' ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <?php if(auth()->user()->level == 1 or auth()->user()->level == 2): ?>
              <li class="nav-item <?php if(
                  $title == 'Informasi Sekolah' or
                      $title == 'Tingkat Kelas' or
                      $title == 'Tahun Ajaran' or
                      $title == 'Kelas' or
                      $title == 'Mata Pelajaran' or
                      $title == 'Mata Pelajaran Kelas'): ?> menu-open <?php endif; ?>">
                <a href="#" class="nav-link <?php if(
                    $title == 'Informasi Sekolah' or
                        $title == 'Tingkat Kelas' or
                        $title == 'Tahun Ajaran' or
                        $title == 'Kelas' or
                        $title == 'Mata Pelajaran' or
                        $title == 'Mata Pelajaran Kelas'): ?> active <?php endif; ?>">
                  <i class="nav-icon fas fa-database"></i>
                  <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo e(route('informasi-sekolah.index')); ?>"
                      class="nav-link <?php echo e($title == 'Informasi Sekolah' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Informasi Sekolah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('tahun-ajaran.index')); ?>"
                      class="nav-link <?php echo e($title == 'Tahun Ajaran' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tahun Ajaran</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('tingkat-kelas.index')); ?>"
                      class="nav-link <?php echo e($title == 'Tingkat Kelas' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tingkat Kelas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('kelas.index')); ?>" class="nav-link <?php echo e($title == 'Kelas' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('mata-pelajaran.index')); ?>"
                      class="nav-link <?php echo e($title == 'Mata Pelajaran' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mata Pelajaran</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('mapel-kelas.index')); ?>"
                      class="nav-link <?php echo e($title == 'Mata Pelajaran Kelas' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mata Pelajaran Kelas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item <?php if($title == 'Data Guru' or $title == 'Data Wali Kelas'): ?> menu-open <?php endif; ?>">
                <a href="#" class="nav-link <?php if($title == 'Data Guru' or $title == 'Data Wali Kelas'): ?> active <?php endif; ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Guru
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo e(route('guru.index')); ?>"
                      class="nav-link <?php echo e($title == 'Data Guru' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Guru</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('wali-kelas.index')); ?>"
                      class="nav-link <?php echo e($title == 'Data Wali Kelas' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Wali Kelas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item <?php if($title == 'Data Siswa' or $title == 'Data Kelas Siswa'): ?> menu-open <?php endif; ?>">
                <a href="#" class="nav-link <?php if($title == 'Data Siswa'): ?> active <?php endif; ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Siswa
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo e(route('siswa.index')); ?>"
                      class="nav-link <?php echo e($title == 'Data Siswa' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Siswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('kelas-siswa.index')); ?>"
                      class="nav-link <?php echo e($title == 'Data Kelas Siswa' ? 'active' : ''); ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Kelas Siswa</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->level == 1): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('rapot.TahunAjaran')); ?>" class="nav-link <?php echo e($title == 'Rapot' ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Rapot
                    
                  </p>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->level == 3): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('rapot.WaliKelas')); ?>" class="nav-link <?php echo e($title == 'Rapot' ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Rapot
                    
                  </p>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->level == 1): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('data-akun.index')); ?>"
                  class="nav-link <?php echo e($title == 'Data Akun' ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Data Akun
                    
                  </p>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2023 E-Rapot.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo e(asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(asset('admin/dist/js/adminlte.min.js')); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  
  <?php echo $__env->yieldContent('jsfile'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/layouts/templatedashboard.blade.php ENDPATH**/ ?>