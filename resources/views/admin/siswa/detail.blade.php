@extends('layouts/templatedashboard')
@inject('Carbon', 'Illuminate\Support\Carbon')
@section('cssfile')
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lihat Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Lihat Data Siswa</li>
          </ol>
        </div>
        <div class="col-sm-12 mt-3">
          <div class="float-left">
            <a class="btn btn-success" href="{{ url()->previous() }}"> Kembali</a>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">Data Siswa
                <b>{{ $datanya->nama_siswa }}</b>
              </h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-2">
                  <a href="{{ url('datafoto_siswa/' . $datanya->foto_siswa) }}" data-toggle="lightbox"
                    data-title="Foto {{ $datanya->nama_siswa }}" data-gallery="gallery">
                    <img src="{{ url('datafoto_siswa/' . $datanya->foto_siswa) }}" class="img-fluid mb-2"
                      alt="Foto {{ $datanya->nama_siswa }}">
                  </a>
                </div>
                <div class="col-sm-10">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td width="25%">Nomor Induk Siswa Nasional (NISN)</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->nisn }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Nama Siswa</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->nama_siswa }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Jenis Kelamin</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->jenis_kelamin }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Tempat dan Tanggal Lahir</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->tempat_lahir }},
                            {{ $Carbon::parse($datanya->tanggal_lahir)->isoFormat('D MMMM Y') }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Agama</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->agama }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Status Dalam Keluarga</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->status_dalam_keluarga }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Anak Ke</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->anak_ke }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Alamat Rumah</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->alamat_rumah }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Nomor Telepon Rumah</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->no_telp_rumah }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Asal Sekolah</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->asal_sekolah }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Diterima Dikelas</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->diterima_dikelas }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Diterima Tanggal</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $Carbon::parse($datanya->tanggal_lahir)->isoFormat('D MMMM Y') }}</b>
                        </td>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Nama Ayah</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->nama_ayah }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Nama Ibu</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->nama_ibu }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Alamat Orang Tua</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->alamat_orangtua }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Nomor Telepon Orang Tua</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->no_telp_orangtua }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Pekerjaan Ayah</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->pekerjaan_ayah }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Pekerjaan Ibu</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->pekerjaan_ibu }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Nama Wali</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->nama_wali }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Alamat Wali</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->alamat_wali }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Nomor Telepon Wali</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->no_telp_wali }}</b>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%">Pekerjaan Wali</td>
                        <td width="1%" align="center">:</td>
                        <td><b>{{ $datanya->pekerjaan_wali }}</b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
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
    });
  </script>
@endsection
