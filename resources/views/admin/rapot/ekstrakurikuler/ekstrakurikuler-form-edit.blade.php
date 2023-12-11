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
          <h1>Rapot <b>Tahun Ajaran {{ $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran }}</b></h1>
          <h1>Kelas <b>{{ $datanya->rapot->kelas_siswa->wali_kelas->kelas->nama_kelas }}</b></h1>
          <h1>Rapot <b>{{ $datanya->rapot->semester }}</b></h1>
          <h1>Lihat Ekstrakurikuler</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rapot.TahunAjaran') }}">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Kelas', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id]) }}">Tahun
                Ajaran
                {{ $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Siswa', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id]) }}">{{ $datanya->rapot->kelas_siswa->wali_kelas->kelas->nama_kelas }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Semester', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester]) }}">Rapot
                {{ $datanya->rapot->semester }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Ekstrakurikuler', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester]) }}">Lihat
                Ekstrakurikuler</a></li>
            <li class="breadcrumb-item active">Ubah Data {{ $datanya->rapot->kelas_siswa->siswa->nama_siswa }}</li>
          </ol>
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
              <h3 class="card-title">Ubah Data <b>{{ $datanya->rapot->kelas_siswa->siswa->nama_siswa }}</b></h3>
            </div>
            <!-- form start -->
            <form
              action="{{ route('rapot.EkstrakurikulerUpdate', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester, 'id_ekstrakurikuler' => $datanya->id_ekstrakurikuler]) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kegiatan Ekstrakurikuler</label>
                        <input type="text" name="kegiatan_ekstrakurikuler" class="form-control"
                          placeholder="Kegiatan Ekstrakurikuler"
                          value="{{ old('kegiatan_ekstrakurikuler', $datanya->kegiatan_ekstrakurikuler) }}" readonly
                          required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Keterangan Nilai</label>
                        <textarea name="keterangan_ekstrakurikuler" class="form-control" placeholder="Keterangan Nilai" rows="5" required>{{ old('keterangan_ekstrakurikuler', $datanya->keterangan_ekstrakurikuler) }}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="{{ route('rapot.Ekstrakurikuler', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester]) }}">
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
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();
    });
  </script>
@endsection
