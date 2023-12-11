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
          <h1>Data Kelas Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kelas-siswa.index') }}">Data Kelas Siswa</a></li>
            <li class="breadcrumb-item active">Tambah Data Kelas Siswa</li>
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
            <form action="{{ route('kelas-siswa.update', $datanya->id_kelas_siswa) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tahun Ajaran</label>
                      <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH TAHUN AJARAN --</option>
                        @foreach ($dataTahunAjaranWaliKelas as $key => $dataTahunAjaranWaliKelas)
                          <option value="{{ $dataTahunAjaranWaliKelas->tahun_ajaran->id }}"
                            {{ collect(old('tahun_ajaran_id', $datanya->wali_kelas->tahun_ajaran_id))->contains($dataTahunAjaranWaliKelas->tahun_ajaran->id) ? 'selected="selected"' : '' }}>
                            {{ $dataTahunAjaranWaliKelas->tahun_ajaran->tahun_ajaran }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kelas</label>
                      <select name="kelas_id" id="kelas_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH KELAS --</option>
                        @foreach ($dataKelas as $key => $dataKelas)
                          <option value="{{ $dataKelas->kelas->id }}"
                            {{ collect(old('kelas_id', $datanya->wali_kelas->kelas_id))->contains($dataKelas->kelas->id) ? 'selected="selected"' : '' }}>
                            {{ $dataKelas->kelas->nama_kelas }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Wali Kelas</label>
                      <input type="text" name="nama_wali_kelas" class="form-control" placeholder="Nama Wali"
                        value="{{ old('nama_wali_kelas', $datanya->wali_kelas->guru->nama_guru) }}" required readonly>
                      <input type="hidden" name="wali_kelas_id" class="form-control" placeholder="Nama Wali"
                        value="{{ old('wali_kelas_id', $datanya->wali_kelas_id) }}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Siswa</label>
                      <select name="siswa_id" class="form-control select2" required>
                        <option value="" selected disabled>-- PILIH SISWA --</option>
                        @foreach ($dataSiswa as $key => $dataSiswa)
                          <option value="{{ $dataSiswa->id }}"
                            {{ collect(old('siswa_id', $datanya->siswa_id))->contains($dataSiswa->id) ? 'selected="selected"' : '' }}>
                            {{ $dataSiswa->nisn }} | {{ $dataSiswa->nama_siswa }}</option>
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
      //AJAX Tahun Ajaran
      $('#tahun_ajaran_id').on('change', function() {
        let tahun_ajaran = $('select[name="tahun_ajaran_id"]').val()
        $.ajax({
            url: "{{ url('/dashboard/kelas-siswa/ajax/tahun-ajaran') }}/" + tahun_ajaran,
            method: "GET",
          })
          .done(function(result) {
            $('select[name="kelas_id"]').attr('disabled', false).html(result)
          });
      });
      //AJAX Wali Kelas
      $('#kelas_id').on('change', function() {
        let tahun_ajaran = $('select[name="tahun_ajaran_id"]').val()
        let kelas = $('select[name="kelas_id"]').val()
        $.ajax({
            url: "{{ url('/dashboard/kelas-siswa/ajax/kelas') }}",
            method: "GET",
            data: {
              tahun_ajaran: tahun_ajaran,
              kelas: kelas
            }
          })
          .done(function(data) {
            $('input[name="nama_wali_kelas"]').val(data.nama_guru)
            $('input[name="wali_kelas_id"]').val(data.wali_kelas_id)
          });
      });
    });
  </script>
@endsection
