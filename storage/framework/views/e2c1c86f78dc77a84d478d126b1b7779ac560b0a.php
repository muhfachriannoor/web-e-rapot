
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
          <h1>Lihat Nilai <b><?php echo e($dataMapel->nama_mapel); ?></b></h1>
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
            <li class="breadcrumb-item active">Lihat Nilai <?php echo e($dataMapel->nama_mapel); ?></li>
          </ol>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12 mt-3">
          <div class="float-left">
            <a class="btn btn-success"
              href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">
              Kembali</a>
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
                    <th width="20%"
                      <?php echo e(($semester == 'Semester Ganjil' or $semester == 'Semester Genap') ? 'colspan=4' : 'colspan=3'); ?>

                      style="text-align: center; vertical-align: middle;">Pengetahuan
                    </th>
                    <th width="20%"
                      <?php echo e(($semester == 'Semester Ganjil' or $semester == 'Semester Genap') ? 'colspan=4' : 'colspan=3'); ?>

                      style="text-align: center; vertical-align: middle;">Keterampilan
                    </th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Status KKM</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                  </tr>
                  <tr>
                    <th width="6%" style="text-align: center; vertical-align: middle;">KKM</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                    <?php if($semester == 'Semester Ganjil' or $semester == 'Semester Genap'): ?>
                      <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                    <?php endif; ?>
                    <th width="6%" style="text-align: center; vertical-align: middle;">KKM</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                    <?php if($semester == 'Semester Ganjil' or $semester == 'Semester Genap'): ?>
                      <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                    <?php endif; ?>
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
                      <td style="text-align: center; vertical-align: middle;">
                        <b><?php echo e($value->mata_pelajaran->nilai_kkm); ?></b>
                      </td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->nilai_pengetahuan); ?></td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->predikat_pengetahuan); ?></td>
                      <?php if($semester == 'Semester Ganjil' or $semester == 'Semester Genap'): ?>
                        <td style="vertical-align: middle;"><?php echo e($value->deskripsi_pengetahuan); ?></td>
                      <?php endif; ?>
                      <td style="text-align: center; vertical-align: middle;">
                        <b><?php echo e($value->mata_pelajaran->nilai_kkm); ?></b>
                      </td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->nilai_keterampilan); ?></td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->predikat_keterampilan); ?></td>
                      <?php if($semester == 'Semester Ganjil' or $semester == 'Semester Genap'): ?>
                        <td style="vertical-align: middle;"><?php echo e($value->deskripsi_keterampilan); ?></td>
                      <?php endif; ?>
                      <td style="text-align: center; vertical-align: middle;">
                        <?php if($value->status_kkm == 'Lulus Nilai KKM'): ?>
                          <span class="badge bg-success"><?php echo e($value->status_kkm); ?></span>
                        <?php else: ?>
                          <span class="badge bg-danger"><?php echo e($value->status_kkm); ?></span>
                        <?php endif; ?>
                      </td>
                      <td style="text-align: center; vertical-align: middle;"><a class="btn btn-primary"
                          href="<?php echo e(route('rapot.NilaiMapelEdit', ['tahun_ajaran_id' => $value->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $value->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $value->rapot->semester, 'mapel_id' => $value->id_mapel, 'id_nilai_mapel' => $value->id_nilai_mapel])); ?>">Ubah</a>
                      </td>
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

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/nilai-mapel/nilai-mapel.blade.php ENDPATH**/ ?>