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
          <h1>Lihat Sikap dan Spiritual</h1>
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
                href="{{ route('rapot.Sikap', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester]) }}">Lihat
                Sikap dan Spiritual</a></li>
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
              action="{{ route('rapot.SikapUpdate', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester, 'id_sikap' => $datanya->id_sikap]) }}"
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
                          value="{{ old('nisn', $datanya->rapot->kelas_siswa->siswa->nisn) }}" readonly required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control"placeholder="Nama Guru"
                          value="{{ old('nama_siswa', $datanya->rapot->kelas_siswa->siswa->nama_siswa) }}" readonly
                          required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Predikat Sikap Spiritual</label>
                        <input type="text" name="predikat_spiritual" class="form-control"
                          placeholder="Predikat Sikap Spiritual"
                          value="{{ old('predikat_spiritual', $datanya->predikat_spiritual) }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi Sikap Spiritual</label>
                        <textarea name="deskripsi_spiritual" class="form-control" rows="3" placeholder="Deskripsi Sikap Spiritual"
                          required>{{ old('deskripsi_spiritual', $datanya->deskripsi_spiritual) }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Predikat Sosial</label>
                        <input type="text" name="predikat_sosial" class="form-control" placeholder="Predikat Sosial"
                          value="{{ old('predikat_sosial', $datanya->predikat_sosial) }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi Sosial</label>
                        <textarea name="deskripsi_sosial" class="form-control" rows="3" placeholder="Deskripsi Sosial" required>{{ old('deskripsi_sosial', $datanya->deskripsi_sosial) }}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="{{ route('rapot.Sikap', ['tahun_ajaran_id' => $datanya->rapot->kelas_siswa->wali_kelas->tahun_ajaran_id, 'kelas_id' => $datanya->rapot->kelas_siswa->wali_kelas->kelas_id, 'semester' => $datanya->rapot->semester]) }}">
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
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });

      $('#nilai_pengetahuan').on('change', function() {
        let nilai_pengetahuan = $('#nilai_pengetahuan').val()
        if (nilai_pengetahuan >= 92) {
          //Tampilkan predikat pengetahuan
          $('#predikat_pengetahuan').val('A');
        } else if (nilai_pengetahuan >= 83) {
          $('#predikat_pengetahuan').val('B');
        } else if (nilai_pengetahuan >= 75) {
          $('#predikat_pengetahuan').val('C');
        } else if (nilai_pengetahuan >= 0) {
          $('#predikat_pengetahuan').val('D');
        }
      });
      //Jquery Jika Mengisi Angka keterampilan, Tampilkan Predikat keterampilan
      $('#nilai_keterampilan').on('change', function() {
        let nilai_keterampilan = $('#nilai_keterampilan').val()
        if (nilai_keterampilan >= 92) {
          //Tampilkan predikat keterampilan
          $('#predikat_keterampilan').val('A');
        } else if (nilai_keterampilan >= 83) {
          $('#predikat_keterampilan').val('B');
        } else if (nilai_keterampilan >= 75) {
          $('#predikat_keterampilan').val('C');
        } else if (nilai_keterampilan >= 0) {
          $('#predikat_keterampilan').val('D');
        }
      });
    });
  </script>
@endsection
