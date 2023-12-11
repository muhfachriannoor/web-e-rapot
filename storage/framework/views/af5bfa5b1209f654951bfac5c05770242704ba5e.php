
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
          <h1>Rapot <b>Tahun Ajaran <?php echo e($dataKelasSiswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></b></h1>
          <h1>Kelas <b><?php echo e($dataKelasSiswa->wali_kelas->kelas->nama_kelas); ?></b></h1>
          <h1>Siswa <b><?php echo e($dataKelasSiswa->siswa->nama_siswa); ?></b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('rapotTahunAjaran')); ?>">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapotKelas', $dataKelasSiswa->wali_kelas->tahun_ajaran->id)); ?>">Tahun Ajaran
                <?php echo e($dataKelasSiswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></a>
            </li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapotSiswa', ['tahun_ajaran_id' => $dataKelasSiswa->wali_kelas->tahun_ajaran->id, 'kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa])); ?>"><?php echo e($dataKelasSiswa->wali_kelas->kelas->nama_kelas); ?></a>
            </li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapot.index', [
                    'siswa_id' => $dataKelasSiswa->siswa_id,
                    'kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa,
                    'tahun_ajaran_id' => $dataKelasSiswa->wali_kelas->tahun_ajaran_id,
                ])); ?>"><?php echo e($dataKelasSiswa->siswa->nama_siswa); ?></a>
            </li>
            <li class="breadcrumb-item active">Tambah Rapot</li>
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
              <h3 class="card-title">Tambah Rapot</h3>
            </div>
            <!-- form start -->
            <form action="<?php echo e(route('rapot.store', ['siswa_id' => $siswa_id])); ?>" method="POST"
              enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" id="semester" class="form-control select2" required>
                          <option value="" selected disabled>-- PILIH SEMESTER --</option>
                          <option value="MID Semester Ganjil">MID Semester Ganjil</option>
                          <option value="Semester Ganjil">Semester Ganjil</option>
                          <option value="MID Semester Genap">MID Semester Genap</option>
                          <option value="Semester Genap">Semester Genap</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Jumlah Sakit</label>
                        <input type="number" name="sakit" class="form-control" placeholder="00" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Jumlah Izin</label>
                        <input type="number" name="izin" class="form-control" placeholder="00" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Jumlah Tanpa Keterangan</label>
                        <input type="number" name="tanpa_keterangan" class="form-control" placeholder="00" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Catatan Wali Kelas</label>
                        <textarea name="catatan_walikelas" class="form-control" rows="3" placeholder="Catatan Wali Kelas" required></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tanggapan Orang Tua/Wali</label>
                        <textarea name="tanggapan_orangtua_wali" class="form-control" rows="3" placeholder="Tanggapan Orang Tua/Wali"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="selectnya-keputusan-kelas" style="display: none;">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Keputusan Kelas</label>
                        <select name="keputusan_kelas" id="keputusan_kelas" class="form-control select2">
                          <option value="" selected disabled>-- PILIH KEPUTUSAN KELAS --</option>
                          <option value="Naik Kelas">Naik Kelas</option>
                          <option value="Tidak Naik Kelas">Tidak Naik Kelas</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="kelas_siswa_id" value="<?php echo e($kelas_siswa_id); ?>">
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
      bsCustomFileInput.init();
      //Initialize Select2 Elements
      $('.select2').select2();

      //Jquery Select Semester Genap Tampilkan Select Keputusan Kelas
      $('#semester').on('change', function() {
        let semester = $('select[name="semester"]').val()
        if (semester == 'Semester Genap') {
          //munculin select option dengan nama keputusan kelas
          $('#selectnya-keputusan-kelas').css('display', '');
        } else {
          $('#selectnya-keputusan-kelas').css('display', 'none');
        }
      });

    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/form-add-rapot.blade.php ENDPATH**/ ?>