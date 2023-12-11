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
          <h1>Input Sikap dan Spiritual</h1>
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
            <li class="breadcrumb-item active">Input Sikap dan Spiritual</li>
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
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Alert!</h5>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Input Sikap dan Spiritual</h3>
            </div>
            <!-- form start -->
            <form
              action="{{ route('rapot.SikapStore', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="2%" rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                      <th width="25%" rowspan="2" style="text-align: center; vertical-align: middle;">Nama Siswa
                      </th>
                      <th width="20%" colspan="2" style="text-align: center; vertical-align: middle;">Sikap
                        Spiritual
                      </th>
                      <th width="20%" colspan="2" style="text-align: center; vertical-align: middle;">Sikap Sosial
                      </th>
                    </tr>
                    <tr>
                      <th width="8%" style="text-align: center; vertical-align: middle;">Predikat</th>
                      <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                      <th width="8%" style="text-align: center; vertical-align: middle;">Predikat</th>
                      <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key => $value)
                      <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                        <td style="vertical-align: middle;"><a
                            href="{{ route('siswa.show', $value->kelas_siswa->siswa->id) }}"
                            target="_blank">{{ $value->kelas_siswa->siswa->nama_siswa }}</a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;"><input type="text"
                            name="predikat_spiritual[{{ $key }}]" class="form-control text-center"
                            placeholder="Predikat Spiritual" value="{{ old("predikat_spiritual.{$key}", '') }}" required>
                        </td>
                        <td>
                          <textarea name="deskripsi_spiritual[{{ $key }}]" class="form-control" rows="3"
                            placeholder="Deskripsi Spiritual" required>{{ old("deskripsi_spiritual.{$key}", '') }}</textarea>
                        </td>
                        <td style="text-align: center; vertical-align: middle;"><input type="text"
                            name="predikat_sosial[{{ $key }}]" class="form-control text-center"
                            placeholder="Predikat Sosial" value="{{ old("predikat_sosial.{$key}", '') }}" required>
                        </td>
                        <td>
                          <textarea name="deskripsi_sosial[{{ $key }}]" class="form-control" rows="3"
                            placeholder="Deskripsi Sosial" required>{{ old("deskripsi_sosial.{$key}", '') }}</textarea>
                        </td>
                        <input type="hidden" name="rapot_id[]" value="{{ $value->id_rapot }}" required>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="{{ route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">
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
@endsection
