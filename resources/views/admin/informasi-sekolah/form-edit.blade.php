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
          <h1>Informasi Sekolah</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('informasi-sekolah.index') }}">Informasi Sekolah</a></li>
            <li class="breadcrumb-item active">Ubah Informasi Sekolah</li>
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
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Ubah Informasi Sekolah</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('informasi-sekolah.update', $data->id) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control" placeholder="Nama Sekolah"
                          value="{{ old('nama_sekolah', $data->nama_sekolah) }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>NPSN</label>
                        <input type="text" name="npsn" class="form-control" placeholder="NPSN"
                          value="{{ old('npsn', $data->npsn) }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>NSS</label>
                        <input type="text" name="nss" class="form-control" placeholder="NSS"
                          value="{{ old('nss', $data->nss) }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>NDS</label>
                        <input type="text" name="nds" class="form-control" placeholder="NIS"
                          value="{{ old('nds', $data->nds) }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat_sekolah" class="form-control" rows="2" placeholder="Alamat">{{ old('alamat_sekolah', $data->alamat_sekolah) }}</textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan"
                          value="{{ old('kelurahan', $data->kelurahan) }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan"
                          value="{{ old('kecamatan', $data->kecamatan) }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kota/Kabupaten</label>
                        <input type="text" name="kota_kabupaten" class="form-control" placeholder="Kota/Kabupaten"
                          value="{{ old('kota_kabupaten', $data->kota_kabupaten) }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" placeholder="Provinsi"
                          value="{{ old('provinsi', $data->provinsi) }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Link Website</label>
                        <input type="text" name="link_website" class="form-control" placeholder="Link Website"
                          value="{{ old('link_website', $data->link_website) }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email_sekolah" class="form-control" placeholder="email@mail.com"
                          value="{{ old('email', $data->email) }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos"
                          value="{{ old('kode_pos', $data->kode_pos) }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor Telepon Sekolah</label>
                        <input type="number" name="no_telp_sekolah" class="form-control"
                          placeholder="Nomor Telepon Sekolah"
                          value="{{ old('no_telp_sekolah', $data->no_telp_sekolah) }}" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
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
@endsection
