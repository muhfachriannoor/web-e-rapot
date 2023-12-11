<?php $Carbon = app('Illuminate\Support\Carbon'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Cetak Rapot <?php echo e($semester); ?> Nama <?php echo e($dataRapot->kelas_siswa->siswa->nama_siswa); ?></title>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/adminlte.min.css')); ?>">
  <style>
    @media  print {
      .warna-coklat tr th {
        background-color: #c4d79b !important;
      }
    }

    body {
      font-family: 'Times New Roman' !important;
      font-size: 11pt;
    }

    .warna-coklat tr th {
      background-color: #c4d79b !important;
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
    <p class="font-weight-bold judul text-center"><b>PENCAPAIAN KOMPETENSI SISWA</b></p>
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
    <p class="font-weight-bold judul-poin"><b>A. SIKAP</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <ol>
            <li class="font-weight-bold judul-poin mb-1">Sikap Spiritual</li>
            <table class="table table-bordered" style="width: 90%">
              <thead class="text-center warna-coklat">
                <tr>
                  <th width="2%"class="align-middle">Predikat</th>
                  <th width="30%"class="align-middle">Deskripsi
                  </th>
                </tr>
              </thead>
              <tbody class="text-center align-middle">
                <tr>
                  <td><?php echo e($dataSikap->predikat_spiritual); ?></td>
                  <td class="text-left"><?php echo e($dataSikap->deskripsi_spiritual); ?></td>
                </tr>
              </tbody>
            </table>
            <li class="font-weight-bold judul-poin mb-1">Sikap Sosial</li>
            <table class="table table-bordered" style="width: 90%">
              <thead class="text-center warna-coklat">
                <tr>
                  <th width="2%"class="align-middle">Predikat</th>
                  <th width="30%"class="align-middle">Deskripsi
                  </th>
                </tr>
              </thead>
              <tbody class="text-center align-middle">
                <tr>
                  <td><?php echo e($dataSikap->predikat_sosial); ?></td>
                  <td class="text-left"><?php echo e($dataSikap->deskripsi_sosial); ?></td>
                </tr>
              </tbody>
            </table>
          </ol>
        </div>
      </div>
    </div>
    <p class="font-weight-bold judul-poin"><b>B. PENGETAHUAN DAN KETERAMPILAN</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered">
            <thead class="text-center warna-coklat">
              <tr>
                <th width="2%" rowspan="2" class="align-middle">No</th>
                <th width="30%" rowspan="2" class="align-middle">Mata Pelajaran</th>
                <th width="15%" colspan="4" class="align-middle">Pengetahuan</th>
              </tr>
              <tr>
                <th width="6%" class="align-middle">KKM</th>
                <th width="6%" class="align-middle">Nilai</th>
                <th width="6%" class="align-middle">Predikat</th>
                <th width="20%" class="align-middle">Deskripsi</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok A</td>
              </tr>
              <?php $__currentLoopData = $dataNilaiMapelKelompokA; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $value1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                  <td class="text-left align-middle"><?php echo e($value1->mata_pelajaran->nama_mapel); ?></td>
                  <td class="align-middle"><b><?php echo e($value1->mata_pelajaran->nilai_kkm); ?></b></td>
                  <td class="align-middle"><?php echo e($value1->nilai_pengetahuan); ?></td>
                  <td class="align-middle"><?php echo e($value1->predikat_pengetahuan); ?></td>
                  <td class="text-left align-middle"><?php echo e($value1->deskripsi_pengetahuan); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok B</td>
              </tr>
              <?php $__currentLoopData = $dataNilaiMapelKelompokB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                  <td class="text-left align-middle"><?php echo e($value2->mata_pelajaran->nama_mapel); ?></td>
                  <td class="align-middle"><b><?php echo e($value2->mata_pelajaran->nilai_kkm); ?></b></td>
                  <td class="align-middle"><?php echo e($value2->nilai_pengetahuan); ?></td>
                  <td class="align-middle"><?php echo e($value2->predikat_pengetahuan); ?></td>
                  <td class="text-left align-middle"><?php echo e($value2->deskripsi_pengetahuan); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <table class="table table-bordered">
            <thead class="text-center warna-coklat">
              <tr>
                <th width="2%" rowspan="2" class="align-middle">No</th>
                <th width="30%" rowspan="2" class="align-middle">Mata Pelajaran</th>
                <th width="15%" colspan="4" class="align-middle">Keterampilan</th>
              </tr>
              <tr>
                <th width="6%" class="align-middle">KKM</th>
                <th width="6%" class="align-middle">Nilai</th>
                <th width="6%" class="align-middle">Predikat</th>
                <th width="20%" class="align-middle">Deskripsi</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok A</td>
              </tr>
              <?php $__currentLoopData = $dataNilaiMapelKelompokA; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $value3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                  <td class="text-left align-middle"><?php echo e($value3->mata_pelajaran->nama_mapel); ?></td>
                  <td class="align-middle"><b><?php echo e($value3->mata_pelajaran->nilai_kkm); ?></b></td>
                  <td class="align-middle"><?php echo e($value3->nilai_keterampilan); ?></td>
                  <td class="align-middle"><?php echo e($value3->predikat_keterampilan); ?></td>
                  <td class="text-left align-middle"><?php echo e($value3->deskripsi_keterampilan); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok B</td>
              </tr>
              <?php $__currentLoopData = $dataNilaiMapelKelompokB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key4 => $value4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                  <td class="text-left align-middle"><?php echo e($value4->mata_pelajaran->nama_mapel); ?></td>
                  <td class="align-middle"><b><?php echo e($value4->mata_pelajaran->nilai_kkm); ?></b></td>
                  <td class="align-middle"><?php echo e($value4->nilai_keterampilan); ?></td>
                  <td class="align-middle"><?php echo e($value4->predikat_keterampilan); ?></td>
                  <td class="text-left align-middle"><?php echo e($value4->deskripsi_keterampilan); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <p class="font-weight-bold judul-poin mt-3"><b>C. EKSTRAKURIKULER</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered">
            <thead class="text-center warna-coklat">
              <tr>
                <th width="2%" class="align-middle">No</th>
                <th class="align-middle">Kegiatan Ekstrakurikuler</th>
                <th class="align-middle">Keterangan</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $__currentLoopData = $dataEkstrakurikuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataEkstrakurikuler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                  <td class="text-left align-middle"><?php echo e($dataEkstrakurikuler->kegiatan_ekstrakurikuler); ?></td>
                  <td class="text-left align-middle"><?php echo e($dataEkstrakurikuler->keterangan_ekstrakurikuler); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <p class="font-weight-bold judul-poin">D. KETIDAKHADIRAN</p>
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
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered" style="width: 70%">
            <tbody class="warna-coklat">
              <tr>
                <td colspan="2" class="text-justify align-middle">
                  Keputusan :<br>
                  Berdasarkan pencapaian kompetensi pada semester ke - 1 dan ke - 2, peserta didik ditetapkan *):
                </td>
              </tr>
              <?php if($dataRapot->kelas_siswa->wali_kelas->kelas->tingkat_kelas->tingkat_kelas == 'Kelas IX (9)'): ?>
                <?php if($dataRapot->keputusan_kelas == 'Lulus'): ?>
                  <tr>
                    <td colspan="2" class="text-justify align-middle"><?php echo e($dataRapot->keputusan_kelas); ?> </td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-justify align-middle"><s>Tidak Lulus</s></td>
                  </tr>
                <?php else: ?>
                  <tr>
                    <td colspan="2" class="text-justify align-middle"><s>Lulus</s></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-justify align-middle"><?php echo e($dataRapot->keputusan_kelas); ?></td>
                  </tr>
                <?php endif; ?>
              <?php else: ?>
                <?php if($dataRapot->keputusan_kelas == 'Naik Kelas'): ?>
                  <tr>
                    <td class="text-justify align-middle">
                      <?php echo e($dataRapot->keputusan_kelas); ?>

                    </td>
                    <td class="text-justify align-middle">
                      <?php echo e($dataRapot->keputusan_tingkat_kelas); ?>

                    </td>
                  </tr>
                  <tr>
                    <td class="text-justify align-middle">
                      <s>Tinggal di kelas</s>
                    </td>
                    <td class="text-justify align-middle"></td>
                  </tr>
                <?php else: ?>
                  <tr>
                    <td class="text-justify align-middle">
                      <s>Naik Kelas</s>
                    </td>
                    <td class="text-justify align-middle"></td>
                  </tr>
                  <tr>
                    <td class="text-justify align-middle">
                      Tinggal di kelas
                    </td>
                    <td class="text-justify align-middle"><?php echo e($dataRapot->keputusan_tingkat_kelas); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row justify-content-around mt-4">
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
    <div class="page-break"></div>
    <p class="font-weight-bold judul-poin mt-3"><b>E. PRESTASI</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered">
            <thead class="text-center warna-coklat">
              <tr>
                <th width="2%" class="align-middle">No</th>
                <th class="align-middle">Jenis Prestasi</th>
                <th class="align-middle">Keterangan</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $__currentLoopData = $dataPrestasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dataPrestasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                  <td class="text-left align-middle"><?php echo e($dataPrestasi->jenis_prestasi); ?></td>
                  <td class="text-left align-middle"><?php echo e($dataPrestasi->keterangan_prestasi); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <p class="font-weight-bold judul-poin mt-3"><b>F. CATATAN WALI KELAS</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered">
            <tbody class="text-center">
              <tr>
                <td class="align-middle font-weight-bold font-italic" style="height: 150px;">
                  <h3><?php echo e($dataRapot->catatan_walikelas); ?></h3>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <p class="font-weight-bold judul-poin mt-3"><b>G. TANGGAPAN ORANG TUA/WALI</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered">
            <tbody class="text-center">
              <tr>
                <td class="align-middle font-weight-bold font-italic" style="height: 150px;">
                  <h3><?php echo e($dataRapot->tanggapan_orangtua_wali); ?></h3>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
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
<?php /**PATH C:\xampp\htdocs\e-rapot\resources\views/admin/rapot/semester/cetak-semester-genap.blade.php ENDPATH**/ ?>