
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
                <?php if(
                    $cekNilaiMapel =
                        App\Models\Rapot::cekNilaiMapel(
                            $dataTitle->tahun_ajaran_id,
                            $dataTitle->kelas_id,
                            $semester,
                            $dataMapel->mapel_id) != false): ?>
                  <a class="btn btn-success mb-1"
                    href="<?php echo e(route('rapot.NilaiMapelCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester, 'mapel_id' => $dataMapel->mata_pelajaran->id])); ?>">Input
                    Nilai
                    <?php echo e($dataMapel->mata_pelajaran->nama_mapel); ?></a>
                <?php else: ?>
                  <a class="btn btn-info mb-1"
                    href="<?php echo e(route('rapot.NilaiMapel', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester, 'mapel_id' => $dataMapel->mata_pelajaran->id])); ?>">Lihat
                    Nilai
                    <?php echo e($dataMapel->mata_pelajaran->nama_mapel); ?></a>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <div class="row">
            <div class="float-left">
              <?php if($semester == 'Semester Ganjil' or $semester == 'Semester Genap'): ?>
                <a class="btn btn-primary"
                  href="<?php echo e(route('rapot.Prestasi', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Lihat
                  Data Prestasi</a>
                <?php if($cekSikapdanSpiritual != false): ?>
                  <a class="btn btn-warning"
                    href="<?php echo e(route('rapot.SikapCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>"
                    style="color:#fff">Input Sikap dan Spiritual</a>
                <?php else: ?>
                  <a class="btn btn-warning"
                    href="<?php echo e(route('rapot.Sikap', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>"
                    style="color:#fff">Lihat Sikap dan Spiritual</a>
                <?php endif; ?>
                <?php if($cekEkstrakurikuler != false): ?>
                  <a class="btn btn-danger"
                    href="<?php echo e(route('rapot.EkstrakurikulerCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Input
                    Ekstrakurikuler</a>
                <?php else: ?>
                  <a class="btn btn-danger"
                    href="<?php echo e(route('rapot.Ekstrakurikuler', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Lihat
                    Ekstrakurikuler</a>
                <?php endif; ?>
              <?php endif; ?>
              <?php $tingkat_kelas = $dataTitle->kelas->tingkat_kelas->tingkat_kelas; ?>
              <?php if($semester == 'Semester Genap' and $tingkat_kelas == 'Kelas VII (7)' or $tingkat_kelas == 'Kelas VIII (8)'): ?>
                <?php if($cekKeputusanKelas != false): ?>
                  <a class="btn btn-info"
                    href="<?php echo e(route('rapot.KeputusanNaikTidakNaikCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Input
                    Keputusan Naik/Tidak Naik</a>
                <?php else: ?>
                  <a class="btn btn-info"
                    href="<?php echo e(route('rapot.KeputusanNaikTidakNaik', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Lihat
                    Keputusan Naik/Tidak Naik</a>
                <?php endif; ?>
              <?php endif; ?>
              <?php if($semester == 'Semester Genap' and $tingkat_kelas == 'Kelas IX (9)'): ?>
                <?php if($cekKeputusanKelas != false): ?>
                  <a class="btn btn-info"
                    href="<?php echo e(route('rapot.KeputusanLulusTidakLulusCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Input
                    Keputusan Lulus/Tidak Lulus</a>
                <?php else: ?>
                  <a class="btn btn-info"
                    href="<?php echo e(route('rapot.KeputusanLulusTidakLulus', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">Lihat
                    Keputusan Lulus/Tidak Lulus</a>
                <?php endif; ?>
              <?php endif; ?>
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
                    <th>Aksi</th>
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
                      <td><a class="btn btn-primary"
                          href="<?php echo e(route('rapot.SemesterEdit', ['tahun_ajaran_id' => $value->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $value->kelas_siswa->wali_kelas->kelas_id, 'semester' => $value->semester, 'id_rapot' => $value->id_rapot])); ?>">Ubah</a>
                      </td>
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

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/semester.blade.php ENDPATH**/ ?>