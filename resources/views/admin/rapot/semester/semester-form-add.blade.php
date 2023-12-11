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
            <li class="breadcrumb-item">Tambah Rapot {{ $semester }}</li>
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
              <h3 class="card-title">Tambah Rapot <b>{{ $semester }}</b></h3>
            </div>
            <!-- form start -->
            <form
              action="{{ route('rapot.SemesterStore', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id]) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="text" name="semester" class="form-control"
                          value="{{ old('semester', $semester) }}" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="2%">No</th>
                      <th width="10%">Foto Siswa</th>
                      <th width="10%">NISN</th>
                      <th width="20%">Nama Siswa</th>
                      <th width="8%">Jumlah Sakit</th>
                      <th width="8%">Jumlah Izin</th>
                      <th width="8%">Jumlah Tanpa Keterangan</th>
                      <th>Catatan Wali Kelas</th>
                      <th>Tanggapan Orang Tua/Wali</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key => $value)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td align="center">
                          <a href="{{ url('datafoto_siswa/' . $value->siswa->foto_siswa) }}" data-toggle="lightbox"
                            data-title="Foto {{ $value->siswa->nama_siswa }}" data-gallery="gallery">
                            <img src="{{ url('datafoto_siswa/' . $value->siswa->foto_siswa) }}" class="img-fluid"
                              alt="Foto {{ $value->siswa->nama_siswa }}" width="100px" height="50px">
                          </a>
                        </td>
                        <td>{{ $value->siswa->nisn }}</td>
                        <td><a href="{{ route('siswa.show', $value->siswa->id) }}"
                            target="_blank">{{ $value->siswa->nama_siswa }}</a>
                        </td>
                        <td><input type="number" name="sakit[{{ $key }}]" class="form-control" placeholder="00"
                            value="{{ old("sakit.{$key}", '') }}" required></td>
                        <td><input type="number" name="izin[{{ $key }}]" class="form-control" placeholder="00"
                            value="{{ old("izin.{$key}", '') }}" required></td>
                        <td><input type="number" name="tanpa_keterangan[{{ $key }}]" class="form-control"
                            placeholder="00" value="{{ old("tanpa_keterangan.{$key}", '') }}" required>
                        </td>
                        <td>
                          <textarea name="catatan_walikelas[{{ $key }}]" class="form-control" rows="3"
                            placeholder="Catatan Wali Kelas" required>{{ old("catatan_walikelas.{$key}", '') }}</textarea>
                        </td>
                        <td>
                          <textarea name="tanggapan_orangtua_wali[{{ $key }}]" class="form-control" rows="3"
                            placeholder="Tanggapan Orang Tua/Wali">{{ old("tanggapan_orangtua_wali.{$key}", '') }}</textarea>
                        </td>
                        <input type="hidden" name="kelas_siswa_id[]" value="{{ $value->id_kelas_siswa }}" required>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="{{ route('rapot.Siswa', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id]) }}">
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

      //Jquery Select Semester Genap Tampilkan Select Keputusan Kelas
      //$('#semester').on('change', function() {
      //  let semester = $('select[name="semester"]').val()
      //  if (semester == 'Semester Genap') {
      //    //munculin select option dengan nama keputusan kelas
      //    $('#header-selectnya-keputusan-kelas').css('display', '');
      //    $('#selectnya-keputusan-kelas').css('display', '');
      //  } else {
      //    $('#header-selectnya-keputusan-kelas').css('display', 'none');
      //    $('#selectnya-keputusan-kelas').css('display', 'none');
      //  }
      //});
    });
  </script>
@endsection
