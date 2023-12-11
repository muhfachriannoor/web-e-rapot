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
          <h1>Rapot <b>Tahun Ajaran {{ $datanya->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran }}</b></h1>
          <h1>Kelas <b>{{ $datanya->kelas_siswa->wali_kelas->kelas->nama_kelas }}</b></h1>
          <h1>Rapot <b>{{ $datanya->semester }}</b></h1>
          <h1>Lihat Lulus/Tidak Lulus</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rapot.TahunAjaran') }}">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Kelas', ['tahun_ajaran_id' => $datanya->kelas_siswa->wali_kelas->tahun_ajaran_id]) }}">Tahun
                Ajaran
                {{ $datanya->kelas_siswa->wali_kelas->tahun_ajaran->tahun_ajaran }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Siswa', ['tahun_ajaran_id' => $datanya->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->kelas_siswa->wali_kelas->kelas_id]) }}">{{ $datanya->kelas_siswa->wali_kelas->kelas->nama_kelas }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Semester', ['tahun_ajaran_id' => $datanya->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->semester]) }}">Rapot
                {{ $datanya->semester }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.KeputusanLulusTidakLulus', ['tahun_ajaran_id' => $datanya->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->semester]) }}">Lihat
                Keputusan Lulus/Tidak Lulus</a></li>
            <li class="breadcrumb-item active">Ubah Data {{ $datanya->kelas_siswa->siswa->nama_siswa }}</li>
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
              <h3 class="card-title">Ubah Data <b>{{ $datanya->kelas_siswa->siswa->nama_siswa }}</b></h3>
            </div>
            <!-- form start -->
            <form
              action="{{ route('rapot.KeputusanLulusTidakLulusUpdate', ['tahun_ajaran_id' => $datanya->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->semester, 'id_rapot' => $datanya->id_rapot]) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor Induk Siswa Nasional (NISN)</label>
                        <input type="text" name="nisn" class="form-control"
                          placeholder="Nomor Identitas Pegawai Negeri Sipil (NIP)"
                          value="{{ old('nisn', $datanya->kelas_siswa->siswa->nisn) }}" readonly required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control"placeholder="Nama Guru"
                          value="{{ old('nama_siswa', $datanya->kelas_siswa->siswa->nama_siswa) }}" readonly required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Keputusan</label>
                        <select name="keputusan_kelas" class="form-control select2" required style="width: 100%;">
                          <option value="" selected disabled>-- PILIH KEPUTUSAN --</option>
                          <option value="Lulus"
                            {{ old('keputusan_kelas', $datanya->keputusan_kelas) == 'Lulus' ? 'selected="selected"' : '' }}>
                            Lulus</option>
                          <option value="Tidak Lulus"
                            {{ old('keputusan_kelas', $datanya->keputusan_kelas) == 'Tidak Lulus' ? 'selected="selected"' : '' }}>
                            Tidak Lulus</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="siswa_id" value="{{ $datanya->kelas_siswa->siswa->id }}"required>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="{{ route('rapot.KeputusanLulusTidakLulus', ['tahun_ajaran_id' => $datanya->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->semester]) }}">
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
      $('.select2').select2();
    });
  </script>
@endsection
