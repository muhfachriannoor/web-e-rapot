
<?php $__env->startSection('cssfile'); ?>
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?php echo e(asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/ekko-lightbox/ekko-lightbox.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lihat Data Akun</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Lihat Data Akun</li>
          </ol>
        </div>
        <div class="col-sm-12 mt-3">
          <div class="float-left">
            <a class="btn btn-success" href="<?php echo e(route('data-akun.index')); ?>"> Kembali</a>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">Data Akun
                <b><?php echo e($datanya->nama); ?></b>
              </h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <a href="<?php echo e(url('datafoto_user/' . $datanya->foto_user)); ?>" data-toggle="lightbox"
                    data-title="Foto $datanya->nama }}" data-gallery="gallery">
                    <img src="<?php echo e(url('datafoto_user/' . $datanya->foto_user)); ?>" class="img-fluid mb-2"
                      alt="Foto <?php echo e($datanya->nama); ?>">
                  </a>
                </div>
                <div class="col-sm-8">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td width="25%">Nama Lengkap</td>
                        <td width="1%" align="center">:</td>
                        <td><b><?php echo e($datanya->nama); ?></b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Email</td>
                        <td width="1%" align="center">:</td>
                        <td><b><?php echo e($datanya->email); ?></b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Username</td>
                        <td width="1%" align="center">:</td>
                        <td><b><?php echo e($datanya->username); ?></b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Level Akun</td>
                        <td width="1%" align="center">:</td>
                        <td><b><?php echo e($datanya->level == 1 ? 'Administrator' : 'Member'); ?></b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsfile'); ?>
  <!-- DataTables  & Plugins -->
  <script src="<?php echo e(asset('admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/jszip/jszip.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>
  <!-- Ekko Lightbox -->
  <script src="<?php echo e(asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js')); ?>"></script>
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/akun/lihat-akun.blade.php ENDPATH**/ ?>