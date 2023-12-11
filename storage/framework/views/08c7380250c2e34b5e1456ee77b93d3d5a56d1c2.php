
<?php $__env->startSection('cssfile'); ?>
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?php echo e(asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Wali Kelas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('wali-kelas.index')); ?>">Data Wali Kelas</a></li>
            <li class="breadcrumb-item active">Ubah Data Wali Kelas</li>
          </ol>
        </div>
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
              <h3 class="card-title">Tambah Data</h3>
            </div>
            <!-- form start -->
            <form action="<?php echo e(route('wali-kelas.update', $datanya->id)); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tahun Ajaran</label>
                      <select name="tahun_ajaran_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH TAHUN AJARAN --</option>
                        <?php $__currentLoopData = $dataTahunAjaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataTahunAjaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($dataTahunAjaran->id); ?>"
                            <?php echo e(collect(old('tahun_ajaran_id', $datanya->tahun_ajaran_id))->contains($dataTahunAjaran->id) ? 'selected="selected"' : ''); ?>>
                            <?php echo e($dataTahunAjaran->tahun_ajaran); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kelas</label>
                      <select name="kelas_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH KELAS --</option>
                        <?php $__currentLoopData = $dataKelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataKelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($dataKelas->id); ?>"
                            <?php echo e(collect(old('kelas_id', $datanya->kelas_id))->contains($dataKelas->id) ? 'selected="selected"' : ''); ?>>
                            <?php echo e($dataKelas->nama_kelas); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Guru</label>
                      <select name="guru_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH GURU --</option>
                        <?php $__currentLoopData = $dataGuru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataGuru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($dataGuru->id); ?>"
                            <?php echo e(collect(old('guru_id', $datanya->guru_id))->contains($dataGuru->id) ? 'selected="selected"' : ''); ?>>
                            <?php echo e($dataGuru->nip); ?> | <?php echo e($dataGuru->nama_guru); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a class="btn btn-success" href="<?php echo e(url()->previous()); ?>"> Kembali</a>
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
  <!-- InputMask -->
  <script src="<?php echo e(asset('admin/plugins/moment/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/plugins/inputmask/jquery.inputmask.min.js')); ?>"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo e(asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
  <!-- bs-custom-file-input -->
  <script src="<?php echo e(asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')); ?>"></script>
  <!-- Select2 -->
  <script src="<?php echo e(asset('admin/plugins/select2/js/select2.full.min.js')); ?>"></script>

  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/wali-kelas/form-edit.blade.php ENDPATH**/ ?>