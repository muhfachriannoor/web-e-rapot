
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
          <h1>Rapot <b>Tahun Ajaran <?php echo e($dataKelasSiswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></b></h1>
          <h1>Kelas <b><?php echo e($dataKelasSiswa->wali_kelas->kelas->nama_kelas); ?></b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('rapotTahunAjaran')); ?>">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapotKelas', $dataKelasSiswa->wali_kelas->tahun_ajaran->id)); ?>">Tahun
                Ajaran
                <?php echo e($dataKelasSiswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></a>
            </li>
            <li class="breadcrumb-item "><a
                href="<?php echo e(route('rapotSiswa', ['tahun_ajaran_id' => $dataKelasSiswa->wali_kelas->tahun_ajaran_id, 'kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa])); ?>"><?php echo e($dataKelasSiswa->wali_kelas->kelas->nama_kelas); ?></a>
            </li>
            <li class="breadcrumb-item active">Tambah Rapot <?php echo e($semester); ?></li>
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
              <h3 class="card-title">Tambah Rapot <b><?php echo e($semester); ?></b></h3>
            </div>
            <!-- form start -->
            <form action="<?php echo e(route('rapot-kelas-siswa.store', ['kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa])); ?>"
              method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="text" name="semester" class="form-control"
                          value="<?php echo e(old('semester', $semester)); ?>" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="2%">No</th>
                      <th width="10%">Foto Siswa</th>
                      <th width="10%">NISN</th>
                      <th width="20%">Nama Siswa</th>
                      <th width="8%">Jumlah Sakit</th>
                      <th width="8%">Jumlah Izin</th>
                      <th width="8%">Jumlah Tanpa Keterangan</th>
                      <th>Catatan Wali Kelas</th>
                      <th>Tanggapan Orang Tua/Wali</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td align="center">
                          <a href="<?php echo e(url('datafoto_siswa/' . $value->siswa->foto_siswa)); ?>" data-toggle="lightbox"
                            data-title="Foto <?php echo e($value->siswa->nama_siswa); ?>" data-gallery="gallery">
                            <img src="<?php echo e(url('datafoto_siswa/' . $value->siswa->foto_siswa)); ?>" class="img-fluid"
                              alt="Foto <?php echo e($value->siswa->nama_siswa); ?>" width="100px" height="50px">
                          </a>
                        </td>
                        <td><?php echo e($value->siswa->nisn); ?></td>
                        <td><a href="<?php echo e(route('siswa.show', $value->siswa->id)); ?>"
                            target="_blank"><?php echo e($value->siswa->nama_siswa); ?></a>
                        </td>
                        <td><input type="number" name="sakit[<?php echo e($key); ?>]" class="form-control" placeholder="00"
                            value="<?php echo e(old("sakit.{$key}", '')); ?>" required></td>
                        <td><input type="number" name="izin[<?php echo e($key); ?>]" class="form-control" placeholder="00"
                            value="<?php echo e(old("izin.{$key}", '')); ?>" required></td>
                        <td><input type="number" name="tanpa_keterangan[<?php echo e($key); ?>]" class="form-control"
                            placeholder="00" value="<?php echo e(old("tanpa_keterangan.{$key}", '')); ?>" required>
                        </td>
                        <td>
                          <textarea name="catatan_walikelas[<?php echo e($key); ?>]" class="form-control" rows="3"
                            placeholder="Catatan Wali Kelas" required><?php echo e(old("catatan_walikelas.{$key}", '')); ?></textarea>
                        </td>
                        <td>
                          <textarea name="tanggapan_orangtua_wali[<?php echo e($key); ?>]" class="form-control" rows="3"
                            placeholder="Tanggapan Orang Tua/Wali"><?php echo e(old("tanggapan_orangtua_wali.{$key}", '')); ?></textarea>
                        </td>
                        <input type="hidden" name="kelas_siswa_id[]" value="<?php echo e($value->id_kelas_siswa); ?>" required>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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

      //Jquery Select Semester Genap Tampilkan Select Keputusan Kelas
      //$('#semester').on('change', function() {
      //  let semester = $('select[name="semester"]').val()
      //  if (semester == 'Semester Genap') {
      //    //munculin select option dengan nama keputusan kelas
      //    $('#header-selectnya-keputusan-kelas').css('display', '');
      //    $('#selectnya-keputusan-kelas').css('display', '');
      //  } else {
      //    $('#header-selectnya-keputusan-kelas').css('display', 'none');
      //    $('#selectnya-keputusan-kelas').css('display', 'none');
      //  }
      //});
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/kelas-siswa/rapot-form-add.blade.php ENDPATH**/ ?>