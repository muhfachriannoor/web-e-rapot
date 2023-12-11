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
          <h1>Data Wali Kelas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('wali-kelas.index') }}">Data Wali Kelas</a></li>
            <li class="breadcrumb-item active">Ubah Data Wali Kelas</li>
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
              <h3 class="card-title">Tambah Data</h3>
            </div>
            <!-- form start -->
            <form action="{{ route('wali-kelas.update', $datanya->id) }}" method="POST" enctype="multipart/form-data">
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
                      <label>Kelas</label>
                      <select name="kelas_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH KELAS --</option>
                        @foreach ($dataKelas as $key => $dataKelas)
                          <option value="{{ $dataKelas->id }}"
                            {{ collect(old('kelas_id', $datanya->kelas_id))->contains($dataKelas->id) ? 'selected="selected"' : '' }}>
                            {{ $dataKelas->nama_kelas }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Guru</label>
                      <select name="guru_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH GURU --</option>
                        @foreach ($dataGuru as $key => $dataGuru)
                          <option value="{{ $dataGuru->id }}"
                            {{ collect(old('guru_id', $datanya->guru_id))->contains($dataGuru->id) ? 'selected="selected"' : '' }}>
                            {{ $dataGuru->nip }} | {{ $dataGuru->nama_guru }}</option>
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
