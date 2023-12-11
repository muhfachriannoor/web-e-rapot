
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
          <h1>Lihat Sikap dan Spiritual</h1>
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
                href="<?php echo e(route('rapot.Sikap', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester])); ?>">Lihat
                Sikap dan Spiritual</a></li>
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
              action="<?php echo e(route('rapot.SikapUpdate', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester, 'id_sikap' => $datanya->id_sikap])); ?>"
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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Predikat Sikap Spiritual</label>
                        <input type="text" name="predikat_spiritual" class="form-control"
                          placeholder="Predikat Sikap Spiritual"
                          value="<?php echo e(old('predikat_spiritual', $datanya->predikat_spiritual)); ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi Sikap Spiritual</label>
                        <textarea name="deskripsi_spiritual" class="form-control" rows="3" placeholder="Deskripsi Sikap Spiritual"
                          required><?php echo e(old('deskripsi_spiritual', $datanya->deskripsi_spiritual)); ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Predikat Sosial</label>
                        <input type="text" name="predikat_sosial" class="form-control" placeholder="Predikat Sosial"
                          value="<?php echo e(old('predikat_sosial', $datanya->predikat_sosial)); ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi Sosial</label>
                        <textarea name="deskripsi_sosial" class="form-control" rows="3" placeholder="Deskripsi Sosial" required><?php echo e(old('deskripsi_sosial', $datanya->deskripsi_sosial)); ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="<?php echo e(route('rapot.Sikap', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester])); ?>">
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

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/sikap/sikap-form-edit.blade.php ENDPATH**/ ?>