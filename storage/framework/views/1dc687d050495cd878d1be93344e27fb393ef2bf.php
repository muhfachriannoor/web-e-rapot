  
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
            <h1>Rapot <b>Tahun Ajaran <?php echo e($datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></b></h1>
            <h1>Kelas <b><?php echo e($datanya->rapot->kelas_siswa->wali_kelas->kelas->nama_kelas); ?></b></h1>
            <h1>Rapot <b><?php echo e($datanya->rapot->semester); ?></b></h1>
            <h1>Lihat Nilai <b><?php echo e($datanya->mata_pelajaran->nama_mapel); ?></b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('rapot.TahunAjaran')); ?>">Rapot</a></li>
              <li class="breadcrumb-item"><a
                  href="<?php echo e(route('rapot.Kelas', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id])); ?>">Tahun
                  Ajaran
                  <?php echo e($datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></a>
              </li>
              <li class="breadcrumb-item"><a
                  href="<?php echo e(route('rapot.Siswa', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id])); ?>"><?php echo e($datanya->rapot->kelas_siswa->wali_kelas->kelas->nama_kelas); ?></a>
              </li>
              <li class="breadcrumb-item"><a
                  href="<?php echo e(route('rapot.Semester', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester])); ?>">Rapot
                  <?php echo e($datanya->rapot->semester); ?></a>
              </li>
              <li class="breadcrumb-item"><a
                  href="<?php echo e(route('rapot.NilaiMapel', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester, 'mapel_id' => $datanya->id_mapel])); ?>">Lihat
                  Nilai <?php echo e($datanya->mata_pelajaran->nama_mapel); ?></a></li>
              <li class="breadcrumb-item active">Ubah Data <?php echo e($datanya->rapot->kelas_siswa->siswa->nama_siswa); ?></li>
            </ol>
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
                <h3 class="card-title">Ubah Data <b><?php echo e($datanya->rapot->kelas_siswa->siswa->nama_siswa); ?></b></h3>
              </div>
              <!-- form start -->
              <form
                action="<?php echo e(route('rapot.NilaiMapelUpdate', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester, 'mapel_id' => $datanya->id_mapel, 'id_nilai_mapel' => $datanya->id_nilai_mapel])); ?>"
                method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Nomor Induk Siswa Nasional (NISN)</label>
                          <input type="text" name="nisn" class="form-control"
                            placeholder="Nomor Identitas Pegawai Negeri Sipil (NIP)"
                            value="<?php echo e(old('nisn', $datanya->rapot->kelas_siswa->siswa->nisn)); ?>" readonly required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Nama Siswa</label>
                          <input type="text" name="nama_siswa" class="form-control"placeholder="Nama Guru"
                            value="<?php echo e(old('nama_siswa', $datanya->rapot->kelas_siswa->siswa->nama_siswa)); ?>" readonly
                            required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div
                        <?php echo e(($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap') ? 'class=col-sm-3' : 'class=col-sm-4'); ?>>
                        <div class="form-group">
                          <label>KKM</label>
                          <input type="number" name="kkm" class="form-control"
                            value="<?php echo e($datanya->mata_pelajaran->nilai_kkm); ?>" readonly>
                        </div>
                      </div>
                      <div
                        <?php echo e(($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap') ? 'class=col-sm-3' : 'class=col-sm-4'); ?>>
                        <div class="form-group">
                          <label>Nilai Pengetahuan</label>
                          <input type="number" name="nilai_pengetahuan" id="nilai_pengetahuan" class="form-control"
                            placeholder="00" value="<?php echo e(old('nilai_pengetahuan', $datanya->nilai_pengetahuan)); ?>"
                            required>
                        </div>
                      </div>
                      <div
                        <?php echo e(($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap') ? 'class=col-sm-3' : 'class=col-sm-4'); ?>>
                        <div class="form-group">
                          <label>Predikat Pengetahuan</label>
                          <input type="text" name="predikat_pengetahuan" id="predikat_pengetahuan" class="form-control"
                            value="<?php echo e(old('predikat_pengetahuan', $datanya->predikat_pengetahuan)); ?>" readonly required>
                        </div>
                      </div>
                      <?php if($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap'): ?>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Deskripsi Pengetahuan</label>
                            <textarea name="deskripsi_pengetahuan" class="form-control" rows="3" placeholder="Deskripsi Pengetahuan" required><?php echo e(old('deskripsi_pengetahuan', $datanya->deskripsi_pengetahuan)); ?></textarea>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="row">
                      <div
                        <?php echo e(($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap') ? 'class=col-sm-3' : 'class=col-sm-4'); ?>>
                        <div class="form-group">
                          <label>KKM</label>
                          <input type="number" name="kkm" class="form-control"
                            value="<?php echo e($datanya->mata_pelajaran->nilai_kkm); ?>" readonly>
                        </div>
                      </div>
                      <div
                        <?php echo e(($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap') ? 'class=col-sm-3' : 'class=col-sm-4'); ?>>
                        <div class="form-group">
                          <label>Nilai Keterampilan</label>
                          <input type="number" name="nilai_keterampilan" id="nilai_keterampilan" class="form-control"
                            placeholder="00" value="<?php echo e(old('nilai_keterampilan', $datanya->nilai_keterampilan)); ?>"
                            required>
                        </div>
                      </div>
                      <div
                        <?php echo e(($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap') ? 'class=col-sm-3' : 'class=col-sm-4'); ?>>
                        <div class="form-group">
                          <label>Predikat Keterampilan</label>
                          <input type="text" name="predikat_keterampilan" id="predikat_keterampilan"
                            class="form-control"
                            value="<?php echo e(old('predikat_keterampilan', $datanya->predikat_keterampilan)); ?>" readonly
                            required>
                        </div>
                      </div>
                      <?php if($datanya->rapot->semester == 'Semester Ganjil' or $datanya->rapot->semester == 'Semester Genap'): ?>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Deskripsi Keterampilan</label>
                            <textarea name="deskripsi_keterampilan" class="form-control" rows="3" placeholder="Deskripsi Keterampilan"><?php echo e(old('deskripsi_keterampilan', $datanya->deskripsi_keterampilan)); ?></textarea>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a class="btn btn-success"
                    href="<?php echo e(route('rapot.NilaiMapel', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester, 'mapel_id' => $datanya->id_mapel])); ?>">
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
    <script>
      $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });

        $('#nilai_pengetahuan').on('change', function() {
          let nilai_pengetahuan = $('#nilai_pengetahuan').val()
          if (nilai_pengetahuan >= 92) {
            //Tampilkan predikat pengetahuan
            $('#predikat_pengetahuan').val('A');
          } else if (nilai_pengetahuan >= 83) {
            $('#predikat_pengetahuan').val('B');
          } else if (nilai_pengetahuan >= 75) {
            $('#predikat_pengetahuan').val('C');
          } else if (nilai_pengetahuan >= 0) {
            $('#predikat_pengetahuan').val('D');
          }
        });
        //Jquery Jika Mengisi Angka keterampilan, Tampilkan Predikat keterampilan
        $('#nilai_keterampilan').on('change', function() {
          let nilai_keterampilan = $('#nilai_keterampilan').val()
          if (nilai_keterampilan >= 92) {
            //Tampilkan predikat keterampilan
            $('#predikat_keterampilan').val('A');
          } else if (nilai_keterampilan >= 83) {
            $('#predikat_keterampilan').val('B');
          } else if (nilai_keterampilan >= 75) {
            $('#predikat_keterampilan').val('C');
          } else if (nilai_keterampilan >= 0) {
            $('#predikat_keterampilan').val('D');
          }
        });
      });
    </script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/nilai-mapel-form-edit.blade.php ENDPATH**/ ?>