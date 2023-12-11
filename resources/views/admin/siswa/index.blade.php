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
          <h1>Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Siswa</li>
          </ol>
        </div>
        <div class="col-sm-12 mt-3">
          <div class="float-left">
            <a class="btn btn-success" href="{{ route('siswa.create') }}"> Tambah Data</a>
            <a class="btn btn-primary" href="{{ route('importExcel-siswa') }}"> Import Excel</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="2%">No</th>
                    <th width="10%">Foto Siswa</th>
                    <th>NISN</th>
                    <th width="45%">Nama Siswa</th>
                    <th width="">Status Lulus</th>
                    <th width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $value)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td align="center">
                        <a href="{{ url('datafoto_siswa/' . $value->foto_siswa) }}" data-toggle="lightbox"
                          data-title="Foto {{ $value->nama_siswa }}" data-gallery="gallery">
                          <img src="{{ url('datafoto_siswa/' . $value->foto_siswa) }}" class="img-fluid"
                            alt="Foto {{ $value->nama_siswa }}" width="100px" height="50px">
                        </a>
                      </td>
                      <td>{{ $value->nisn }}</td>
                      <td>{{ $value->nama_siswa }}</td>
                      <td>
                        @if ($value->status_lulus == 'Lulus')
                          <span class="badge bg-success">{{ $value->status_lulus }}</span>
                        @else
                          <span class="badge bg-danger">Belum Lulus</span>
                        @endif
                      </td>
                      <td>
                        <form action="{{ route('siswa.destroy', $value->id) }}" method="POST">
                          <a class="btn btn-info" href="{{ route('siswa.show', $value->id) }}">Lihat</a>
                          <a class="btn btn-primary" href="{{ route('siswa.edit', $value->id) }}">Ubah</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Hapus Data?')">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
      $("#example1").DataTable({
        "responsive": true,
        "paging": true,
        "ordering": true
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
