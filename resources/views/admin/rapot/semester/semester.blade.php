@extends('layouts/templatedashboard')
@section('cssfile')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rapot <b>Tahun Ajaran {{ $dataTitle->tahun_ajaran->tahun_ajaran }}</b></h1>
          <h1>Kelas <b>{{ $dataTitle->kelas->nama_kelas }}</b></h1>
          <h1>Rapot <b>{{ $semester }}</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rapot.TahunAjaran') }}">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Kelas', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id]) }}">Tahun
                Ajaran
                {{ $dataTitle->tahun_ajaran->tahun_ajaran }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Siswa', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id]) }}">{{ $dataTitle->kelas->nama_kelas }}</a>
            </li>
            <li class="breadcrumb-item active">Rapot {{ $semester }}</li>
          </ol>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12 mt-3">
          <div class="row">
            <div class="float-left">
              @php use App\Models\NilaiMapel;@endphp
              @foreach ($dataMapel as $key => $dataMapel)
                @if (
                    $cekNilaiMapel =
                        App\Models\Rapot::cekNilaiMapel(
                            $dataTitle->tahun_ajaran_id,
                            $dataTitle->kelas_id,
                            $semester,
                            $dataMapel->mapel_id) != false)
                  <a class="btn btn-success mb-1"
                    href="{{ route('rapot.NilaiMapelCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester, 'mapel_id' => $dataMapel->mata_pelajaran->id]) }}">Input
                    Nilai
                    {{ $dataMapel->mata_pelajaran->nama_mapel }}</a>
                @else
                  <a class="btn btn-info mb-1"
                    href="{{ route('rapot.NilaiMapel', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester, 'mapel_id' => $dataMapel->mata_pelajaran->id]) }}">Lihat
                    Nilai
                    {{ $dataMapel->mata_pelajaran->nama_mapel }}</a>
                @endif
              @endforeach
            </div>
          </div>
          <div class="row">
            <div class="float-left">
              @if ($semester == 'Semester Ganjil')
                @if ($cekSikapdanSpiritual != false)
                  <a class="btn btn-warning"
                    href="{{ route('rapot.SikapCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}"
                    style="color:#fff">Input Sikap dan Spiritual</a>
                @else
                  <a class="btn btn-warning"
                    href="{{ route('rapot.Sikap', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}"
                    style="color:#fff">Lihat Sikap dan Spiritual</a>
                @endif
                @if ($cekEkstrakurikuler != false)
                  <a class="btn btn-danger"
                    href="{{ route('rapot.EkstrakurikulerCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Input
                    Ekstrakurikuler</a>
                @else
                  <a class="btn btn-danger"
                    href="{{ route('rapot.Ekstrakurikuler', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Lihat
                    Ekstrakurikuler</a>
                @endif
              @elseif($semester == 'Semester Genap')
                <a class="btn btn-primary"
                  href="{{ route('rapot.Prestasi', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Lihat
                  Data Prestasi</a>
                @if ($cekSikapdanSpiritual != false)
                  <a class="btn btn-warning"
                    href="{{ route('rapot.SikapCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}"
                    style="color:#fff">Input Sikap dan Spiritual</a>
                @else
                  <a class="btn btn-warning"
                    href="{{ route('rapot.Sikap', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}"
                    style="color:#fff">Lihat Sikap dan Spiritual</a>
                @endif
                @if ($cekEkstrakurikuler != false)
                  <a class="btn btn-danger"
                    href="{{ route('rapot.EkstrakurikulerCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Input
                    Ekstrakurikuler</a>
                @else
                  <a class="btn btn-danger"
                    href="{{ route('rapot.Ekstrakurikuler', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Lihat
                    Ekstrakurikuler</a>
                @endif
              @endif
              @php $tingkat_kelas = $dataTitle->kelas->tingkat_kelas->tingkat_kelas; @endphp
              @if ($semester == 'Semester Genap' and $tingkat_kelas == 'Kelas VII (7)' or $tingkat_kelas == 'Kelas VIII (8)')
                @if ($cekKeputusanKelas != false)
                  <a class="btn btn-info"
                    href="{{ route('rapot.KeputusanNaikTidakNaikCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Input
                    Keputusan Naik/Tidak Naik</a>
                @else
                  <a class="btn btn-info"
                    href="{{ route('rapot.KeputusanNaikTidakNaik', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Lihat
                    Keputusan Naik/Tidak Naik</a>
                @endif
              @endif
              @if ($semester == 'Semester Genap' and $tingkat_kelas == 'Kelas IX (9)')
                @if ($cekKeputusanKelas != false)
                  <a class="btn btn-info"
                    href="{{ route('rapot.KeputusanLulusTidakLulusCreate', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Input
                    Keputusan Lulus/Tidak Lulus</a>
                @else
                  <a class="btn btn-info"
                    href="{{ route('rapot.KeputusanLulusTidakLulus', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Lihat
                    Keputusan Lulus/Tidak Lulus</a>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr style="text-align: center; vertical-align: middle;">
                    <th width="1%" style="text-align: center; vertical-align: middle;">No</th>
                    <th width="10%" style="text-align: center; vertical-align: middle;">Foto Siswa</th>
                    <th width="10%" style="text-align: center; vertical-align: middle;">NISN</th>
                    <th width="15%" style="text-align: center; vertical-align: middle;">Nama Siswa</th>
                    <th width="9%" style="text-align: center; vertical-align: middle;">Jumlah Sakit</th>
                    <th width="9%" style="text-align: center; vertical-align: middle;">Jumlah Izin</th>
                    <th width="9%" style="text-align: center; vertical-align: middle;">Jumlah Tanpa Keterangan</th>
                    <th style="text-align: center; vertical-align: middle;">Catatan Wali Kelas</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggapan Orang Tua/Wali</th>
                    <th width="13%" style="text-align: center; vertical-align: middle;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $value)
                    <tr>
                      <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                      <td style="text-align: center; vertical-align: middle;">
                        <a href="{{ url('datafoto_siswa/' . $value->kelas_siswa->siswa->foto_siswa) }}"
                          data-toggle="lightbox" data-title="Foto {{ $value->kelas_siswa->siswa->nama_siswa }}"
                          data-gallery="gallery">
                          <img src="{{ url('datafoto_siswa/' . $value->kelas_siswa->siswa->foto_siswa) }}"
                            class="img-fluid" alt="Foto {{ $value->kelas_siswa->siswa->nama_siswa }}" width="100px"
                            height="50px">
                        </a>
                      </td>
                      <td style="vertical-align: middle;">{{ $value->kelas_siswa->siswa->nisn }}</td>
                      <td style="vertical-align: middle;"><a
                          href="{{ route('siswa.show', $value->kelas_siswa->siswa->id) }}"
                          target="_blank">{{ $value->kelas_siswa->siswa->nama_siswa }}</a>
                      </td>
                      <td style="text-align: center; vertical-align: middle;">{{ $value->sakit }} Hari</td>
                      <td style="text-align: center; vertical-align: middle;">{{ $value->izin }} Hari</td>
                      <td style="text-align: center; vertical-align: middle;">{{ $value->tanpa_keterangan }} Hari</td>
                      <td style="vertical-align: middle;">{{ $value->catatan_walikelas }}</td>
                      <td style="vertical-align: middle;">{{ $value->tanggapan_orangtua_wali }}</td>
                      <td style="text-align: center; vertical-align: middle;">
                        <a class="btn btn-primary"
                          href="{{ route('rapot.SemesterEdit', ['tahun_ajaran_id' => $value->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $value->kelas_siswa->wali_kelas->kelas_id, 'semester' => $value->semester, 'id_rapot' => $value->id_rapot]) }}">Ubah
                        </a>
                        <a class="btn btn-info"
                          href="{{ route('rapot.CetakRapot', ['tahun_ajaran_id' => $value->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $value->kelas_siswa->wali_kelas->kelas_id, 'semester' => $value->semester, 'id_rapot' => $value->id_rapot]) }}"
                          target="_blank">Cetak
                          Rapot
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
@section('jsfile')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- Ekko Lightbox -->
  <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
      $("#example1").DataTable({
        "responsive": true,
        "paging": true,
        "ordering": true
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
