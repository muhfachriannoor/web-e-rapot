
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
          <h1>Input Nilai <b><?php echo e($dataMapel->nama_mapel); ?></b></h1>
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
            <li class="breadcrumb-item active">Input Nilai <?php echo e($dataMapel->nama_mapel); ?></li>
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
              <h3 class="card-title">Input Nilai <b><?php echo e($dataMapel->nama_mapel); ?></b></h3>
            </div>
            <!-- form start -->
            <form
              action="<?php echo e(route('rapot.NilaiMapelStore', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester, 'mapel_id' => $mapel_id])); ?>"
              method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="card-body">
                <div class="form-group">
                </div>
                <table class="table table-bordered table-striped">
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
                            href="<?php echo e(route('siswa.show', $value->kelas_siswa->siswa->id)); ?>"
                            target="_blank"><?php echo e($value->kelas_siswa->siswa->nama_siswa); ?></a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;"><b><?php echo e($dataMapel->nilai_kkm); ?></b></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="number"
                            name="nilai_pengetahuan[<?php echo e($key); ?>]" id="nilai_pengetahuan<?php echo e($key); ?>"
                            class="form-control text-center" placeholder="00"
                            value="<?php echo e(old("nilai_pengetahuan.{$key}", '')); ?>" required></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="text"
                            name="predikat_pengetahuan[<?php echo e($key); ?>]"
                            id="predikat_pengetahuan<?php echo e($key); ?>" class="form-control text-center" placeholder=""
                            value="<?php echo e(old("predikat_pengetahuan.{$key}", '')); ?>" readonly required>
                        </td>
                        <?php if($semester == 'Semester Ganjil' or $semester == 'Semester Genap'): ?>
                          <td>
                            <textarea name="deskripsi_pengetahuan[<?php echo e($key); ?>]" class="form-control" rows="3"
                              placeholder="Deskripsi Pengetahuan" required><?php echo e(old("deskripsi_pengetahuan.{$key}", '')); ?></textarea>
                          </td>
                        <?php endif; ?>
                        <td style="text-align: center; vertical-align: middle;"><b><?php echo e($dataMapel->nilai_kkm); ?></b></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="number"
                            name="nilai_keterampilan[<?php echo e($key); ?>]" id="nilai_keterampilan<?php echo e($key); ?>"
                            class="form-control text-center" placeholder="00"
                            value="<?php echo e(old("nilai_keterampilan.{$key}", '')); ?>" required></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="text"
                            name="predikat_keterampilan[<?php echo e($key); ?>]"
                            id="predikat_keterampilan<?php echo e($key); ?>" class="form-control text-center"
                            placeholder="" value="<?php echo e(old("predikat_keterampilan.{$key}", '')); ?>" readonly required>
                        </td>
                        <?php if($semester == 'Semester Ganjil' or $semester == 'Semester Genap'): ?>
                          <td>
                            <textarea name="deskripsi_keterampilan[<?php echo e($key); ?>]" class="form-control" rows="3"
                              placeholder="Deskripsi Keterampilan" required><?php echo e(old("deskripsi_keterampilan.{$key}", '')); ?></textarea>
                          </td>
                        <?php endif; ?>
                        <input type="hidden" name="id_mapel[]" value="<?php echo e($dataMapel->id); ?>" required>
                        <input type="hidden" name="rapot_id[]" value="<?php echo e($value->id_rapot); ?>" required>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>">
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

      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        //Jquery Jika Mengisi Angka pengetahuan, Tampilkan Predikat pengetahuannya
        $('#nilai_pengetahuan<?php echo e($key2); ?>').on('change', function() {
          let nilai_pengetahuan = $('#nilai_pengetahuan<?php echo e($key2); ?>').val()
          if (nilai_pengetahuan >= 92) {
            //Tampilkan predikat pengetahuan
            $('#predikat_pengetahuan<?php echo e($key2); ?>').val('A');
          } else if (nilai_pengetahuan >= 83) {
            $('#predikat_pengetahuan<?php echo e($key2); ?>').val('B');
          } else if (nilai_pengetahuan >= 75) {
            $('#predikat_pengetahuan<?php echo e($key2); ?>').val('C');
          } else if (nilai_pengetahuan >= 0) {
            $('#predikat_pengetahuan<?php echo e($key2); ?>').val('D');
          }
        });
        //Jquery Jika Mengisi Angka keterampilan, Tampilkan Predikat keterampilan
        $('#nilai_keterampilan<?php echo e($key2); ?>').on('change', function() {
          let nilai_keterampilan = $('#nilai_keterampilan<?php echo e($key2); ?>').val()
          if (nilai_keterampilan >= 92) {
            //Tampilkan predikat keterampilan
            $('#predikat_keterampilan<?php echo e($key2); ?>').val('A');
          } else if (nilai_keterampilan >= 83) {
            $('#predikat_keterampilan<?php echo e($key2); ?>').val('B');
          } else if (nilai_keterampilan >= 75) {
            $('#predikat_keterampilan<?php echo e($key2); ?>').val('C');
          } else if (nilai_keterampilan >= 0) {
            $('#predikat_keterampilan<?php echo e($key2); ?>').val('D');
          }
        });
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/nilai-mapel-form-add.blade.php ENDPATH**/ ?>