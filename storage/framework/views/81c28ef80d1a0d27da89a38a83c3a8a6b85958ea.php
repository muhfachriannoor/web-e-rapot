<?php $Carbon = app('Illuminate\Support\Carbon'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Cetak Rapot <?php echo e($semester); ?> Nama <?php echo e($dataRapot->kelas_siswa->siswa->nama_siswa); ?></title>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/adminlte.min.css')); ?>">
  <style>
    body {
      font-family: 'Times New Roman' !important;
      font-size: 11pt;
    }

    .judul {
      font-size: 14pt;
    }

    .judul-poin {
      font-size: 11pt;
    }

    .page-break {
      page-break-after: always;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <p class="font-weight-bold judul text-center"><b>PENCAPAIAN KOMPETENSI PESERTA DIDIK TENGAH SEMESTER</b></p>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td width="20%">Nama Sekolah</td>
              <td width="1%">:</td>
              <td>SMP Muhammadiyah 1 Samarinda</td>
              <td width="20%">Kelas</td>
              <td width="1%">:</td>
              <td><?php echo e($dataRapot->kelas_siswa->wali_kelas->kelas->nama_kelas); ?></td>
            </tr>
            <tr>
              <td width="20%">Nama</td>
              <td width="1%">:</td>
              <td><?php echo e($dataRapot->kelas_siswa->siswa->nama_siswa); ?></td>
              <td width="20%">Semester</td>
              <td width="1%">:</td>
              <td><?php echo e($semester); ?></td>
            </tr>
            <tr>
              <td width="20%">Nomor Induk</td>
              <td width="1%">:</td>
              <td><?php echo e($dataRapot->kelas_siswa->siswa->nisn); ?></td>
              <td width="20%">Tahun Pelajaran</td>
              <td width="1%">:</td>
              <td><?php echo e($dataRapot->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran); ?></td>
            </tr>
          </tbody>
        </table>
        <hr>
      </div>
    </div>
    <p class="font-weight-bold judul-poin"><b>A. Pengetahuan dan Keterampilan</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered">
            <thead class="text-center">
              <tr>
                <th width="2%" rowspan="2" class="align-middle">No</th>
                <th width="30%" rowspan="2" class="align-middle">Mata Pelajaran
                </th>
                <th width="5%" rowspan="2" class="align-middle">KKM
                </th>
                <th width="15%" colspan="2" class="align-middle">Pengetahuan
                </th>
                <th width="15%" colspan="2" class="align-middle">Keterampilan
                </th>
              </tr>
              <tr>
                <th width="6%" class="align-middle">Angka</th>
                <th width="6%" class="align-middle">Predikat</th>
                <th width="6%" class="align-middle">Angka</th>
                <th width="6%" class="align-middle">Predikat</th>
              </tr>
            </thead>
            <tbody class="text-center align-middle">
              <tr>
                <td class="text-left" colspan="7">Kelompok A</td>
              </tr>
              <?php $__currentLoopData = $dataNilaiMapelKelompokA; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $dataNilaiMapelKelompokA): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td class="text-left"><?php echo e($dataNilaiMapelKelompokA->mata_pelajaran->nama_mapel); ?></td>
                  <td><b><?php echo e($dataNilaiMapelKelompokA->mata_pelajaran->nilai_kkm); ?></b></td>
                  <td style="background-color: #ffc7ce!important;"><?php echo e($dataNilaiMapelKelompokA->nilai_pengetahuan); ?>

                  </td>
                  <td><?php echo e($dataNilaiMapelKelompokA->predikat_pengetahuan); ?></td>
                  <td style="background-color: #ffc7ce!important;"><?php echo e($dataNilaiMapelKelompokA->nilai_keterampilan); ?>

                  </td>
                  <td><?php echo e($dataNilaiMapelKelompokA->predikat_keterampilan); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="text-left" colspan="7">Kelompok B</td>
              </tr>
              <?php $__currentLoopData = $dataNilaiMapelKelompokB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $dataNilaiMapelKelompokB): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td class="text-left"><?php echo e($dataNilaiMapelKelompokB->mata_pelajaran->nama_mapel); ?></td>
                  <td><b><?php echo e($dataNilaiMapelKelompokB->mata_pelajaran->nilai_kkm); ?></b></td>
                  <td style="background-color: #ffc7ce!important;"><?php echo e($dataNilaiMapelKelompokB->nilai_pengetahuan); ?>

                  </td>
                  <td><?php echo e($dataNilaiMapelKelompokB->predikat_pengetahuan); ?></td>
                  <td style="background-color: #ffc7ce!important;"><?php echo e($dataNilaiMapelKelompokB->nilai_keterampilan); ?>

                  </td>
                  <td><?php echo e($dataNilaiMapelKelompokB->predikat_keterampilan); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <p class="font-weight-bold judul-poin">B. Ketidakhadiran</p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered" style="width: 30%">
            <tbody class="align-middle">
              <tr>
                <td width="50%">Sakit</td>
                <td width="1%">:</td>
                <td class="text-center"><?php echo e($dataRapot->sakit); ?> hari</td>
              </tr>
              <tr>
                <td width="50%">Izin</td>
                <td width="1%">:</td>
                <td class="text-center"><?php echo e($dataRapot->izin); ?> hari</td>
              </tr>
              <tr>
                <td width="50%">Tanpa Keterangan</td>
                <td width="1%">:</td>
                <td class="text-center"><?php echo e($dataRapot->tanpa_keterangan); ?> hari</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row justify-content-around">
      <div class="col-3">
        <p>Mengetahui<br>Orang Tua/ Wali</p><br><br><br><br>
        <hr>
      </div>
      <div class="col-3">
        <p>Samarinda, <?php echo e($Carbon::now()->isoFormat('D MMMM Y')); ?><br>Wali Kelas</p><br><br><br><br>
        <p><?php echo e($dataRapot->kelas_siswa->wali_kelas->guru->nama_guru); ?>

          <br>NIP. <?php echo e($dataRapot->kelas_siswa->wali_kelas->guru->nip); ?>

        </p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-3">
        <p>Mengetahui,<br>Kepala Sekolah</p><br><br><br><br>
        <p><?php echo e($dataKepalaSekolah->nama_guru); ?>

          <br>NIP. <?php echo e($dataKepalaSekolah->nip); ?>

        </p>
      </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('admin/dist/js/adminlte.min.js')); ?>"></script>
    <script>
      window.print();
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/semester/cetak-midsemesterganjil.blade.php ENDPATH**/ ?>