
<?php $__env->startSection('content'); ?>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <?php if(auth()->user()->level == 1 or auth()->user()->level == 2): ?>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo e($hitung_tahunAjaran); ?></h3>
                <p>Data Tahun Ajaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo e(route('tahun-ajaran.index')); ?>" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo e($hitung_kelas); ?></h3>
                <p>Data Kelas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo e(route('kelas.index')); ?>" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo e($hitung_mataPelajaran); ?></h3>
                <p>Data Mata Pelajaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo e(route('mata-pelajaran.index')); ?>" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" style="background-color:#34495e!important">
              <div class="inner">
                <h3><?php echo e($hitung_guru); ?></h3>
                <p>Data Guru</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo e(route('guru.index')); ?>" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" style="background-color:#d35400!important">
              <div class="inner">
                <h3><?php echo e($hitung_waliKelas); ?></h3>
                <p>Data Wali Kelas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo e(route('wali-kelas.index')); ?>" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger" style="background-color: #7f8c8d!important">
              <div class="inner">
                <h3><?php echo e($hitung_siswa); ?></h3>
                <p>Data Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo e(route('siswa.index')); ?>" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo e($hitung_dataakun); ?></h3>
                <p>Data Akun</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo e(route('data-akun.index')); ?>" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/templatedashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>