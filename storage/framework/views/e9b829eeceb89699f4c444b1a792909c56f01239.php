
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
          <h1>Data Kelas Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('kelas-siswa.index')); ?>">Data Kelas Siswa</a></li>
            <li class="breadcrumb-item active">Tambah Data Kelas Siswa</li>
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
            <form action="<?php echo e(route('kelas-siswa.update', $datanya->id_kelas_siswa)); ?>" method="POST"
              enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tahun Ajaran</label>
                      <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH TAHUN AJARAN --</option>
                        <?php $__currentLoopData = $dataTahunAjaranWaliKelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataTahunAjaranWaliKelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($dataTahunAjaranWaliKelas->tahun_ajaran->id); ?>"
                            <?php echo e(collect(old('tahun_ajaran_id', $datanya->wali_kelas->tahun_ajaran_id))->contains($dataTahunAjaranWaliKelas->tahun_ajaran->id) ? 'selected="selected"' : ''); ?>>
                            <?php echo e($dataTahunAjaranWaliKelas->tahun_ajaran->tahun_ajaran); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kelas</label>
                      <select name="kelas_id" id="kelas_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH KELAS --</option>
                        <?php $__currentLoopData = $dataKelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataKelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($dataKelas->kelas->id); ?>"
                            <?php echo e(collect(old('kelas_id', $datanya->wali_kelas->kelas_id))->contains($dataKelas->kelas->id) ? 'selected="selected"' : ''); ?>>
                            <?php echo e($dataKelas->kelas->nama_kelas); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Wali Kelas</label>
                      <input type="text" name="nama_wali_kelas" class="form-control" placeholder="Nama Wali"
                        value="<?php echo e(old('nama_wali_kelas', $datanya->wali_kelas->guru->nama_guru)); ?>" required readonly>
                      <input type="hidden" name="wali_kelas_id" class="form-control" placeholder="Nama Wali"
                        value="<?php echo e(old('wali_kelas_id', $datanya->wali_kelas_id)); ?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Siswa</label>
                      <select name="siswa_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH SISWA --</option>
                        <?php $__currentLoopData = $dataSiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataSiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($dataSiswa->id); ?>"
                            <?php echo e(collect(old('siswa_id', $datanya->siswa_id))->contains($dataSiswa->id) ? 'selected="selected"' : ''); ?>>
                            <?php echo e($dataSiswa->nisn); ?> | <?php echo e($dataSiswa->nama_siswa); ?></option>
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
      //AJAX Tahun Ajaran
      $('#tahun_ajaran_id').on('change', function() {
        let tahun_ajaran = $('select[name="tahun_ajaran_id"]').val()
        $.ajax({
            url: "<?php echo e(url('/dashboard/kelas-siswa/ajax/tahun-ajaran')); ?>/" + tahun_ajaran,
            method: "GET",
          })
          .done(function(result) {
            $('select[name="kelas_id"]').attr('disabled', false).html(result)
          });
      });
      //AJAX Wali Kelas
      $('#kelas_id').on('change', function() {
        let tahun_ajaran = $('select[name="tahun_ajaran_id"]').val()
        let kelas = $('select[name="kelas_id"]').val()
        $.ajax({
            url: "<?php echo e(url('/dashboard/kelas-siswa/ajax/kelas')); ?>",
            method: "GET",
            data: {
              tahun_ajaran: tahun_ajaran,
              kelas: kelas
            }
          })
          .done(function(data) {
            $('input[name="nama_wali_kelas"]').val(data.nama_guru)
            $('input[name="wali_kelas_id"]').val(data.wali_kelas_id)
          });
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/kelas-siswa/form-edit.blade.php ENDPATH**/ ?>