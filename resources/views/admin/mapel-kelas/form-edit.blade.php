@extends('layouts/templatedashboard')
@section('cssfile')
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mata Pelajaran Kelas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mapel-kelas.index') }}">Mata Pelajaran Kelas</a></li>
            <li class="breadcrumb-item active">Ubah Mata Pelajaran Kelas</li>
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
              <h3 class="card-title">Ubah Data</h3>
            </div>
            <!-- form start -->
            <form action="{{ route('mapel-kelas.update', $datanya->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tahun Ajaran</label>
                      <select name="tahun_ajaran_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH TAHUN AJARAN --</option>
                        @foreach ($dataTahunAjaran as $key => $dataTahunAjaran)
                          <option value="{{ $dataTahunAjaran->id }}"
                            {{ collect(old('tahun_ajaran_id', $datanya->tahun_ajaran_id))->contains($dataTahunAjaran->id) ? 'selected="selected"' : '' }}>
                            {{ $dataTahunAjaran->tahun_ajaran }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tingkat Kelas</label>
                      <select name="tingkat_kelas_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH TINGKAT KELAS --</option>
                        @foreach ($dataTingkatKelas as $key => $dataTingkatKelas)
                          <option
                            value="{{ $dataTingkatKelas->id }}"{{ collect(old('tingkat_kelas_id', $datanya->tingkat_kelas_id))->contains($dataTingkatKelas->id) ? 'selected="selected"' : '' }}>
                            {{ $dataTingkatKelas->tingkat_kelas }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mata Pelajaran</label>
                      <select name="mapel_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH MATA PELAJARAN --</option>
                        @foreach ($dataMapel as $key => $dataMapel)
                          <option value="{{ $dataMapel->id }}"
                            {{ collect(old('mapel_id', $datanya->mapel_id))->contains($dataMapel->id) ? 'selected="selected"' : '' }}>
                            {{ $dataMapel->nama_mapel }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a class="btn btn-success" href="{{ url()->previous() }}"> Kembali</a>
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
  <!-- InputMask -->
  <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();
    });
  </script>
@endsection
