@extends('layouts/templatedashboard')
@section('cssfile')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kelas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kelas</li>
          </ol>
        </div>
        <div class="col-sm-12 mt-3">
          <div class="float-left">
            <a class="btn btn-success" href="{{ route('kelas.create') }}"> Tambah Data</a>
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
                    <th>Tingkat Kelas</th>
                    <th>Nama Kelas</th>
                    <th width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $value)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $value->tingkat_kelas->tingkat_kelas }}</td>
                      <td>{{ $value->nama_kelas }}</td>
                      <td>
                        <form action="{{ route('kelas.destroy', $value->id) }}" method="POST">
                          {{-- <a class="btn btn-info"ref="{{ route('tingkat_kelas.show', $value->id) }}">Lihat</a> --}}
                          <a class="btn btn-primary" href="{{ route('kelas.edit', $value->id) }}">Ubah</a>
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
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "paging": true,
        "ordering": true
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
