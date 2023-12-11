
<?php $__env->startSection('content'); ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rapot <b>Tahun Ajaran <?php echo e($dataTitle->tahun_ajaran->tahun_ajaran); ?></b></h1>
          <h1>Kelas <b><?php echo e($dataTitle->kelas->nama_kelas); ?></b></h1>
          <h1>Rapot <b><?php echo e($semester); ?></b></h1>
          <h1>Input Keputusan Naik/Tidak Naik</h1>
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
            <li class="breadcrumb-item active">Input Keputusan Naik/Tidak Naik</li>
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
              <h3 class="card-title">Input Keputusan Naik/Tidak Naik</h3>
            </div>
            <!-- form start -->
            <form
              action="<?php echo e(route('rapot.KeputusanNaikTidakNaikStore', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester])); ?>"
              method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="card-body">
                <div class="form-group">
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="2%" style="text-align: center; vertical-align: middle;">No</th>
                      <th width="50%" style="text-align: center; vertical-align: middle;">Nama Siswa
                      </th>
                      <th style="text-align: center; vertical-align: middle;">Keputusan
                      </th>
                      <th style="text-align: center; vertical-align: middle;">Tingkat Kelas</th>
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
                        <td style="text-align: center; vertical-align: middle;">
                          <select name="keputusan_kelas[<?php echo e($key); ?>]" id="keputusan_kelas<?php echo e($key); ?>"
                            class="form-control select2" required style="width: 100%;">
                            <option value="" selected disabled>-- PILIH KEPUTUSAN --</option>
                            <option value="Naik Kelas">Naik Kelas</option>
                            <option value="Tidak Naik Kelas">Tidak Naik Kelas</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" name="tingkat_kelas[<?php echo e($key); ?>]"
                            id="tingkat_kelas<?php echo e($key); ?>" class="form-control text-center" rows="3"
                            placeholder="" value="<?php echo e(old("tingkat_kelas.{$key}", '')); ?>" readonly required>
                        </td>
                        <input type="hidden" name="tingkat_kelas_id[<?php echo e($key); ?>]"
                          value="<?php echo e($value->kelas_siswa->wali_kelas->kelas->tingkat_kelas_id); ?>"
                          id="tingkat_kelas_id<?php echo e($key); ?>" required>
                        <input type="hidden" name="rapot_id[<?php echo e($key); ?>]" value="<?php echo e($value->id_rapot); ?>"
                          required>
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
  <!-- Select2 -->
  <script src="<?php echo e(asset('admin/plugins/select2/js/select2.full.min.js')); ?>"></script>
  <script>
    $(function() {
      $('.select2').select2();

      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        //AJAX Keputusan Kelas
        $('#keputusan_kelas<?php echo e($key2); ?>').on('change', function() {
          let keputusan_kelas = $('select[name="keputusan_kelas[<?php echo e($key2); ?>]"]').val()
          let tingkat_kelas_id = $('#tingkat_kelas_id<?php echo e($key2); ?>').val()
          var url = "<?php echo e(url('/dashboard/rapot/ajax/keputusan-kelas/')); ?>/" + keputusan_kelas + "/" +
            tingkat_kelas_id
          $.ajax({
              url: url,
              method: "GET",
            })
            .done(function(result) {
              $('#tingkat_kelas<?php echo e($key2); ?>').val(result);
            });
        });
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/keputusan-naiktidaknaik-form-add.blade.php ENDPATH**/ ?>