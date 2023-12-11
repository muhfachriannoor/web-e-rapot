
<?php $__env->startSection('cssfile'); ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/ekko-lightbox/ekko-lightbox.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rapot <b>Tahun Ajaran <?php echo e($dataTitle->tahun_ajaran->tahun_ajaran); ?></b></h1>
          <h1>Kelas <b><?php echo e($dataTitle->kelas->nama_kelas); ?></b></h1>
          <h1>Rapot <b><?php echo e($semester); ?></b></h1>
          <h1>Tambah Prestasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('rapot.TahunAjaran')); ?>">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapot.Kelas', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id])); ?>">Tahun
                Ajaran
                <?php echo e($dataTitle->tahun_ajaran->tahun_ajaran); ?></a>
            </li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapot.Siswa', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id])); ?>"><?php echo e($dataTitle->kelas->nama_kelas); ?></a>
            </li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Rapot
                <?php echo e($semester); ?></a>
            </li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapot.Prestasi', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Lihat
                Prestasi</a></li>
            <li class="breadcrumb-item active">Tambah Prestasi</li>
          </ol>
        </div>
      </div>
      <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Alert!</h5>
              <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          <?php endif; ?>
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tambah Prestasi</h3>
            </div>
            <!-- form start -->
            <form
              action="<?php echo e(route('rapot.PrestasiStore', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>"
              method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Siswa</label>
                        <select name="rapot_id" class="form-control select2" required>
                          <option value="" selected disabled>-- PILIH SISWA --</option>
                          <?php $__currentLoopData = $dataSiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataSiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dataSiswa->id_rapot); ?>"
                              <?php echo e(collect(old('rapot_id'))->contains($dataSiswa->id_rapot) ? 'selected="selected"' : ''); ?>>
                              <?php echo e($dataSiswa->kelas_siswa->siswa->nisn); ?> |
                              <?php echo e($dataSiswa->kelas_siswa->siswa->nama_siswa); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Jenis Prestasi</label>
                        <input type="text" name="jenis_prestasi" class="form-control" placeholder="Jenis Prestasi"
                          value="<?php echo e(old('jenis_prestasi', '')); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Keterangan Prestasi</label>
                        <textarea name="keterangan_prestasi" class="form-control" placeholder="Keterangan Prestasi" rows="5" required><?php echo e(old('keterangan_prestasi', '')); ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="<?php echo e(route('rapot.Prestasi', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">
                  Kembali</a>
              </div>
            </form>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
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
  <!-- Select2 -->
  <script src="<?php echo e(asset('admin/plugins/select2/js/select2.full.min.js')); ?>"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/prestasi/prestasi-form-add.blade.php ENDPATH**/ ?>