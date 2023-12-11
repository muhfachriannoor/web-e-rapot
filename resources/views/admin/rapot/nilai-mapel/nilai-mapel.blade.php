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
          <h1>Lihat Nilai <b>{{ $dataMapel->nama_mapel }}</b></h1>
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
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Rapot
                {{ $semester }}</a>
            </li>
            <li class="breadcrumb-item active">Lihat Nilai {{ $dataMapel->nama_mapel }}</li>
          </ol>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12 mt-3">
          <div class="float-left">
            <a class="btn btn-success"
              href="{{ route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">
              Kembali</a>
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
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Lihat Nilai <b>{{ $dataMapel->nama_mapel }}</b></h3>
            </div>
            <div class="card-body">
              <div class="form-group">
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="2%" rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                    <th width="25%" rowspan="2" style="text-align: center; vertical-align: middle;">Nama Siswa
                    </th>
                    <th width="20%"
                      {{ ($semester == 'Semester Ganjil' or $semester == 'Semester Genap') ? 'colspan=4' : 'colspan=3' }}
                      style="text-align: center; vertical-align: middle;">Pengetahuan
                    </th>
                    <th width="20%"
                      {{ ($semester == 'Semester Ganjil' or $semester == 'Semester Genap') ? 'colspan=4' : 'colspan=3' }}
                      style="text-align: center; vertical-align: middle;">Keterampilan
                    </th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Status KKM</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                  </tr>
                  <tr>
                    <th width="6%" style="text-align: center; vertical-align: middle;">KKM</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                    @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                      <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                    @endif
                    <th width="6%" style="text-align: center; vertical-align: middle;">KKM</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                    <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                    @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                      <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $value)
                    <tr>
                      <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                      <td style="vertical-align: middle;"><a
                          href="{{ route('siswa.show', $value->rapot->kelas_siswa->siswa->id) }}"
                          target="_blank">{{ $value->rapot->kelas_siswa->siswa->nama_siswa }}</a>
                      </td>
                      <td style="text-align: center; vertical-align: middle;">
                        <b>{{ $value->mata_pelajaran->nilai_kkm }}</b>
                      </td>
                      <td style="text-align: center; vertical-align: middle;">{{ $value->nilai_pengetahuan }}</td>
                      <td style="text-align: center; vertical-align: middle;">{{ $value->predikat_pengetahuan }}</td>
                      @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                        <td style="vertical-align: middle;">{{ $value->deskripsi_pengetahuan }}</td>
                      @endif
                      <td style="text-align: center; vertical-align: middle;">
                        <b>{{ $value->mata_pelajaran->nilai_kkm }}</b>
                      </td>
                      <td style="text-align: center; vertical-align: middle;">{{ $value->nilai_keterampilan }}</td>
                      <td style="text-align: center; vertical-align: middle;">{{ $value->predikat_keterampilan }}</td>
                      @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                        <td style="vertical-align: middle;">{{ $value->deskripsi_keterampilan }}</td>
                      @endif
                      <td style="text-align: center; vertical-align: middle;">
                        @if ($value->status_kkm == 'Lulus Nilai KKM')
                          <span class="badge bg-success">{{ $value->status_kkm }}</span>
                        @else
                          <span class="badge bg-danger">{{ $value->status_kkm }}</span>
                        @endif
                      </td>
                      <td style="text-align: center; vertical-align: middle;"><a class="btn btn-primary"
                          href="{{ route('rapot.NilaiMapelEdit', ['tahun_ajaran_id' => $value->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $value->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $value->rapot->semester, 'mapel_id' => $value->id_mapel, 'id_nilai_mapel' => $value->id_nilai_mapel]) }}">Ubah</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
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
  <!-- Select2 -->
  <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();
      $("#example1").DataTable({
        "responsive": true,
        "paging": true,
        "ordering": true
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
