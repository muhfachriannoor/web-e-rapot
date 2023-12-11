@inject('Carbon', 'Illuminate\Support\Carbon')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Cetak Rapot {{ $semester }} Nama {{ $dataRapot->kelas_siswa->siswa->nama_siswa }}</title>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <style>
    @media print {
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
              <td>{{ $dataRapot->kelas_siswa->wali_kelas->kelas->nama_kelas }}</td>
            </tr>
            <tr>
              <td width="20%">Nama</td>
              <td width="1%">:</td>
              <td>{{ $dataRapot->kelas_siswa->siswa->nama_siswa }}</td>
              <td width="20%">Semester</td>
              <td width="1%">:</td>
              <td>{{ $semester }}</td>
            </tr>
            <tr>
              <td width="20%">Nomor Induk</td>
              <td width="1%">:</td>
              <td>{{ $dataRapot->kelas_siswa->siswa->nisn }}</td>
              <td width="20%">Tahun Pelajaran</td>
              <td width="1%">:</td>
              <td>{{ $dataRapot->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran }}</td>
            </tr>
          </tbody>
        </table>
        <hr>
      </div>
    </div>
    <p class="font-weight-bold judul-poin"><b>A. PENGETAHUAN DAN KETERAMPILAN</b></p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered warna-coklat">
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
            <tbody class="text-center">
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok A</td>
              </tr>
              @foreach ($dataNilaiMapelKelompokA as $key1 => $dataNilaiMapelKelompokA)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle"">{{ $dataNilaiMapelKelompokA->mata_pelajaran->nama_mapel }}</td>
                  <td class="align-middle"><b>{{ $dataNilaiMapelKelompokA->mata_pelajaran->nilai_kkm }}</b></td>
                  <td class="align-middle">
                    {{ $dataNilaiMapelKelompokA->nilai_pengetahuan }}
                  </td>
                  <td class="align-middle">{{ $dataNilaiMapelKelompokA->predikat_pengetahuan }}</td>
                  <td class="align-middle">
                    {{ $dataNilaiMapelKelompokA->nilai_keterampilan }}
                  </td>
                  <td class="align-middle">{{ $dataNilaiMapelKelompokA->predikat_keterampilan }}</td>
                </tr>
              @endforeach
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok B</td>
              </tr>
              @foreach ($dataNilaiMapelKelompokB as $key1 => $dataNilaiMapelKelompokB)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle">{{ $dataNilaiMapelKelompokB->mata_pelajaran->nama_mapel }}</td>
                  <td class="align-middle"><b>{{ $dataNilaiMapelKelompokB->mata_pelajaran->nilai_kkm }}</b></td>
                  <td class="align-middle">
                    {{ $dataNilaiMapelKelompokB->nilai_pengetahuan }}
                  </td>
                  <td class="align-middle">{{ $dataNilaiMapelKelompokB->predikat_pengetahuan }}</td>
                  <td class="align-middle">
                    {{ $dataNilaiMapelKelompokB->nilai_keterampilan }}
                  </td>
                  <td class="align-middle">{{ $dataNilaiMapelKelompokB->predikat_keterampilan }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <p class="font-weight-bold judul-poin mt-1">B. KETIDAKHADIRAN</p>
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <table class="table table-bordered" style="width: 30%">
            <tbody>
              <tr>
                <td class="align-middle" width="50%">Sakit</td>
                <td class="align-middle" width="1%">:</td>
                <td class="text-center align-middle">{{ $dataRapot->sakit }} hari</td>
              </tr>
              <tr>
                <td class="align-middle" width="50%">Izin</td>
                <td class="align-middle" width="1%">:</td>
                <td class="text-center align-middle">{{ $dataRapot->izin }} hari</td>
              </tr>
              <tr>
                <td class="align-middle" width="50%">Tanpa Keterangan</td>
                <td class="align-middle" width="1%">:</td>
                <td class="text-center align-middle">{{ $dataRapot->tanpa_keterangan }} hari</td>
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
        <p>Samarinda, {{ $Carbon::now()->isoFormat('D MMMM Y') }}<br>Wali Kelas</p><br><br><br><br>
        <p>{{ $dataRapot->kelas_siswa->wali_kelas->guru->nama_guru }}
          <br>NIP. {{ $dataRapot->kelas_siswa->wali_kelas->guru->nip }}
        </p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-3">
        <p>Mengetahui,<br>Kepala Sekolah</p><br><br><br><br>
        <p>{{ $dataKepalaSekolah->nama_guru }}
          <br>NIP. {{ $dataKepalaSekolah->nip }}
        </p>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
  <script>
    window.print();
  </script>
</body>

</html>
