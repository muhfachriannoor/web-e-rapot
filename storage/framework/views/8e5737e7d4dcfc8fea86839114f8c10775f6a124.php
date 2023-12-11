
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
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('rapot.TahunAjaran')); ?>">Rapot</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('rapot.Kelas', $dataTitle->tahun_ajaran_id)); ?>">Tahun
                Ajaran
                <?php echo e($dataTitle->tahun_ajaran->tahun_ajaran); ?></a>
            </li>
            <li class="breadcrumb-item active"><?php echo e($dataTitle->kelas->nama_kelas); ?></li>
          </ol>
        </div>
        <div class="col-sm-12 mt-3">
          <div class="row">
            <div class="float-left">
              <?php if($cekRapotMidSemesterGanjil != null): ?>
                <a class="btn btn-success"
                  href="<?php echo e(route('rapot.SemesterCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'MID Semester Ganjil'])); ?>">Tambah
                  Rapot MID Semester Ganjil</a>
              <?php else: ?>
                <a class="btn btn-info"
                  href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'MID Semester Ganjil'])); ?>">Rapot
                  MID Semester Ganjil</a>
                <?php if($cekRapotSemesterGanjil != null): ?>
                  <a class="btn btn-success"
                    href="<?php echo e(route('rapot.SemesterCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'Semester Ganjil'])); ?>">Tambah
                    Rapot Semester Ganjil</a>
                <?php else: ?>
                  <a class="btn btn-info"
                    href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'Semester Ganjil'])); ?>">Rapot
                    Semester Ganjil</a>
                  <?php if($cekRapotMidSemesterGenap != null): ?>
                    <a class="btn btn-success"
                      href="<?php echo e(route('rapot.SemesterCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'MID Semester Genap'])); ?>">Tambah
                      Rapot MID Semester Genap</a>
                  <?php else: ?>
                    <a class="btn btn-info"
                      href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'MID Semester Genap'])); ?>">Rapot
                      MID Semester Genap</a>
                    <?php if($cekRapotSemesterGenap != null): ?>
                      <a class="btn btn-success"
                        href="<?php echo e(route('rapot.SemesterCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'Semester Genap'])); ?>">Tambah
                        Rapot Semester Genap</a>
                    <?php else: ?>
                      <a class="btn btn-info"
                        href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => 'Semester Genap'])); ?>">Rapot
                        Semester Genap</a>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
            </div>
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
                  <tr align="center">
                    <th width="2%">No</th>
                    <th width="10%">Foto Siswa</th>
                    <th>NISN</th>
                    <th width="45%">Nama Siswa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td style="text-align: center; vertical-align: middle;"><?php echo e($loop->iteration); ?></td>
                      <td style="text-align: center; vertical-align: middle;">
                        <a href="<?php echo e(url('datafoto_siswa/' . $value->siswa->foto_siswa)); ?>" data-toggle="lightbox"
                          data-title="Foto <?php echo e($value->siswa->nama_siswa); ?>" data-gallery="gallery">
                          <img src="<?php echo e(url('datafoto_siswa/' . $value->siswa->foto_siswa)); ?>" class="img-fluid"
                            alt="Foto <?php echo e($value->siswa->nama_siswa); ?>" width="100px" height="50px">
                        </a>
                      </td>
                      <td style="vertical-align: middle;"><?php echo e($value->siswa->nisn); ?></td>
                      <td style="vertical-align: middle;"><a href="<?php echo e(route('siswa.show', $value->siswa->id)); ?>"
                          target="_blank"><?php echo e($value->siswa->nama_siswa); ?></a></td>
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

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/siswa.blade.php ENDPATH**/ ?>