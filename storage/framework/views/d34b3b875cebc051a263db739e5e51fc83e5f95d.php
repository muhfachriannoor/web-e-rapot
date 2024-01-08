
<?php $__env->startSection('cssfile'); ?>
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?php echo e(asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Informasi Sekolah</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Informasi Sekolah</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">Data Informasi Sekolah</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-responsive">
                    <tbody>
                      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td width="20%">Nama Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->nama_sekolah); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">NPSN</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->npsn); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">NSS</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->nss); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">NDS</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->nds); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Alamat Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->alamat_sekolah); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kelurahan</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->kelurahan); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kecamatan</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->kecamatan); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kota/Kabupaten</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->kota_kabupaten); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Provinsi</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->provinsi); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Link Website</td>
                          <td width="1%" align="center">:</td>
                          <td><b><a href="<?php echo e($value->link_website); ?>" target="_blank"><?php echo e($value->link_website); ?></a></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Email Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->email_sekolah); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kode Pos</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->kode_pos); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Nomor Telpon Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b><?php echo e($value->no_telp_sekolah); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3">
                            <a class="btn btn-primary" href="<?php echo e(route('informasi-sekolah.edit', $value->id)); ?>"> Ubah
                              Data</a>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/informasi-sekolah/index.blade.php ENDPATH**/ ?>