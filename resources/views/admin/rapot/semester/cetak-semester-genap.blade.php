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
                  <td>{{ $dataSikap->predikat_spiritual }}</td>
                  <td class="text-left">{{ $dataSikap->deskripsi_spiritual }}</td>
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
                  <td>{{ $dataSikap->predikat_sosial }}</td>
                  <td class="text-left">{{ $dataSikap->deskripsi_sosial }}</td>
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
              @foreach ($dataNilaiMapelKelompokA as $key1 => $value1)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle">{{ $value1->mata_pelajaran->nama_mapel }}</td>
                  <td class="align-middle"><b>{{ $value1->mata_pelajaran->nilai_kkm }}</b></td>
                  <td class="align-middle">{{ $value1->nilai_pengetahuan }}</td>
                  <td class="align-middle">{{ $value1->predikat_pengetahuan }}</td>
                  <td class="text-left align-middle">{{ $value1->deskripsi_pengetahuan }}</td>
                </tr>
              @endforeach
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok B</td>
              </tr>
              @foreach ($dataNilaiMapelKelompokB as $key2 => $value2)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle">{{ $value2->mata_pelajaran->nama_mapel }}</td>
                  <td class="align-middle"><b>{{ $value2->mata_pelajaran->nilai_kkm }}</b></td>
                  <td class="align-middle">{{ $value2->nilai_pengetahuan }}</td>
                  <td class="align-middle">{{ $value2->predikat_pengetahuan }}</td>
                  <td class="text-left align-middle">{{ $value2->deskripsi_pengetahuan }}</td>
                </tr>
              @endforeach
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
              @foreach ($dataNilaiMapelKelompokA as $key3 => $value3)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle">{{ $value3->mata_pelajaran->nama_mapel }}</td>
                  <td class="align-middle"><b>{{ $value3->mata_pelajaran->nilai_kkm }}</b></td>
                  <td class="align-middle">{{ $value3->nilai_keterampilan }}</td>
                  <td class="align-middle">{{ $value3->predikat_keterampilan }}</td>
                  <td class="text-left align-middle">{{ $value3->deskripsi_keterampilan }}</td>
                </tr>
              @endforeach
              <tr>
                <td class="text-left align-middle" colspan="7">Kelompok B</td>
              </tr>
              @foreach ($dataNilaiMapelKelompokB as $key4 => $value4)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle">{{ $value4->mata_pelajaran->nama_mapel }}</td>
                  <td class="align-middle"><b>{{ $value4->mata_pelajaran->nilai_kkm }}</b></td>
                  <td class="align-middle">{{ $value4->nilai_keterampilan }}</td>
                  <td class="align-middle">{{ $value4->predikat_keterampilan }}</td>
                  <td class="text-left align-middle">{{ $value4->deskripsi_keterampilan }}</td>
                </tr>
              @endforeach
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
              @foreach ($dataEkstrakurikuler as $key => $dataEkstrakurikuler)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle">{{ $dataEkstrakurikuler->kegiatan_ekstrakurikuler }}</td>
                  <td class="text-left align-middle">{{ $dataEkstrakurikuler->keterangan_ekstrakurikuler }}</td>
                </tr>
              @endforeach
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
                <td class="text-center">{{ $dataRapot->sakit }} hari</td>
              </tr>
              <tr>
                <td width="50%">Izin</td>
                <td width="1%">:</td>
                <td class="text-center">{{ $dataRapot->izin }} hari</td>
              </tr>
              <tr>
                <td width="50%">Tanpa Keterangan</td>
                <td width="1%">:</td>
                <td class="text-center">{{ $dataRapot->tanpa_keterangan }} hari</td>
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
              @if ($dataRapot->kelas_siswa->wali_kelas->kelas->tingkat_kelas->tingkat_kelas == 'Kelas IX (9)')
                @if ($dataRapot->keputusan_kelas == 'Lulus')
                  <tr>
                    <td colspan="2" class="text-justify align-middle">{{ $dataRapot->keputusan_kelas }} </td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-justify align-middle"><s>Tidak Lulus</s></td>
                  </tr>
                @else
                  <tr>
                    <td colspan="2" class="text-justify align-middle"><s>Lulus</s></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-justify align-middle">{{ $dataRapot->keputusan_kelas }}</td>
                  </tr>
                @endif
              @else
                @if ($dataRapot->keputusan_kelas == 'Naik Kelas')
                  <tr>
                    <td class="text-justify align-middle">
                      {{ $dataRapot->keputusan_kelas }}
                    </td>
                    <td class="text-justify align-middle">
                      {{ $dataRapot->keputusan_tingkat_kelas }}
                    </td>
                  </tr>
                  <tr>
                    <td class="text-justify align-middle">
                      <s>Tinggal di kelas</s>
                    </td>
                    <td class="text-justify align-middle"></td>
                  </tr>
                @else
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
                    <td class="text-justify align-middle">{{ $dataRapot->keputusan_tingkat_kelas }}</td>
                  </tr>
                @endif
              @endif
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
              @foreach ($dataPrestasi as $key => $dataPrestasi)
                <tr>
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="text-left align-middle">{{ $dataPrestasi->jenis_prestasi }}</td>
                  <td class="text-left align-middle">{{ $dataPrestasi->keterangan_prestasi }}</td>
                </tr>
              @endforeach
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
                  <h3>{{ $dataRapot->catatan_walikelas }}</h3>
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
                  <h3>{{ $dataRapot->tanggapan_orangtua_wali }}</h3>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
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
