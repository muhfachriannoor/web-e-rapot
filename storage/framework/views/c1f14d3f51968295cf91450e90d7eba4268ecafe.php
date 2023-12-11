
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
          <h1>Rapot <b><?php echo e($semester); ?></b></h1>
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
            <li class="breadcrumb-item active">Rapot <?php echo e($semester); ?></li>
          </ol>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12 mt-3">
          <div class="row">
            <div class="float-left">
              <?php use App\Models\NilaiMapel;?>
              <?php $__currentLoopData = $dataMapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataMapel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($cekNilaiMapel = App\Models\Rapot::cekNilaiMapel($tahun_ajaran_id, $semester, $dataMapel->mapel_id)): ?>
                  <a class="btn btn-success mb-1"
                    href="<?php echo e(route('rapot-kelas-siswa.inputNilaiMapel', ['kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa, 'tahun_ajaran_id' => $dataKelasSiswa->wali_kelas->tahun_ajaran_id, 'semester' => $semester, 'mapel_id' => $dataMapel->mata_pelajaran->id])); ?>">Input
                    Nilai
                    <?php echo e($dataMapel->mata_pelajaran->nama_mapel); ?></a>
                <?php else: ?>
                  <a class="btn btn-info mb-1"
                    href="<?php echo e(route('rapot-kelas-siswa.lihatNilaiMapel', ['kelas_siswa_id' => $dataKelasSiswa->id_kelas_siswa, 'tahun_ajaran_id' => $dataKelasSiswa->wali_kelas->tahun_ajaran_id, 'semester' => $semester, 'mapel_id' => $dataMapel->mata_pelajaran->id])); ?>">Lihat
                    Nilai
                    <?php echo e($dataMapel->mata_pelajaran->nama_mapel); ?></a>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <div class="row">
            <div class="float-left">
              <a class="btn btn-primary" href="#">Input Prestasi</a>
              <a class="btn btn-warning" href="#" style="color:#fff">Input Sikap dan Spiritual</a>
              <a class="btn btn-danger" href="#">Input Ekstrakurikuler</a>
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
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr style="text-align: center; vertical-align: middle;">
                    <th width="1%">No</th>
                    <th width="10%">Foto Siswa</th>
                    <th width="10%">NISN</th>
                    <th width="23%">Nama Siswa</th>
                    <th width="9%">Jumlah Sakit</th>
                    <th width="9%">Jumlah Izin</th>
                    <th width="9%">Jumlah Tanpa Keterangan</th>
                    <th>Catatan Wali Kelas</th>
                    <th>Tanggapan Orang Tua/Wali</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($loop->iteration); ?></td>
                      <td style="text-align: center; vertical-align: middle;">
                        <a href="<?php echo e(url('datafoto_siswa/' . $value->kelas_siswa->siswa->foto_siswa)); ?>"
                          data-toggle="lightbox" data-title="Foto <?php echo e($value->kelas_siswa->siswa->nama_siswa); ?>"
                          data-gallery="gallery">
                          <img src="<?php echo e(url('datafoto_siswa/' . $value->kelas_siswa->siswa->foto_siswa)); ?>"
                            class="img-fluid" alt="Foto <?php echo e($value->kelas_siswa->siswa->nama_siswa); ?>" width="100px"
                            height="50px">
                        </a>
                      </td>
                      <td style="vertical-align: middle;"><?php echo e($value->kelas_siswa->siswa->nisn); ?></td>
                      <td style="vertical-align: middle;"><a
                          href="<?php echo e(route('siswa.show', $value->kelas_siswa->siswa->id)); ?>"
                          target="_blank"><?php echo e($value->kelas_siswa->siswa->nama_siswa); ?></a>
                      </td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->sakit); ?> Hari</td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->izin); ?> Hari</td>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($value->tanpa_keterangan); ?> Hari</td>
                      <td style="vertical-align: middle;"><?php echo e($value->catatan_walikelas); ?></td>
                      <td style="vertical-align: middle;"><?php echo e($value->tanggapan_orangtua_wali); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
      $("#example1").DataTable({
        "responsive": true,
        "paging": true,
        "ordering": true
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/kelas-siswa/semester.blade.php ENDPATH**/ ?>