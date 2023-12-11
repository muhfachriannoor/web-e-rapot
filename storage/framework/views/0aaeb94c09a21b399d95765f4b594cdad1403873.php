
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
          <h1><b><?php echo e($semester); ?></b></h1>
          <h1>Lihat Nilai <b><?php echo e($dataMapel->nama_mapel); ?></b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('rapotTahunAjaran')); ?>">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapotKelas', $dataKelasSiswa->wali_kelas->tahun_ajaran->id)); ?>">Tahun
                Ajaran
                <?php echo e($dataKelasSiswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></a>
            </li>
            <li class="breadcrumb-item "><a
                href="<?php echo e(route('rapotSiswa', ['tahun_ajaran_id' => $dataKelasSiswa->wali_kelas->tahun_ajaran_id, 'kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa])); ?>"><?php echo e($dataKelasSiswa->wali_kelas->kelas->nama_kelas); ?></a>
            </li>
            <li class="breadcrumb-item"><a
                href="<?php echo e(route('rapot-kelas-siswa.semester', ['kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa, 'tahun_ajaran_id' => $dataKelasSiswa->wali_kelas->tahun_ajaran_id, 'semester' => $semester])); ?>"><?php echo e($semester); ?></a>
            </li>
            <li class="breadcrumb-item active">Lihat Nilai <?php echo e($dataMapel->nama_mapel); ?></li>
          </ol>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12 mt-3">
          <div class="float-left">
            <a class="btn btn-success" href="<?php echo e(url()->previous()); ?>"> Kembali</a>
          </div>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Lihat Nilai <b><?php echo e($dataMapel->nama_mapel); ?></b></h3>
            </div>
            <div class="card-body">
              <div class="form-group">
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="2%" rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                    <th width="25%" rowspan="2" style="text-align: center; vertical-align: middle;">Nama Siswa
                    </th>
                    <th width="20%" colspan="3" style="text-align: center; vertical-align: middle;">Pengetahuan
                    </th>
                    <th width="20%" colspan="3" style="text-align: center; vertical-align: middle;">Keterampilan
                    </th>
                  </tr>
                  <tr>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                    <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                    <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($loop->iteration); ?></td>
                      <td style="vertical-align: middle;"><a
                          href="<?php echo e(route('siswa.show', $value->rapot->kelas_siswa->siswa->id)); ?>"
                          target="_blank"><?php echo e($value->rapot->kelas_siswa->siswa->nama_siswa); ?></a>
                      </td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->nilai_pengetahuan); ?></td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->predikat_pengetahuan); ?></td>
                      <td style="vertical-align: middle;"><?php echo e($value->deskripsi_pengetahuan); ?></td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->nilai_keterampilan); ?></td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->predikat_keterampilan); ?></td>
                      <td style="vertical-align: middle;"><?php echo e($value->deskripsi_keterampilan); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
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
      $("#example1").DataTable({
        "responsive": true,
        "paging": true,
        "ordering": true
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/kelas-siswa/nilai-mapel-lihat.blade.php ENDPATH**/ ?>