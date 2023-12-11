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
          <h1>Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
            <li class="breadcrumb-item active">Tambah Data Siswa</li>
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
            <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor Induk Siswa Nasional (NISN)</label>
                        <input type="number" name="nisn" class="form-control"
                          placeholder="Nomor Induk Siswa Nasional (NISN)" value="{{ old('nisn', '') }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa"
                          value="{{ old('nama_siswa', '') }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control select2" required>
                          <option value="" selected disabled>-- PILIH JENIS KELAMIN --</option>
                          <option value="Laki-laki"
                            {{ collect(old('jenis_kelamin'))->contains('Laki-laki') ? 'selected="selected"' : '' }}>
                            Laki-laki</option>
                          <option value="Perempuan"
                            {{ collect(old('jenis_kelamin'))->contains('Perempuan') ? 'selected="selected"' : '' }}>
                            Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir"
                          value="{{ old('tempat_lahir', '') }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                          <input type="text" name="tanggal_lahir" class="form-control datetimepicker-input"
                            data-target="#reservationdate" placeholder="tahun/bulan/hari"
                            value="{{ old('tanggal_lahir', '') }}" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Agama</label>
                        <select name="agama" class="form-control select2" required>
                          <option value="" selected disabled>-- PILIH AGAMA --</option>
                          <option value="Islam"
                            {{ collect(old('agama'))->contains('Islam') ? 'selected="selected"' : '' }}>Islam</option>
                          <option value="Kristen"
                            {{ collect(old('agama'))->contains('Kristen') ? 'selected="selected"' : '' }}>Kristen
                          </option>
                          <option value="Katolik"
                            {{ collect(old('agama'))->contains('Katolik') ? 'selected="selected"' : '' }}>Katolik
                          </option>
                          <option value="Hindu"
                            {{ collect(old('agama'))->contains('Hindu') ? 'selected="selected"' : '' }}>Hindu</option>
                          <option value="Budha"
                            {{ collect(old('agama'))->contains('Budha') ? 'selected="selected"' : '' }}>Budha</option>
                          <option value="Konghucu"
                            {{ collect(old('agama'))->contains('Konghucu') ? 'selected="selected"' : '' }}>Konghucu
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status Dalam Keluarga</label>
                        <input type="text" name="status_dalam_keluarga" class="form-control"
                          placeholder="Status Dalam Keluarga" value="{{ old('status_dalam_keluarga', '') }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Anak Ke</label>
                        <input type="text" name="anak_ke" class="form-control" placeholder="Anak Ke"
                          value="{{ old('anak_ke', '') }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alamat Rumah</label>
                        <textarea name="alamat_rumah" class="form-control" rows="2" placeholder="Alamat Rumah" required>{{ old('alamat_rumah', '') }}</textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor Telepon Rumah</label>
                        <input type="number" name="no_telp_rumah" class="form-control" placeholder="0541xxxx"
                          value="{{ old('no_telp_rumah', '') }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" class="form-control" placeholder="Asal Sekolah"
                          value="{{ old('asal_sekolah', '') }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Diterima Dikelas</label>
                        <input type="text" name="diterima_dikelas" class="form-control"
                          placeholder="Diterima Dikelas" value="{{ old('diterima_dikelas', '') }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Diterima Tanggal</label>
                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                          <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                          <input type="text" name="diterima_tanggal" class="form-control datetimepicker-input"
                            data-target="#reservationdate" placeholder="tahun/bulan/hari"
                            value="{{ old('diterima_tanggal', '') }}" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah"
                          value="{{ old('nama_ayah', '') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu"
                          value="{{ old('nama_ibu', '') }}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alamat Orang Tua</label>
                        <textarea name="alamat_orangtua" class="form-control" rows="2" placeholder="Alamat Orang Tua">{{ old('alamat_orangtua', '') }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor Telepon Orang Tua</label>
                        <input type="number" name="no_telp_orangtua" class="form-control" placeholder="08xxxx"
                          value="{{ old('no_telp_orangtua', '') }}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah"
                          value="{{ old('pekerjaan_ayah', '') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu"
                          value="{{ old('pekerjaan_ibu', '') }}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Wali</label>
                        <input type="text" name="nama_wali" class="form-control" placeholder="Nama Wali"
                          value="{{ old('nama_wali', '') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alamat Wali</label>
                        <textarea name="alamat_wali" class="form-control" rows="2" placeholder="Alamat Wali">{{ old('alamat_wali', '') }}</textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor Telepon Wali</label>
                        <input type="number" name="no_telp_wali" class="form-control" placeholder="08xxxx"
                          value="{{ old('no_telp_wali', '') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pekerjaan Wali</label>
                        <input type="text" name="pekerjaan_wali" class="form-control" placeholder="Pekerjaan Wali"
                          value="{{ old('pekerjaan_wali', '') }}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Foto Siswa</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="foto_siswa" class="custom-file-input" id="customFile"
                              required>
                            <label class="custom-file-label" for="customFile">Pilih Foto</label>
                          </div>
                        </div>
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
  <!-- Select2 -->
  <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
      //Date picker
      $('#reservationdate').datetimepicker({
        format: 'YYYY/MM/DD'
      });
      $('#reservationdate2').datetimepicker({
        format: 'YYYY/MM/DD'
      });
      //Initialize Select2 Elements
      $('.select2').select2();
    });
  </script>
@endsection
